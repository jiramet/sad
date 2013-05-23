
<?php
	// config ในแต่ละหน้า
	echo fpermiss($_GET['f']); // ตรวจสอบสิทธิในการเข้าถึง ของ User ในหน้านี้ว่าเข้าดูได้หรือเปล่า
	$dbcp = _WURL; //dbcp = database connect page ดาต้าเบส ที่ใช้ ในหน้านี้

	$headtext = 'ระบบคำนำหน้าชื่อ'; //ส่วนหัว Page
	//Setting Page
	//$number_per_page = 10; //กำหนดให้แสดง 10 แถวต่อเพจ

	//start------------------จัดการเรื่องตารางหน้าแสดงผล-----------------------
	$tableallsize = '100%'; //ขนาดตารางทั้งหมด
	$headtable = array('ชื่อ Menu', 'URL', 'URL_full', 'Show Menu', 'การกระทำ'); //หัวตาราง ที่จะนำไป loop หัวตาราง แสดงผล  หน้าแรก
	$counts = count($headtable); //นับจำนวน สมาชิค ใน Array
	$tablesizes = array('20%', '10%', '20%', '10%', '30%'); //ขาดในแต่ละช่อย  อ่างอิงจาก $headtable
	$colors = array("#FFFFFF", "#EDEDED"); //สีตารางสลับสี  สามารถเพิมได้  $colors = array("#FFFFFF", "#EDEDED", "#CCCCCC"); 3 สี

	//stop------------------จัดการเรื่องตารางหน้าแสดงผล-----------------------

	//start------------------กำหนดตัวแปลจาก Databases-----------------------
	$getsumfield = getsumfieldmysql($dbcp); //นับจำนวน Field ของ $dbcp ว่ามีทั้งหมด กี่ Field
	//echo $getsumfield;
	$value = getfieldmysql($dbcp); // get ชื่อ Field มา เพื่อนำไปตั้ง ชื่อ Textfield (ช่องสำหรับกรอกข้อมูลสำหรับส่งค่า)
	//echo $value[9];

	//end----------จำกำหนดตัวแปลจาก Databases-----------------------

	//start------------------ระบบค้นหา-----------------------
	for ($i = 1; $i <= $getsumfield; $i++) {
		$fsearch .= " " . $value[$i] . " LIKE '%" . $_POST[s] . "%' or";
	}
	$rest = substr("$fsearch", 0, -2); //คำสั่งตัด คำว่า or ท้ายข้อความออก
	$quersearch = "WHERE (" . $rest . ")";
	//echo $quersearch1."</br>";

	//end-------------ระบบค้นหา-----------------------

	//จบการ config
?>

<h1><?php echo $headtext; ?></h1>
<div>
<?php
	echo fperurl($_GET['f'], 'add', '', 'เพิ่มMenu', $wurl3->mp_aper);
?>  
</div>
<table width="95%" border="0" cellspacing="5" cellpadding="5">
    <tr>
        <td><div align="right">
                <form name="form1" method="post" action="index.php?f=<?php echo $_GET[f]; ?>">
                    <input name="s" type="text" id="s" value="<?php echo $_POST[s]; ?>">
                    <input type="submit" name="Submit" value="ค้นหา">
                </form>
            </div></td>
    </tr>
    <tr>
        <td><div align="center">
        
 <!-- เริ่มสร้างตาราง  โดยใช้คำสั่ง loop ตามค่า ที่ config ด้านบน -->
 
                <table width="<?php echo $tableallsize; ?>" style="margin-top:50px;" border="1" cellspacing="0" cellpadding="0">
                    <tr bgcolor= #00FFFF>
<?php
	for ($i = 0; $i < $counts; $i++) {
		echo "<td width =" . $tablesizes[$i] . "><div align= center>" . $headtable[$i] . "</div></td>";
	}

?>
 <!-- จบการสร้างตาราง  โดยใช้คำสั่ง loop ตามค่า ที่ config ด้านบน -->
                    </tr>
<?php /* -------- */ ?>

