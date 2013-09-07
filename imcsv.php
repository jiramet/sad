
<?php
// config ในแต่ละหน้า
echo fpermiss ( $_GET ['f'] ); // ตรวจสอบสิทธิในการเข้าถึง ของ User ในหน้านี้ว่าเข้าดูได้หรือเปล่า
$dbcp = _HARDWARE; // dbcp = database connect page ดาต้าเบส ที่ใช้ ในหน้านี้
$uploads_dir = 'csv/'; // Folder ที่จะเก็บ File
$filename = $_FILES ['cvsfile'] ['name']; // เอาชื่อ File ออกมา
$extension = strrchr ( $filename, '.' ); // เอานามสกุล ออกมา

$headtext = 'ระบบนำFile CSV เข้า Databases'; // ส่วนหัว Page
                                             // Setting Page
$number_per_page = 10000; // กำหนดให้แสดง 10 แถวต่อเพจ

// start------------------จัดการเรื่องตารางหน้าแสดงผล-----------------------
$tableallsize = '100%'; // ขนาดตารางทั้งหมด
$headtable = array ('Asset','Username','Department','Devicetype','IPAddress','Host Name' ); // หัวตาราง ที่จะนำไป loop หัวตาราง แสดงผล หน้าแรก
$counts = count ( $headtable ); // นับจำนวน สมาชิค ใน Array
$tablesizes = array ('20%','30%','20%','20%','20%','20%' ); // ขาดในแต่ละช่อย อ่างอิงจาก $headtable
$colors = array ("#FFFFFF","#EDEDED" ); // สีตารางสลับสี สามารถเพิมได้ $colors = array("#FFFFFF", "#EDEDED", "#CCCCCC"); 3 สี

// stop------------------จัดการเรื่องตารางหน้าแสดงผล-----------------------

// start------------------กำหนดตัวแปลจาก Databases-----------------------
$getsumfield = getsumfieldmysql ( $dbcp ); // นับจำนวน Field ของ $dbcp ว่ามีทั้งหมด กี่ Field
                                           // echo $getsumfield;
$value = getfieldmysql ( $dbcp ); // get ชื่อ Field มา เพื่อนำไปตั้ง ชื่อ Textfield (ช่องสำหรับกรอกข้อมูลสำหรับส่งค่า)
                                  // echo $value[9];

// end----------จำกำหนดตัวแปลจาก Databases-----------------------

// start------------------ระบบค้นหา-----------------------
for($i = 1; $i <= $getsumfield; $i ++) {
	$fsearch .= " " . $value [$i] . " LIKE '%" . $_POST [s] . "%' or";
}
$rest = substr ( "$fsearch", 0, - 2 ); // คำสั่งตัด คำว่า or ท้ายข้อความออก
$quersearch = "WHERE (" . $rest . ")";
// echo $quersearch1."</br>";

// end-------------ระบบค้นหา-----------------------

// จบการ config
?>

<h1><?php echo $headtext; ?></h1>
<div>
<?php
echo fperurl ( $_GET ['f'], 'add', '', 'นำ File CSV เข้า Databases', $wurl3->mp_aper );
echo fperurl ( $_GET ['f'], 'edit', '', 'Update Databases', $wurl3->mp_aper );
?>
</div>
<table width="95%" border="0" cellspacing="5" cellpadding="5">
	<tr>
		<td><div align="right">
				<form name="form1" method="post"
					action="index.php?f=<?php echo $_GET[f]; ?>">
					<input name="s" type="text" id="s" value="<?php echo $_POST[s]; ?>">
					<input type="submit" name="Submit" value="ค้นหา">
				</form>
			</div></td>
	</tr>
	<tr>
		<td><div align="center">

				<!-- เริ่มสร้างตาราง  โดยใช้คำสั่ง loop ตามค่า ที่ config ด้านบน -->

				<table width="<?php echo $tableallsize; ?>"
					style="margin-top: 50px;" border="1" cellspacing="0"
					cellpadding="0">
					<tr bgcolor=#00FFFF>
<?php
for($i = 0; $i < $counts; $i ++) {
	echo "<td width =" . $tablesizes [$i] . "><div align= center>" . $headtable [$i] . "</div></td>";
}

?>
 <!-- จบการสร้างตาราง  โดยใช้คำสั่ง loop ตามค่า ที่ config ด้านบน -->
					</tr>
