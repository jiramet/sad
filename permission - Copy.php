<h1>ระบบจัดการกำหนดสิทธิในการใช้งาน</h1>
<?php
	echo fpermiss($_GET['f']);  // ตรวจสอบสิทธิในการเข้าถึง
	$m = $db->fetch($db->query("SELECT * FROM "._MEMBER." WHERE m_id = ' ".$id." ' "));
	$t = $db->fetch($db->query("SELECT * FROM "._TITLE." WHERE t_id =  ' ".$m->m_title." '  "));
?>
&nbsp;&nbsp;<h2>กำหนดสิทธิของ <?php echo $t->t_title.$m->m_name.' '.$m->m_surname; ?></h2>
<table width="95%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td><div align="center">
      <table width="90%" style="margin-top:50px;" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td width="20%"><div align="center">ชื่อ Menu </div></td>
          <td width="5%"><div align="center">ดูweb </div></td>
          <td width="5%"><div align="center">เปิดดู</div></td>
          <td width="5%"><div align="center">เพิ่ม</div></td>
          <td width="5%"><div align="center">แก้ไข</div></td>
          <td width="5%"><div align="center">ลบ</div></td>
          <td width="5%"><div align="center">ค้นหา</div></td>
          <td width="5%"><div align="center">All</div></td>
          <td width="15%"><div align="center">การกระทำ</div></td>
        </tr>
