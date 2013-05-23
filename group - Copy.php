<?php
echo fpermiss($_GET['f']);  // ตรวจสอบสิทธิในการเข้าถึง
?>
<h1>Group</h1>
<div>
<?php
	echo fperurl($_GET['f'], 'add', '', 'เพิ่มGroup', $wurl3->mp_aper);
?>  
</div>
<!-- ช่องเลือก การค้นหา ที่เป็น DropDownList  Comment By mod-->
<table width="95%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td><div align="right">
      <form name="form1" method="post" action="index.php?f=<?php echo $_GET[f];?>">
        <input name="s" type="text" id="s" value="<?php echo $_POST[s];?>">
        <select name="t" id="t">
		<option value="">ค้นหาจาก</option>
		<option value="monogram" <?php if($_POST[t] == "g_monogram"){?> selected="selected"<?php } ?>> ชื่อย่อแผนก</option>
		<option value="name" <?php if($_POST[t] == "g_name"){?> selected="selected"<?php } ?>>ชื่อเต็มแผนก</option>
        </select>
        <input type="submit" name="Submit" value="ค้นหา">
                        </form>
      </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <table width="80%" style="margin-top:50px;" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td width="15%"><div align="center">ชื่อย่อแผนก</div></td>
          <td width="37%"><div align="center">ชื่อเต็มแผนก</div></td>
          <td width="37%"><div align="center">การกระทำ</div></td>
        </tr>
<?php /* -------- */ ?>

<?php
	$s = trim($_POST[s]);
	$Query = "";
	if ($s != "") {
		switch ($_POST[t]) {
		case "monogram":
			$Query = $db->query("SELECT * FROM "._GRO." WHERE g_monogram LIKE "."'"."%".$s."%"."' ");
			break;
		case "name":
			$Query = $db->query("SELECT * FROM "._GRO." WHERE g_name LIKE "."'"."%".$s."%"."' ");
			break;
		}
	} else {
//======================คำนวนการแบ่างหน้า===============================
		//Setting Page
		//$number_per_page = 10; //กำหนดให้แสดง 10 แถวต่อเพจ
		// Get All filed Data...
		//$all_data = $db->query("SELECT COUNT(m_id) AS data FROM "._MEMBER)->fetch_object()->data;
	   	$all_data = $db->rows($db->query("SELECT * FROM "._GRO." WHERE 1"));
		//echo $all_data;

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

		//======================จบการคำนวนการแบ่งหน้า============================		

		$Query = $db->query("	SELECT * FROM "._GRO." ORDER BY g_id  ASC LIMIT {$start},{$number_per_page}"); //สร้างตาราง
	}
	$sum = $db->rows($Query);
	//echo $sum;
	if ($sum) {
		while ($group = $db->fetch($Query)) {
?>
        <tr>
          <td><center><?php echo $group->g_monogram; ?></center></td>
          <td><center><?php echo $group->g_name; ?></center></td>
          <td><div align="center">
          
          <?php
          $idpermiss=$group->g_id;
          $monogram=$group->g_monogram;
			echo fperurl($_GET['f'], 'open', "$idpermiss", 'เปิดดู', $wurl3->mp_oper).fperurl($_GET['f'], 'edit', "$idpermiss", 'แก้ไข', $wurl3->mp_eper);
			echo fperurl($_GET['f'], 'del', "$idpermiss", 'ลบ', $wurl3->mp_dper).fperurl('permis', '', $monogram, 'สิทธิ', '');
?>
		  </div></td>
        </tr>
<?php }

	} else {
?>	
<tr>
   <td colspan="3" class="center">ไม่พบรายการสมาชิก</td>
</tr>
<?php } ?>
<?php /* -------- */ ?>

      </table>
    </div></td>
  </tr>
</table>
<center>
<?php
	//เรียกใช้งาน function SplitPageใน function.php  แบ่งหน้า
	SplitPage($page, $all_page, "?f=".$_GET['f']."&page=");
	//ตรงกลางต้องใส่ url ของเว็บไซต์แล้วต้องตามด้วย page= เสมอ .. ไม่เกี่ยวนะ
?>
</center>