<?php /* -------- */ ?>

<?php
// start=====================ส่วนในการค้นหา(ถ้ามีคำค้นหา ถ้าไม่มี กระโดนลงไปข้างล่าง===(ไม่ต้องแก้ไข)
$s = trim ( $_POST [s] );
if ($s != "") {
	echo finwebper ( $_GET ['f'], 'search' );
	// $quersearch="WHERE (m_id LIKE '%".$s."%' or m_name LIKE '%".$s."%' )";
	$Query = $db->query ( "SELECT * FROM " . $dbcp . " $quersearch" );
	// end=====================ส่วนในการค้นหา======================================
} else {

	// Start===================คำนวนการแบ่างหน้า===============================(ไม่ต้องแก้ไข)
	// Get All filed Data...
	$all_data = $db->rows ( $db->query ( "SELECT * FROM " . $dbcp . " WHERE 1" ) );
	// Page Control
	// อ่านลำดับเพจปัจจุบันจาก query string หากไม่มีแสดงว่าเป็นเพจแรก
	$page = intval ( $_GET ['page'] );
	if (! $page)
		$page = 1;

		// คำนวณหาแถวเริ่มต้นของเพจนั้นๆ
	$start = ($page - 1) * $number_per_page;

	// คำนวณหาเพจทั้งหมดที่สามารถแบ่งได้ โดยปัดเศษทศนิยมทิ้ง
	$all_page = floor ( $all_data / $number_per_page );

	// mod แล้วให้บวก 1 เป็นการปัดเศษจากการหารขึ้นนั่นเอง
	if ($all_data % $number_per_page)
		$all_page ++;

		// End===================จบการคำนวนการแบ่งหน้า============================

	// Start==================ตรวจสอบว่าไม่มีคำที่ต้องการค้นหา ให้เริ่มตรงนี้==============(ไม่ต้องแก้ไข)

	$Query = $db->query ( "	SELECT * FROM " . $dbcp . " ORDER BY " . $value [1] . " ASC LIMIT {$start},{$number_per_page}" ); // สร้างตาราง

	// End==================ตรวจสอบว่าไม่มีคำที่ต้องการค้นหา ให้เริ่มตรงนี้==============
}

// Start =================เริ่มแสดงตาราง==========================
$sum = $db->rows ( $Query );
if ($sum) {
	$i = 0;
	while ( $showme = $db->fetch ( $Query ) ) {
		$i ++;
		$showid = $showme->$value [1];
		// start==============ส่วนที่แก้ไข==============
		?>
                            <tr
						bgcolor=<?php echo $colors[$i%count($colors)]; ?>>
						<td><?php echo $showme->$value[2]; ?></td>
						<td><?php echo $showme->$value[13]; ?></td>
						<td><?php echo $showme->$value[11]; ?></td>
						<td><?php echo $showme->$value[0]; ?></td>
						<td><?php echo $showme->$value[35]; ?></td>
						<td><?php echo $showme->$value[35]; ?></td>


					</tr>
<?php
	}
} else {
	?>
                        <tr>
						<td colspan="6" class="center">ไม่พบรายการสมาชิก</td>
					</tr>
<?php } ?>
<?php //end =================จบการแสดงตาราง========================== ?>

                </table>
			</div></td>
	</tr>
</table>
<center>
<?php
// เรียกใช้งาน function SplitPageใน function.php
SplitPage ( $page, $all_page, "?f=" . $_GET ['f'] . "&page=" );
// ตรงกลางต้องใส่ url ของเว็บไซต์แล้วต้องตามด้วย page= เสมอ .. ไม่เกี่ยวนะ
?>
</center>

<div style="margin-top: 50px;" class="dot-header">
	<div style="margin-top: 20px;">
		<!-- Comment By mod  เปิดดูข้อมูล-->