<?php /* -------- */ ?>
<?php
	$s = trim($_POST[s]);
	$Query = $db->query("
			SELECT *
			FROM "._WURL."
			ORDER BY w_id
		");
	$sum = $db->rows($Query);
	if ($sum) {
		while ($url = $db->fetch($Query)) {
			$m = $db->fetch($db->query("
			SELECT *
			FROM "._MPER."
			WHERE mp_mid = '".$id."' and mp_wid = '".$url->w_id."'
		"));
?>
<div align="center">
 <form name="form2" method="post" action="index.php?f=permis&action=saveadd&id=<?php echo $id;?>&id_menu=<?php echo $url->w_id;?>">
        <tr>
          <td><?php echo $url->w_nmenu; ?></td>
		  <td align="center"><input name="wper" type="checkbox" value="1"  <?php if ($m->mp_wper==1) { echo "checked"; $a=1; }else{$a=0;} ?>/></td>
		  <td align="center"><input name="oper" type="checkbox" value="1" <?php if ($m->mp_oper==1) { echo "checked"; $b=1; }else{$b=0;}   ?>/></td>
		  <td align="center"><input name="aper" type="checkbox" value="1" <?php if ($m->mp_aper==1) { echo "checked"; $c=1 ; }else{$c=0;}  ?>/></td>
		  <td align="center"><input name="eper" type="checkbox" value="1" <?php if ($m->mp_eper==1) { echo "checked"; $d=1; }else{$d=0;} ?>/></td>
		  <td align="center"><input name="dper" type="checkbox" value="1" <?php if ($m->mp_dper==1) { echo "checked"; $e=1 ; }else{$e=0;} ?>/></td>
		  <td align="center"><input name="sper" type="checkbox" value="1" <?php if ($m->mp_sper==1) { echo "checked"; $f=1;  }else{$f=0;}  ?>/></td>
		  <td align="center"><input name="all" type="checkbox" value="1" <?php $check=($a+$b+$c+$d+$e+$f); if ($check==6) { echo "checked"; }?>/></td>
          <td align="center"><div align="center"><input name="test" type="submit" value="  บันทึก  " />  <input name="check" type="hidden" value="<?php echo $check; ?>"></div></td>
        </tr>
                </form>
      </div>
<?php }

	} else {
?>	
<tr>
   <td colspan="2" class="center">ไม่พบรายการสมาชิก</td>
</tr>
<?php } ?>
<?php /* -------- */ ?>
      </table>
    </div></td>
  </tr>
</table>


<div style="margin-top:50px;" class="dot-header">
<div style="margin-top:20px;">
<?php
	if ($action == "saveadd") {
		/*	if (fnc0(all)==1){
		 $ck=6;
		 }else {
		 $ck=0;
		 }*/
		$ch1 = $_POST[check]; //ค่าในครั้งแรกก่อนมีการเปลี่ยนแปลง
		$ch2 = (fnc0(wper) + fnc0(oper) + fnc0(aper) + fnc0(eper) + fnc0(dper) + fnc0(sper)); // ค่าที่ส่งกลับมา  นำมาบวกกันเพื่อเช็คว่ามีการเปลียนแปลงหรือเปล่า
		$num = $db->num_rows(_MPER, "mp_mid,mp_wid", "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
		//$num  หาว่ามีขอมูลอยู่ใน Database  อยู่หรือเปล่า  ถ้ามี Updata Database  ถ้าไม่มี  Add ลง Databases
		if ($num == 1) { //  ถ้ามีข้อมูลใน Data bases  จะใช้วิธีการ  Update data
			if (fnc0(all) == 1) {
				if ($ch1 == $ch2 and fnc0(all) == 1) {
					$save = $db->update_db(_MPER, array("mp_wper" => 1, "mp_oper" => 1, "mp_aper" => 1, "mp_eper" => 1, "mp_dper" => 1, "mp_sper" => 1), "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
					_go("index.php?f=permis&id=$id");
				} elseif (fnc0(wper) == 0 and $ch2 != 6 and fnc0(all) == 1) {
					$save = $db->update_db(_MPER, array("mp_wper" => 0, "mp_oper" => 0, "mp_aper" => 0, "mp_eper" => 0, "mp_dper" => 0, "mp_sper" => 0), "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
					_go("index.php?f=permis&id=$id");
				} elseif ($ch1 != $ch2) {
					$save = $db->update_db(_MPER, array("mp_wper" => fnc0(wper), "mp_oper" => fnc0(oper), "mp_aper" => fnc0(aper), "mp_eper" => fnc0(eper), "mp_dper" => fnc0(dper), "mp_sper" => fnc0(sper)), "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
					_go("index.php?f=permis&id=$id");
				}
			} elseif ($ch1 == 6 and fnc0(all) != 1) {
				$save = $db->update_db(_MPER, array("mp_wper" => 0, "mp_oper" => 0, "mp_aper" => 0, "mp_eper" => 0, "mp_dper" => 0, "mp_sper" => 0), "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
				#$save = $db->update_db(_MPER, array("mp_wper" => fnc0(wper), "mp_oper" => fnc0(oper), "mp_aper" => fnc0(aper), "mp_eper" => fnc0(eper), "mp_dper" => fnc0(dper), "mp_sper" => fnc0(sper)), "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
				_go("index.php?f=permis&id=$id");
			} elseif ($ch1 != $ch2 and fnc0(wper) == 1) {
				$save = $db->update_db(_MPER, array("mp_wper" => fnc0(wper), "mp_oper" => fnc0(oper), "mp_aper" => fnc0(aper), "mp_eper" => fnc0(eper), "mp_dper" => fnc0(dper), "mp_sper" => fnc0(sper)), "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
				_go("index.php?f=permis&id=$id");
			} elseif (fnc0(wper) == 0) {
				$save = $db->update_db(_MPER, array("mp_wper" => 0, "mp_oper" => 0, "mp_aper" => 0, "mp_eper" => 0, "mp_dper" => 0, "mp_sper" => 0), "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
				_go("index.php?f=permis&id=$id");
			}
		} elseif (fnc0(all) == 1) { //  แต่ถ้าไม่มี  ข้อมูลใน Databases  จะใช้วิธิ  เพิ่ม ข้อมูลใหม่
			$add = $db->add_db(_MPER, array("mp_mid" => trim($_GET[id]), "mp_wid" => trim($_GET[id_menu]), "mp_wper" => 1, "mp_oper" => 1, "mp_aper" => 1, "mp_eper" => 1, "mp_dper" => 1, "mp_sper" => 1));
			_go("index.php?f=permis&id=$id");
		} elseif (fnc0(wper) == 0) {
			//$save = $db->update_db(_MPER, array("mp_wper" => 0, "mp_oper" => 0, "mp_aper" => 0, "mp_eper" => 0, "mp_dper" => 0, "mp_sper" => 0), "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
			getJavaAlert("กรุณากลับไปกำหนดสิทธิ ดูweb ก่อน  แล้วจึงกำหนดสิทธิ อื่น ๆ ต่อไป", 0);
			_go("index.php?f=permis&id=$id");
		} else {
			$add = $db->add_db(_MPER, array("mp_mid" => trim($_GET[id]), "mp_wid" => trim($_GET[id_menu]), "mp_wper" => fnc0(wper), "mp_oper" => fnc0(oper), "mp_aper" => fnc0(aper), "mp_eper" => fnc0(eper), "mp_dper" => fnc0(dper), "mp_sper" => fnc0(sper)));
			_go("index.php?f=permis&id=$id");
		}

		/* if ($check <> 6 and  fnc0(all) <> 1) {
		 #$save = $db->update_db(_MPER, array("mp_wper" => 1, "mp_oper" => 1, "mp_aper" => 1, "mp_eper" => 1, "mp_dper" => 1, "mp_sper" => 1), "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
		 $save = $db->update_db(_MPER, array("mp_wper" => fnc0(wper), "mp_oper" => fnc0(oper), "mp_aper" => fnc0(aper), "mp_eper" => fnc0(eper), "mp_dper" => fnc0(dper), "mp_sper" => fnc0(sper)), "mp_mid=".trim($_GET[id])." and mp_wid=".trim($_GET[id_menu]));
		 if ($save) {
		 getJavaAlert("เพิ่มสมาชิกสำเร็จ1112".fnc0(wper), 0);
		 } else {
		 getJavaAlert("เพิ่มสมาชิกล้มเหลว1112".fnc0(wper), 0);
		 }
		 _go("index.php?f=permis&id=$id");
		 }*/

	}

?>
</div>
</div>