<?php
	//start=====================ส่วนในการค้นหา(ถ้ามีคำค้นหา  ถ้าไม่มี กระโดนลงไปข้างล่าง===(ไม่ต้องแก้ไข)
	$s = trim($_POST[s]);
	if ($s != "") {
		echo finwebper($_GET['f'], 'search');
		//$quersearch="WHERE (m_id LIKE '%".$s."%' or m_name LIKE '%".$s."%' )";
		$Query = $db->query("SELECT * FROM " . $dbcp . " $quersearch");
		//end=====================ส่วนในการค้นหา======================================

	} else {

		//Start===================คำนวนการแบ่างหน้า===============================(ไม่ต้องแก้ไข)	
		// Get All filed Data...
		$all_data = $db->rows($db->query("SELECT * FROM " . $dbcp . " WHERE 1"));
		// Page Control
		//อ่านลำดับเพจปัจจุบันจาก query string หากไม่มีแสดงว่าเป็นเพจแรก
		$page = intval($_GET['page']);
		if (!$page)
			$page = 1;

		//คำนวณหาแถวเริ่มต้นของเพจนั้นๆ
		$start = ($page - 1) * $number_per_page;

		//คำนวณหาเพจทั้งหมดที่สามารถแบ่งได้ โดยปัดเศษทศนิยมทิ้ง
		$all_page = floor($all_data / $number_per_page);

		//mod แล้วให้บวก 1 เป็นการปัดเศษจากการหารขึ้นนั่นเอง
		if ($all_data % $number_per_page)
			$all_page++;

		//End===================จบการคำนวนการแบ่งหน้า============================		

		//Start==================ตรวจสอบว่าไม่มีคำที่ต้องการค้นหา ให้เริ่มตรงนี้==============(ไม่ต้องแก้ไข)	

		$Query = $db->query("	SELECT * FROM " . $dbcp . " ORDER BY " . $value[1] . " ASC LIMIT {$start},{$number_per_page}"); //สร้างตาราง

		//End==================ตรวจสอบว่าไม่มีคำที่ต้องการค้นหา ให้เริ่มตรงนี้==============
	}

	//Start =================เริ่มแสดงตาราง==========================
	$sum = $db->rows($Query);
	if ($sum) {
		$i = 0;
		while ($showme = $db->fetch($Query)) {
			$i++;
			$showid = $showme->$value[1];
			//start==============ส่วนที่แก้ไข==============
?>
                            <tr bgcolor= <?php echo $colors[$i%count($colors)]; ?>>
                                <td><?php echo $showme->$value[2]; ?></td>
                                <td><?php echo $showme->$value[3]; ?></td>
                                <td><?php echo $showme->$value[4]; ?></td>
		  <td>
		  <?php
			if ($showme->$value[5] == 0) {
?>	
		  
		  	<form name="form3" method="post" action="index.php?f=<?php echo $_GET[f];?>&action=editshow&id=<?php echo $showme->w_id?>">
		  	<input name="status" type="hidden" value="1" />
		  	<center><input name="test" type="submit" value=" แสดงMenu " /></center>
		  	</form>
		  	<?php
			} else {
?>
		  	<form name="form3" method="post" action="index.php?f=<?php echo $_GET[f];?>&action=editshow&id=<?php echo $showme->w_id?>">
		  	<input name="status" type="hidden" value="0" />
		  	<center></center><input name="test" type="submit" value="ไม่แสดงMenu" /></center>
		  	</form>
		  	<?php
			}
?>

		  </td>
                                <td><div align="center">

<?php
			//end==============จบส่วนที่แก้ไข============== อย่าลืม  ลงไปแก้การรวมตาราง ด้านล่างด้วยนะ  แก้ตามตารางที่เรา แสดง
			// start  manu  เพิ่ม ลบ แก้ไข และสิทธิ  ในตาราง
			echo fperurl($_GET['f'], 'open', "$showid", 'เปิดดู', $wurl3->mp_oper) . fperurl($_GET['f'], 'edit', "$showid", 'แก้ไข', $wurl3->mp_eper);
			echo substr(fperurl($_GET['f'], 'del', "$showid", 'ลบ', $wurl3->mp_dper), 0, -2);
?>
                                    </div></td>
                            </tr>
<?php
		}
	} else {
?>	
                        <tr>
                            <td colspan="2" class="center">ไม่พบรายการสมาชิก</td>  
                        </tr>
<?php } ?>
<?php //end =================จบการแสดงตาราง========================== ?>

                </table>
            </div></td>
    </tr>
</table>
<center>
<?php
	//เรียกใช้งาน function SplitPageใน function.php
	SplitPage($page, $all_page, "?f=" . $_GET['f'] . "&page=");
	//ตรงกลางต้องใส่ url ของเว็บไซต์แล้วต้องตามด้วย page= เสมอ .. ไม่เกี่ยวนะ
?>
</center>

<div style="margin-top:50px;" class="dot-header">
    <div style="margin-top:20px;">
        <!-- Comment By mod  เปิดดูข้อมูล-->
