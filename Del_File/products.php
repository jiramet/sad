<h1>ระบบจัดการสินค้า</h1>
<div>[ <a href="index.php?f=pro&action=add">เพิ่มสินค้า</a> ]</div>
<table width="95%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td><div align="right">
      <form name="form1" method="post" action="index.php?f=pro">
        <input name="s" type="text" id="s" value="<?php echo $_POST[s];?>">
        <select name="t" id="t">
		<option value="">ค้นหาจาก</option>
		<option value="id" <?php if($_POST[t] == "id"){?> selected="selected"<?php } ?>>รหัสสินค้า</option>
		<option value="name"<?php if($_POST[t] == "name"){?> selected="selected"<?php } ?>>ชื่อสินค้า</option>
		<option value="price" <?php if($_POST[t] == "price"){?> selected="selected"<?php } ?>>ราคาสินค้า</option>
		<option value="note" <?php if($_POST[t] == "note"){?> selected="selected"<?php } ?>>ข้อมูลสินค้า</option>
        </select>
        <input type="submit" name="Submit" value="ค้นหา">
                        </form>
      </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <table width="75%" style="margin-top:50px;" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td width="63%"><div align="center">รายการสินค้า</div></td>
          <td width="37%"><div align="center">การกระทำ</div></td>
        </tr>