<?php
if ($action == "add") {
	echo finwebper ( $_GET ['f'], $_GET ['action'] );
	?>
            <div align="center">
			<form action="index.php?f=<?php echo $_GET[f]; ?>&action=saveadd"
				method="post" enctype="multipart/form-data" name="form1">
				<table width="95%" border="1" cellspacing="5" cellpadding="5">
					<tr>
						<td colspan="2"><div align="center">
								<a name="link1"> <label for="1">กรุณาเลือก File ที่จะนำเข้า
										Databases (File CSV)</label>

							</div></td>
					</tr>
					<tr>
						<td><div align="right">กรุณาเลือกFile CSV</div></td>
						<td width="50%"><div align="center">
								<input type="file" name="cvsfile" id="1" />
							</div></td>
					</tr>
					<tr>
						<td colspan="2"><div align="right">
								<input type="submit" name="button" id="button" value="Submit" />
							</div></td>
					</tr>
				</table>
			</form>
		</div>
<?php
} else if ($action == "saveadd") {
	if ($extension == '.csv') {
		?>
<table width="750" border="1">
			<tr>
				<th width="91">
					<div align="center">Asset</div>
				</th>
				<th width="198">
					<div align="center">Username</div>
				</th>
				<th width="50">
					<div align="center">Department</div>
				</th>
				<th width="50">
					<div align="center">Devicetype</div>
				</th>
				<th width="100">
					<div align="center">IPAddress</div>
				</th>
				<th width="100">
					<div align="center">Host Name</div>
				</th>
			</tr>
<?php
		if (move_uploaded_file ( $_FILES ["cvsfile"] ["tmp_name"], $uploads_dir . $filename )) { // copy File ไปไว้ที่ Flolder ที่ต้องการ
			$objCSV = fopen ( $uploads_dir . $filename, "r" ); // อ่าน File ใน Folder ที่เรา พึ่ง Copy,k
			while ( ($objArr = fgetcsv ( $objCSV, 1000, "," )) !== FALSE ) { // เอา File เข้า Array
				$comsql = $db->query ( "SELECT * FROM " . $dbcp . " where asset = '$objArr[1]' " );
				$numrow = $db->rows ( $comsql ); // ตรวจสอบ ดูค่าที่จะเพิ่มเข้าไปในระบบ มีซ้ำ หรือเปล่า แล้วเอาค่าออกมาเป็นจำนวนแถ็ว
				                                 // echo $numrow;
				$couobjArr = count ( $objArr );
				$couvalue = (count ( $value ) - 1);
				$sumarray = array ();
				$i = 1;
				$n = 0;
				while ( $i <= $couvalue ) { // ทำการ Merge Data เข้าด้วยกัน ชื่อ Field กับ Data ดูคำอธิบายด้านล่าง
					$sumarray [$value [$i]] = $objArr [$n]; // $value จะเริ่มDataที่ 1 ส่วน $objArr จะเริ่มDataที่ 0
					$i ++;
					$n ++;
					// echo $n;
					/*
					 * echo $sumarray[devicetype].'<br>'; // ทำการ แสดง Data ของ Aseet ออกมา ซึ่งจะเก็บ เป็น Array echo $sumarray[asset].'<br>'; echo $sumarray[devicename].'<br>'; echo $sumarray[manufacturer].'<br>'; echo $sumarray[description].'<br>'; echo $sumarray[convena].'<br>'; echo $sumarray[conda].'<br>'; echo $sumarray[assetstatus].'<br>'; echo $sumarray[pas].'<br>'; echo $sumarray[plandate].'<br>'; echo $sumarray[lasttrackeddate].'<br>'; echo $sumarray[department].'<br>'; echo $sumarray[location].'<br>'; echo $sumarray[username].'<br>'; echo $sumarray[account].'<br>'; echo $sumarray[email].'<br>'; echo $sumarray[phone].'<br>'; echo $sumarray[os].'<br>'; echo $sumarray[msoff].'<br>'; echo $sumarray[msvisio].'<br>'; echo $sumarray[prokeywin].'<br>'; echo $sumarray[prokeyoff].'<br>'; echo $sumarray[prokeyvisio].'<br>'; echo $sumarray[serialdisplay].'<br>'; echo $sumarray[rdt].'<br>'; echo $sumarray[lmd].'<br>'; echo $sumarray[model].'<br>'; echo $sumarray[serial].'<br>'; echo $sumarray[processor].'<br>'; echo $sumarray[totalmem].'<br>'; echo $sumarray[storage].'<br>'; echo $sumarray[freestorage].'<br>'; echo $sumarray[ipadd].'<br>'; echo $sumarray[submask].'<br>'; echo $sumarray[macaddress].'<br>'; echo $sumarray[hostname].'<br>'; echo $sumarray[opersys].'<br>'; echo $sumarray[displaytype].'<br>'; echo $sumarray[displaysize].'<br>'; echo $sumarray[displaygraphic].'<br>'; echo $sumarray[udid].'<br>'; echo $sumarray[imei].'<br>'; echo $sumarray[iccid].'<br>'; echo $sumarray[conphone].'<br>';
					 */
				}
				echo $sumarray [devicetype] . '<br>'; // ทำการ แสดง Data ของ Aseet ออกมา ซึ่งจะเก็บ เป็น Array
				echo $sumarray [asset] . '<br>';
				echo $sumarray [devicename] . '<br>';
				echo $sumarray [manufacturer] . '<br>';
				echo $sumarray [description] . '<br>';
				echo $sumarray [convena] . '<br>';
				echo $sumarray [conda] . '<br>';
				echo $sumarray [assetstatus] . '<br>';
				echo $sumarray [pas] . '<br>';
				echo $sumarray [plandate] . '<br>';
				echo $sumarray [lasttrackeddate] . '<br>';
				echo $sumarray [department] . '<br>';
				echo $sumarray [location] . '<br>';
				echo $sumarray [username] . '<br>';
				echo $sumarray [account] . '<br>';
				echo $sumarray [email] . '<br>';
				echo $sumarray [phone] . '<br>';
				echo $sumarray [os] . '<br>';
				echo $sumarray [msoff] . '<br>';
				echo $sumarray [msvisio] . '<br>';
				echo $sumarray [prokeywin] . '<br>';
				echo $sumarray [prokeyoff] . '<br>';
				echo $sumarray [prokeyvisio] . '<br>';
				echo $sumarray [serialdisplay] . '<br>';
				echo $sumarray [rdt] . '<br>';
				echo $sumarray [lmd] . '<br>';
				echo $sumarray [model] . '<br>';
				echo $sumarray [serial] . '<br>';
				echo $sumarray [processor] . '<br>';
				echo $sumarray [totalmem] . '<br>';
				echo $sumarray [storage] . '<br>';
				echo $sumarray [freestorage] . '<br>';
				echo $sumarray [ipadd] . '<br>';
				echo $sumarray [submask] . '<br>';
				echo $sumarray [macaddress] . '<br>';
				echo $sumarray [hostname] . '<br>';
				echo $sumarray [opersys] . '<br>';
				echo $sumarray [displaytype] . '<br>';
				echo $sumarray [displaysize] . '<br>';
				echo $sumarray [displaygraphic] . '<br>';
				echo $sumarray [udid] . '<br>';
				echo $sumarray [imei] . '<br>';
				echo $sumarray [iccid] . '<br>';
				echo $sumarray [conphone] . '<br>';

				if (empty ( $numrow )) {



					?>
<tr>
				<td><div align="center"><?= $objArr[1]; ?></div></td>
				<td><?= $objArr[13]; ?></td>
				<td><?= $objArr[11]; ?></td>
				<td><div align="lift"><?= $objArr[0]; ?></div></td>
				<td align="center"><?= $objArr[32]; ?></td>
				<td align="lift"><?= $objArr[35]; ?></td>
			</tr>
<?php
					$add = $db->add_db ( $dbcp, $sumarray );
					if ($add) {
						// getJavaAlert("เพิ่มข้อมูลสำเร็จ", 0);
					} else {
						getJavaAlert ( "เพิ่มข้อมูลล้มเหลวกรุณาตรวจสอบด้วยครับ.....!!!!", 0 );
					}
				}
			}
		}
	} else {
		getJavaAlert ( "กรุณาเลือก File CVS เท่านั้น แต่คุณเลือก File $extension ไม่สามารถนำDatabase เข้า Database ได้นะครับ", 0 );
		_go ( "index.php" );
	}
	?>
</table>
<?php
} else if ($action == "edit") {
	echo finwebper ( $_GET ['f'], $_GET ['action'] );
	?>
               <div align="center">
			<form action="index.php?f=<?php echo $_GET[f]; ?>&action=saveedit"
				method="post" enctype="multipart/form-data" name="form1">
				<table width="95%" border="1" cellspacing="5" cellpadding="5">
					<tr>
						<td colspan="2"><div align="center">
								<a name="link1"> <label for="1">กรุณาเลือก File ที่จะนำเข้า
										Databases (File CSV)</label>

							</div></td>
					</tr>
					<tr>
						<td><div align="right">กรุณาเลือกFile CSV</div></td>
						<td width="50%"><div align="center">
								<input type="file" name="cvsfile" id="1" />
							</div></td>
					</tr>
					<tr>
						<td colspan="2"><div align="right">
								<input type="submit" name="button" id="button" value="Submit" />
							</div></td>
					</tr>
				</table>
			</form>
		</div>
<?php
} else if ($action == "saveedit") {
	if ($extension == '.csv') {
		?>
<table width="750" border="1">
			<tr>
				<th width="91">
					<div align="center">Asset</div>
				</th>
				<th width="198">
					<div align="center">Username</div>
				</th>
				<th width="50">
					<div align="center">Department</div>
				</th>
				<th width="50">
					<div align="center">Devicetype</div>
				</th>
				<th width="100">
					<div align="center">IPAddress</div>
				</th>
				<th width="100">
					<div align="center">Host Name</div>
				</th>
			</tr>
<?php
		if (move_uploaded_file ( $_FILES ["cvsfile"] ["tmp_name"], $uploads_dir . $filename )) { // copy File ไปไว้ที่ Flolder ที่ต้องการ
			$objCSV = fopen ( $uploads_dir . $filename, "r" ); // อ่าน File ใน Folder ที่เรา พึ่ง Copy,k
			while ( ($objArr = fgetcsv ( $objCSV, 1000, "," )) !== FALSE ) { // เอา File เข้า Array
				$comsql = $db->query ( "SELECT * FROM " . $dbcp . " where asset = '$objArr[1]' " );
				$numrow = $db->rows ( $comsql ); // ตรวจสอบ ดูค่าที่จะเพิ่มเข้าไปในระบบ มีซ้ำ หรือเปล่า แล้วเอาค่าออกมาเป็นจำนวนแถ็ว
				                                 // echo $numrow;
				$couobjArr = count ( $objArr );
				$couvalue = (count ( $value ) - 1);
				$sumarray = array ();
				$i = 1;
				$n = 0;
				while ( $i <= $couvalue ) { // ทำการ Merge Data เข้าด้วยกัน ชื่อ Field กับ Data ดูคำอธิบายด้านล่าง
					$sumarray [$value [$i]] = $objArr [$n]; // $value จะเริ่มDataที่ 1 ส่วน $objArr จะเริ่มDataที่ 0
					$i ++;
					$n ++;
					// echo $sumarray[asset] // ทำการ แสดง Data ของ Aseet ออกมา ซึ่งจะเก็บ เป็น Array
				}

				?>
<tr>
				<td><div align="center"><?= $objArr[1]; ?></div></td>
				<td><?= $objArr[13]; ?></td>
				<td><?= $objArr[11]; ?></td>
				<td><div align="lift"><?= $objArr[0]; ?></div></td>
				<td align="center"><?= $objArr[32]; ?></td>
				<td align="lift"><?= $objArr[35]; ?></td>
			</tr>
<?php

				$save = $db->update_db ( $dbcp, $sumarray, "$value[2] = '" . $objArr [1] . "'" );
				if ($save) {
					// getJavaAlert("เพิ่มข้อมูลสำเร็จ", 0);
				} else {
					getJavaAlert ( "Update ข้อมูลล้มเหลวกรุณาตรวจสอบด้วยครับ.....!!!!", 0 );
				}
			}
		}
	} else {
		getJavaAlert ( "กรุณาเลือก File CVS เท่านั้น แต่คุณเลือก File $extension ไม่สามารถนำDatabase เข้า Database ได้นะครับ", 0 );
		_go ( "index.php" );
	}
	?>
</table>
<?php
} else if ($action == "del") {
	echo finwebper ( $_GET ['f'], $_GET ['action'] );
	// $del = $db->del(_ORDER,"o_mid = '".$id."'"); // บรรทัดนี้ ตามไปลบใน Order ด้วย สามารถใส่เพิ่มได้ตามต้องการ
	$del = $db->del ( $dbcp, $value [1] . " = '" . $id . "'" );
	if ($del) {
		getJavaAlert ( "ลบข้อมูลสำเร็จ", 0 );
	} else {
		getJavaAlert ( "ลบข้อมูลล้มเหลว", 0 );
	}
	_go ( "index.php?f=" . $_GET ['f'] );
}
?>


    </div>
</div>