<?php
	if ($action == "open") {
		echo finwebper($_GET['f'], $_GET['action']);
		// echo fpermiss($_GET['f']); // ตรวจสอบสิทธิในการเข้าถึง ของ User ในหน้านี้ว่าเข้าดูได้หรือเปล่า
		$m = $db->fetch($db->query("SELECT * FROM " . $dbcp . " WHERE $value[1] = ' " . $id . " ' "));
		//start==============ส่วนที่แก้ไข==============
		if ($m->$value[1]) {
			$mid = $m->$value[1];
?>
                <div class="center">
                    <div align="center" id="showdata">
                        <table width="500" border="1" cellspacing="0" cellpadding="0">
                            <tr> 
                                <td colspan="2"><div align="center"><a name="link1">รายชื่อ Menu</a></div></td>
                            </tr>
                            <tr>
                                <td width="120"><div align="right">รหัสURL</div></td>
                                <td width="374"><div align="left"><?php echo $mid; ?> </div></td>
                            </tr>
                            <tr>
                                <td><div align="right">ชื่อ Menu</div></td>
                                <td><?php echo $m->$value[2]; ?></td>
                            </tr>
                            <tr>
                                <td><div align="right">URL</div></td>
                                <td><?php echo $m->$value[3]; ?></td>
                            </tr>
                             <tr>
                                <td><div align="right">URL FuLL</div></td>
                                <td><?php echo $m->$value[4]; ?></td>
                            </tr>
                            <tr>
                                <td><div align="right">การกระทำ</div></td>
                                <td>
<?php
			echo fperurl($_GET['f'], 'edit', "$mid", 'แก้ไข', $wurl3->mp_eper);
			echo substr(fperurl($_GET['f'], 'del', "$showid", 'ลบ', $wurl3->mp_dper), 0, -2);
?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
<?php
		} else {
			getJavaAlert("ไม่พบข้อมูลสมาชิก");
		}
		//  Comment by mod ส่วนนี้เป็นการเพิ่มข้อมูล
	} else if ($action == "add") {
		echo finwebper($_GET['f'], $_GET['action']);
?>
            <div align="center">
    				 <form name="form2" method="post" action="index.php?f=<?php echo $_GET[f];?>&action=saveadd"> 
                    <table width="500" border="0" cellspacing="5" cellpadding="5">
                        <tr>
                            <td colspan="2"><div align="center"><a name="link1">กรอกข้อมูลUrl</a></div></td>
                        </tr>
                        <tr>
                            <td width="120"><div align="right">ชื่อ Menu</div></td>
                            <td width="374"><input name="<?php echo $value[2];?>" type="text" id="<?php echo $value[2];?>" size="50"></td>
                        </tr>
                        <tr>
                            <td width="120"><div align="right">URL</div></td>
                            <td width="374"><input name="<?php echo $value[3];?>" type="text" id="<?php echo $value[3];?>" size="50"></td>
                        </tr>
                        <tr>
                            <td width="120"><div align="right">URL Full</div></td>
                            <td width="374"><input name="<?php echo $value[4];?>" type="text" id="<?php echo $value[4];?>" size="50">
                            <input name="<?php echo $value[5];?>" type="hidden" id="<?php echo $value[5];?>" value="0" size="50">
                            </td>
                        </tr>
                        <tr>
                            <td width="120"><div align="right">หมายเหตุ</div></td>
                            <td width="374"><input name="<?php echo $value[6];?>" type="text" id="<?php echo $value[6];?>" size="50"></td>
                        </tr>
                        <tr>
                            <td><div align="right"></div></td>
                            <td><input type="submit" name="Submit" value="เพิ่มสมาชิก"></td>
                        </tr>
                    </table>
                </form>
            </div>
<?php
	} else if ($action == "saveadd") {
		$check = $db->fetch($db->query("
			SELECT COUNT($value[1]) AS data
			FROM " . $dbcp . "
			WHERE $value[7] = '" . trim($_POST[$value[7]]) . "'
		"));
		if ($check->data) {
			getJavaAlert("อีเมลล์ซ้ำในระบบ");
		} else {
			$dataadd = array();
			foreach ($_REQUEST as $key => $val) // All Key & Value
				{
				if ($key == 'Submit') {
					break;
				} elseif ($key == 'f' or $key == 'saveadd' or $key == 'saveedit' or $key == 'action') {

				} else {
					$dataadd[$key] = trim($val);
				}
			}

			$add = $db->add_db($dbcp, $dataadd);

			if ($add) {
				getJavaAlert("เพิ่มข้อมูลสำเร็จ", 0);
			} else {
				getJavaAlert("เพิ่มข้อมูลล้มเหลว", 0);
			}
			_go("index.php?f=" . $_GET['f']);
		}
	} else if ($action == "edit") {
		echo finwebper($_GET['f'], $_GET['action']);
		// comment by mod ส่วนนี้เป็นการแก้ไขข้อมูล
		$m = $db->fetch($db->query(" SELECT * FROM " . $dbcp . " WHERE $value[1] = '" . $id . "'	"));
		if ($m->$value[1]) {
?>
                <div align="center">
                       <form name="form3" method="post" action="index.php?f=<?php echo $_GET[f];?>&action=saveedit&id=<?php echo $id; ?>"> 
                        <table width="500" border="0" cellspacing="5" cellpadding="5">
                            <tr>
                                <td colspan="2"><div align="center"><a name="link1">กรอกข้อมูลที่ต้องการแก้ไข</a></div></td>
                            </tr>
                            <tr>
                                <td width="120"><div align="right">ชื่อ Menu</div></td>
                                <td width="374"><input name="<?php echo $value[2];?>" type="text" id="<?php echo $value[2];?>" value="<?php echo $m->$value[2]; ?>" size="50"></td>
                            </tr>
                            <tr>
                            <td width="120"><div align="right">URL</div></td>
                            <td width="374"><input name="<?php echo $value[3];?>" type="text" id="<?php echo $value[3];?>"value="<?php echo $m->$value[3]; ?>" size="50"></td>
                        </tr>
                        <tr>
                            <td width="120"><div align="right">URL Full</div></td>
                            <td width="374"><input name="<?php echo $value[4];?>" type="text" id="<?php echo $value[4];?>"value="<?php echo $m->$value[4]; ?>" size="50"></td>
                        </tr>
                        <tr>
                            <td width="120"><div align="right">หมายเหตุ</div></td>
                            <td width="374"><input name="<?php echo $value[6];?>" type="text" id="<?php echo $value[6];?>"value="<?php echo $m->$value[6]; ?>" size="50"></td>
                        </tr>
                            <tr>
                                <td><div align="right"></div></td>
                                <td><input type="submit" name="Submit" value="แก้ไขข้อมูล"></td>
                            </tr>
                        </table>
                    </form>
                </div>
<?php
		} else {
			getJavaAlert("ไม่พบสมาชิก");
		}
	} else if ($action == "saveedit") {
		if ($id) {
			$dataadd = array();
			foreach ($_REQUEST as $key => $val) // All Key & Value
				{
				if ($key == 'Submit') {
					break;
				} elseif ($key == 'f' or $key == 'saveadd' or $key == 'saveedit' or $key == 'action' or $key == 'id') {
					// id คือ คำสั่งชุดนี้  จะจัดการค่า Post และ Get ทั้งหมด จับมาใส่ Array  ให้ดู ที่ช่อง Address ของ IE ด้วยว่ามีตัวแปรอื่นที่ไม่ใช้ค่าที่จะนำข้า Databases หรือเปล่า
				} else {
					$dataedit[$key] = trim($val);
					$dataedit2 .= $key . ' => ' . trim($val);
				}
			}

			$save = $db->update_db($dbcp, $dataedit, "$value[1] = '" . $id . "'");
			if ($save) {
				getJavaAlert("แก้ไขข้อมูลสำเร็จ", 0);
			} else {
				getJavaAlert("แก้ไขข้อมูลล้มเหลว" . $dataedit2, 0);
			}
		}
		_go("index.php?f=" . $_GET['f']);
	} else if ($action == "del") {
		echo finwebper($_GET['f'], $_GET['action']);
		//$del = $db->del(_ORDER,"o_mid = '".$id."'");    // บรรทัดนี้ ตามไปลบใน Order ด้วย  สามารถใส่เพิ่มได้ตามต้องการ
		$del = $db->del($dbcp, $value[1] . " = '" . $id . "'");
		if ($del) {
			getJavaAlert("ลบข้อมูลสำเร็จ", 0);
		} else {
			getJavaAlert("ลบข้อมูลล้มเหลว", 0);
		}
		_go("index.php?f=" . $_GET['f']);
	} else if ($action == "editshow") {
		if ($id) {
			$save = $db->update_db($dbcp, array("w_status" => trim($_POST[status]), ), "w_id = '" . $id . "'");
			if ($save) {
				getJavaAlert("แก้ไขข้อมูลสำเร็จ", 0);
			} else {
				getJavaAlert("แก้ไขข้อมูลล้มเหลว", 0);
			}
		}
		_go("index.php?f=" . $_GET['f']);
	}
?>


    </div>
</div>