<?php /* -------- */ ?>
<?php
$s = trim($_POST[s]);
$Query = "";
if($s != ""){
	switch($_POST[t]){
		case "id" : $Query = $db->query("SELECT * FROM "._PRODUCT." WHERE p_id LIKE "."'"."%".$s."%"."' "); break;
		case "name" : $Query = $db->query("SELECT * FROM "._PRODUCT." WHERE p_name LIKE "."'"."%".$s."%"."' "); break;
		case "price" : $Query = $db->query("SELECT * FROM "._PRODUCT." WHERE p_price LIKE "."'"."%".$s."%"."' "); break;
		case "note" : $Query = $db->query("SELECT * FROM "._PRODUCT." WHERE p_note LIKE "."'"."%".$s."%"."' "); break;
	}
}else{
	$Query = $db->query("
			SELECT *
			FROM "._PRODUCT."
			ORDER BY p_id DESC
		");
}
$sum = $db->rows($Query);
if($sum){
while($product = $db->fetch($Query)){
?>
        <tr>
          <td><?php echo $product->p_name;?></td>
          <td><div align="center">
		  
		  [ <a href="index.php?f=pro&action=open&id=<?php echo $product->p_id;?>#showdata">เปิดดู</a> ] | [ <a href="index.php?f=pro&action=edit&id=<?php echo $product->p_id;?>">แก้ไข</a> ] | [ <a href="index.php?f=pro&action=del&id=<?php echo $product->p_id;?>" onClick="return confirm('คุณต้องการลบ <?php echo $product->p_name;?> ?');">ลบ</a> ]
		  </div></td>
        </tr>
<?php }

}else{ ?>	
<tr>
   <td colspan="2" class="center">ไม่พบข้อมูลสินค้า</td>
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
if($action == "open"){
$p = $db->fetch($db->query("SELECT * FROM "._PRODUCT." WHERE p_id = '".$id."'"));
	if($p->p_id){
?>
<div class="center">
  <div align="center" id="showdata">
    <table width="500" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><div align="center">ข้อมูลสินค้า</div></td>
        </tr>
      <tr>
        <td width="120"><div align="right">รหัสสินค้า</div></td>
        <td width="374"><div align="left"><?php echo $p->p_id;?> </div></td>
      </tr>
      <tr>
        <td><div align="right">ชื่อสินค้า</div></td>
        <td><?php echo $p->p_name;?></td>
      </tr>
      <tr>
        <td><div align="right">ราคาสินค้า</div></td>
        <td><?php echo $p->p_price;?>.- บาท</td>
      </tr>
      <tr>
        <td><div align="right">จำนวนสินค้า</div></td>
        <td><?php echo $p->p_all;?> ชิ้น</td>
      </tr>
      <tr>
        <td><div align="right">ข้อมูลสินค้า</div></td>
        <td><?php echo $p->p_note;?></td>
      </tr>
      <tr>
        <td><div align="right">การกระทำ</div></td>
        <td>[ <a href="index.php?f=pro&action=edit&id=<?php echo $p->p_id;?>">แก้ไขข้อมูล</a> ] | [ <a href="index.php?f=pro&action=del&id=<?php echo $p->p_id;?>"  onClick="return confirm('คุณต้องการลบ <?php echo $p->p_name;?> ?');">ลบสินค้า</a> ] | [ <a href="index.php?f=data&s=<?php echo $p->p_id;?>&t=pid">ประวัติการซื้อสินค้า</a> ] </td>
      </tr>
    </table>
  </div>
</div>
<?php
	}else{ getJavaAlert("ไม่พบข้อมูลสมาชิก"); }
}else if($action == "add"){?>
	<div align="center">
	    <form name="form2" method="post" action="index.php?f=pro&action=saveadd">
	      <table width="500" border="0" cellspacing="5" cellpadding="5">
            <tr>
              <td colspan="2"><div align="center">กรอกข้อมูลสินค้า</div></td>
            </tr>
            <tr>
              <td width="120"><div align="right">ชื่อสินค้า</div></td>
              <td width="374"><input name="name" type="text" id="name" size="50"></td>
            </tr>
            <tr>
              <td><div align="right">ราคาสินค้า</div></td>
              <td><input name="price" type="text" id="price" size="50"></td>
            </tr>
            <tr>
              <td><div align="right">จำนวนสินค้า</div></td>
              <td><input name="all" type="text" id="all" size="50"></td>
            </tr>
            <tr>
              <td><div align="right">ข้อมูลสินค้า</div></td>
              <td><input name="note" type="text" id="note" size="50"></td>
            </tr>
            <tr>
              <td><div align="right"></div></td>
              <td><input type="submit" name="Submit2" value="เพิ่มสินค้า"></td>
            </tr>
          </table>
                </form>
      </div>
<?php
}else if($action == "saveadd"){
	$check = $db->fetch($db->query("
			SELECT COUNT(p_id) AS data
			FROM "._PRODUCT."
			WHERE p_name = '".trim($_POST[name])."'
		"));
	if($check->data){
		getJavaAlert("สินค้าซ้ำในระบบ");
	}else{
		$add = $db->add_db(_PRODUCT,array(
				"p_name"	=>	trim($_POST[name]),
				"p_price"	=>	intval(trim($_POST[price])),
				"p_all"		=>	intval(trim($_POST[all])),
				"p_note"	=>	trim($_POST[note]),
			));
		if($add){
			getJavaAlert("เพิ่มสินค้าสำเร็จ",0);
		}else{
			getJavaAlert("เพิ่มสินค้าล้มเหลว",0);
		}
		_go("index.php?f=pro");
	}
}else if($action == "edit"){
$p = $db->fetch($db->query("
			SELECT *
			FROM "._PRODUCT."
			WHERE p_id = '".$id."'
		"));
	if($p->p_id){
?>
<div align="center">
	    <form name="form3" method="post" action="index.php?f=pro&action=saveedit&id=<?php echo $id;?>">
	      <table width="500" border="0" cellspacing="5" cellpadding="5">
            <tr>
              <td colspan="2"><div align="center">กรอกข้อมูลสินค้า</div></td>
            </tr>
            <tr>
              <td width="120"><div align="right">ชื่อสินค้า</div></td>
              <td width="374"><input name="name" type="text" id="name" value="<?php echo $p->p_name;?>" size="50"></td>
            </tr>
            <tr>
              <td><div align="right">ราคาสินค้า</div></td>
              <td><input name="price" type="text" id="price" value="<?php echo $p->p_price;?>" size="50"></td>
            </tr>
            <tr>
              <td><div align="right">จำนวนสินค้า</div></td>
              <td><input name="all" type="text" id="all" value="<?php echo $p->p_all;?>" size="50"></td>
            </tr>
            <tr>
              <td><div align="right">ข้อมูลสินค้า</div></td>
              <td><input name="note" type="text" id="note" value="<?php echo $p->p_note;?>" size="50"></td>
            </tr>
            <tr>
              <td><div align="right"></div></td>
              <td><input type="submit" name="Submit2" value="แก้ไขข้อมูล"></td>
            </tr>
          </table>
                </form>
      </div>
<?php
	}else{ getJavaAlert("ไม่พบข้อมูลสินค้า"); }
}else if($action == "saveedit"){
	if($id){
		$save = $db->update_db(_PRODUCT,array(
			"p_name"	=>	trim($_POST[name]),
			"p_price"	=>	intval(trim($_POST[price])),
			"p_all"		=>	intval(trim($_POST[all])),
			"p_note"	=>	trim($_POST[note]),
		),"p_id = '".$id."'");	
		if($save){
			getJavaAlert("แก้ไขข้อมูลสำเร็จ",0);
		}else{
			getJavaAlert("แก้ไขข้อมูลล้มเหลว",0);
		}
	}
	_go("index.php?f=pro");
}else if($action == "del"){
	$del = $db->del(_ORDER,"o_pid = '".$id."'");
	$del = $db->del(_PRODUCT,"p_id = '".$id."'");
	if($del){
		getJavaAlert("ลบข้อมูลสำเร็จ",0);
	}else{
		getJavaAlert("ลบข้อมูลล้มเหลว",0);
	}
	_go("index.php?f=pro");
}
?>
</div>
</div>