<div style="margin-top:50px;" class="dot-header">
<div style="margin-top:20px;">
<!-- Comment By mod  เปิดดูข้อมูล-->
<?php
	if ($action == "open") {
		$m = $db->fetch($db->query("SELECT * FROM "._GRO." WHERE g_id = '".$id."' "));
		if ($m->g_id) {
?>
<div class="center">
  <div align="center" id="showdata">
    <table width="500" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><div align="center"><a name="link1">ข้อมูล Group</a></div></td>
        </tr>
      <tr>
        <td width="120"><div align="right">ชื่อย่อ Group</div></td>
        <td width="374"><div align="left"><?php echo $m->g_monogram; ?> </div></td>
      </tr>
      <tr>
        <td><div align="right">ชื่อเต็ม Group</div></td>
        <td><?php echo $m->g_name; ?></td>
      </tr>
      <tr>
        <td><div align="right">หมายเหตุ</div></td>
        <td><?php echo $m->g_remark; ?></td>
      </tr>
      <tr>
        <td><div align="right">การกระทำ</div></td>
        <td>
        <?php
			echo fperurl($_GET['f'], 'edit', "$idpermiss", 'แก้ไข', $wurl3->mp_eper);
			echo fperurl($_GET['f'], 'del', "$idpermiss", 'ลบ', $wurl3->mp_dper).fperurl('permis', '', $monogram, 'สิทธิ', '');
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
?>
	<div align="center">
	    <form name="form2" method="post" action="index.php?f=<?php echo $_GET[f];?>&action=saveadd">
	      <table width="500" border="0" cellspacing="5" cellpadding="5">
            <tr>
              <td colspan="2"><div align="center"><a name="link1">กรอกข้อมูลGroup</a></div></td>
            </tr>
            <tr>
              <td width="120"><div align="right">ชื่อย่อGroup</div></td>
              <td width="374"><input name="monogram" type="text" id="monogram" size="50"></td>
            </tr>
            <tr>
              <td width="120"><div align="right">ชื่อเต็มGroup</div></td>
              <td width="374"><input name="name" type="text" id="name" size="50"></td>
            </tr>
            <tr>
              <td width="120"><div align="right">หมายเหตุ</div></td>
              <td width="374"><input name="remark1" type="text" id="remark1" size="50"></td>
            </tr>
            <tr>
              <td><div align="right"></div></td>
              <td><input type="submit" name="Submit2" value="เพิ่มGroup"></td>
            </tr>
          </table>
                </form>
      </div>
<?php
	} else if ($action == "saveadd") {
		$check = $db->fetch($db->query("
			SELECT COUNT(g_id) AS data
			FROM "._GRO."
			WHERE g_monogram = '".trim($_POST[monogram])."'
		"));
		if ($check->data) {
			getJavaAlert("ชื่อ Group ซ้ำในระบบ");
		} else {
			$add = $db->add_db(_GRO, array(
				"g_monogram" => trim($_POST[monogram]),
				"g_name" => trim($_POST[name]),
				"g_remark" => trim($_POST[remark1]), ));
			/*$add=$db->add_db(_MEMBER,array(
			 * "m_username"=>trim($_POST[username]),
			 * "m_password"=>trim($_POST[password]),
			 * "m_title"=>trim($_POST[title]),
			 * "m_name"=>trim($_POST[name]),
			 * "m_surname"=>trim($_POST[surname]),
			 * "m_email"=>trim($_POST[email]),
			 * "m_address"=>trim($_POST[address]),
			 * "m_tel"=>trim($_POST[tel]),));*/
			if ($add) {
				getJavaAlert("เพิ่มสมาชิกสำเร็จ", 0);
			} else {
				getJavaAlert("เพิ่มสมาชิกล้มเหลว", 0);
			}
			_go("index.php?f=".$_GET['f']);
		}
	} else if ($action == "edit") {
		// comment by mod ส่วนนี้เป็นการแก้ไขข้อมูล
		$m = $db->fetch($db->query("
			SELECT *
			FROM "._GRO."
			WHERE g_id = '".$id."'
		"));
		if ($m->g_id) {
?>
<div align="center">
	    <form name="form3" method="post" action="index.php?f=<?php echo $_GET[f];?>&action=saveedit&id=<?php echo $id;?>">
	      <table width="500" border="0" cellspacing="5" cellpadding="5">
            <tr>
              <td colspan="2"><div align="center"><a name="link1">กรอกข้อมูลสมาชิก</a></div></td>
            </tr>
            <tr>
              <td width="120"><div align="right">ชื่อย่อGroup</div></td>
              <td width="374"><input name="monogram" type="text" id="monogram" value="<?php echo $m->g_monogram;?>" size="50"></td>
            </tr>
            <tr>
              <td width="120"><div align="right">ชื่อเต็มGroup</div></td>
              <td width="374"><input name="name" type="text" id="name" value="<?php echo $m->g_name;?>" size="50"></td>
            </tr>
            <tr>
              <td><div align="right">หมายเหตุ</div></td>
              <td><input name="remark" type="text" id="remark" value="<?php echo $m->g_remark;?>" size="50"></td>
            </tr>
            <tr>
              <td><div align="right"></div></td>
              <td><input type="submit" name="Submit2" value="แก้ไขข้อมูล"></td>
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
			$save = $db->update_db(_GRO, array("g_monogram" => trim($_POST[monogram]), "g_name" => trim($_POST[name]),"g_remark" => trim($_POST[remark]),), "g_id = '".$id."'");
			if ($save) {
				getJavaAlert("แก้ไขข้อมูลสำเร็จ", 0);
			} else {
				getJavaAlert("แก้ไขข้อมูลล้มเหลว", 0);
			}
		}
		_go("index.php?f=".$_GET['f']);
	} else if ($action == "del") {
		//$del = $db->del(_ORDER,"o_mid = '".$id."'");    // บรรทัดนี้ ตามไปลบใน Order ด้วย  สามารถใส่เพิ่มได้ตามต้องการ
		$del = $db->del(_GRO, "g_id = '".$id."'");
		if ($del) {
			getJavaAlert("ลบข้อมูลสำเร็จ", 0);
		} else {
			getJavaAlert("ลบข้อมูลล้มเหลว", 0);
		}
		_go("index.php?f=".$_GET['f']);
	}

?>


</div>
</div>
