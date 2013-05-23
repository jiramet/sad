<?php
$s = intval($_POST[s]);
$t = $_POST[t];
$fday = intval($_POST[fday]);
$fmonth = intval($_POST[fmonth]);
$fyear = intval($_POST[fyear]);
$tday = intval($_POST[tday]);
$tmonth = intval($_POST[tmonth]);
$tyear = intval($_POST[tyear]);
if(!$s){ $s = intval($_GET[s]); }
if(!$t){ $t = $_GET[t]; }
if(!$fday){ $fday = intval($_GET[fday]); }
if(!$fmonth){ $fmonth = intval($_GET[fmonth]); }
if(!$fyear){ $fyear = intval($_GET[fyear]); }
if(!$tday){ $tday = intval($_GET[tday]); }
if(!$tmonth){ $tmonth = intval($_GET[tmonth]); }
if(!$tyear){ $tyear = intval($_GET[tyear]); }
if($s != 0 and $t != "") $find = true;
if($fday and $fmonth and $fyear and $tday and $tmonth and $tyear) $range = true;

?>
<h1>ประวัติการซื้อขาย</h1>
<table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%"><div align="right">
      <form name="form1" method="post" action="index.php?f=data&fday=<?php echo $fday;?>&fmonth=<?php echo $fmonth;?>&fyear=<?php echo $fyear;?>&tday=<?php echo $tday;?>&tmonth=<?php echo $tmonth;?>&tyear=<?php echo $tyear;?>">
        <input name="s" type="text" id="s" value="<?php echo $s?$s:"";?>">
        <select name="t" id="t">
		<option value="">ค้นหาจาก</option>
		<option value="mid" <?php if($t=="mid"){?> selected="selected" <?php }?> >รหัสสมาชิก</option>
		<option value="pid" <?php if($t=="pid"){?> selected="selected" <?php }?>>รหัสสินค้า</option>
        </select>
        <input type="submit" name="Submit" value="ค้นหา">
                        </form>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><form name="form2" method="post" action="index.php?f=data&s=<?php echo $s;?>&t=<?php echo $t;?>">
      ระยะเวลาตั้งแต่
      <select name="fday" id="fday">
        <option value="">เลือกวัน</option>
        <?php for($i=1;$i<=31;$i++){ ?>
        <option value="<?php echo $i;?>" <?php if($fday == $i){?> selected="selected"<?php }?>><?php echo $i;?></option>
        <?php } ?>
      </select>
      <select name="fmonth" id="fmonth">
        <option value="">เลือกเดือน</option>
        <?php for($i=1;$i<=12;$i++){ ?>
        <option value="<?php echo $i;?>"<?php if($fmonth == $i){?> selected="selected"<?php }?>><?php echo $i;?></option>
        <?php } ?>
      </select>
      <select name="fyear" id="fyear">
        <?php for($i=(date("Y")+540);$i<=(date("Y")+547);$i++){ ?>
        <option value="<?php echo $i;?>" <?php if($i == (date("Y")+543) ){?> selected="selected"<?php } ?>><?php echo $i;?></option>
        <?php } ?>
      </select>
|  จนถึง
<select name="tday" id="tday">
  <option value="">เลือกวัน</option>
  <?php for($i=1;$i<=31;$i++){ ?>
  <option value="<?php echo $i;?>" <?php if($tday == $i){?> selected="selected"<?php }?>><?php echo $i;?></option>
  <?php } ?>
</select>
<select name="tmonth" id="tmonth">
  <option value="">เลือกเดือน</option>
  <?php for($i=1;$i<=12;$i++){ ?>
  <option value="<?php echo $i;?>" <?php if($tmonth == $i){?> selected="selected"<?php }?>><?php echo $i;?></option>
  <?php } ?>
</select>
<select name="tyear" id="tyear">
  <?php for($i=(date("Y")+540);$i<=(date("Y")+547);$i++){ ?>
  <option value="<?php echo $i;?>" <?php if($i == (date("Y")+543) ){?> selected="selected"<?php } ?>><?php echo $i;?></option>
  <?php } ?>
</select>

          <input type="submit" name="Submit2" value="แสดงผล">
    </form>      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td width="41%"><div align="center">รายการสินค้า</div></td>
        <td width="34%"><div align="center">ลูกค้า</div></td>
        <td width="25%"><div align="center">การกระทำ</div></td>
      </tr>
	  
<?php
$Query = "";
if($find == true and $range == false){
	if($t == "mid"){
		$Query = $db->query("SELECT * FROM "._ORDER." WHERE o_mid = '".$s."' ORDER BY o_id DESC");
	}else{
		$Query = $db->query("SELECT * FROM "._ORDER." WHERE o_pid = '".$s."' ORDER BY o_id DESC");
	}
}else if($find == false and $range == true){
	$Query = $db->query("
		SELECT * FROM "._ORDER." 
		WHERE (o_day >= '".$fday."' AND o_month >= '".$fmonth."' AND o_year >= '".$fyear."')
		AND (o_day <= '".$tday."' AND o_month <= '".$tmonth."' AND o_year <= '".$tyear."')
		ORDER BY o_id DESC
	");
}else if($find == true and $range == true){
	if($t == "mid"){
		$Query = $db->query("
			SELECT * FROM "._ORDER." 
			WHERE (o_day >= '".$fday."' AND o_month >= '".$fmonth."' AND o_year >= '".$fyear."')
			AND (o_day <= '".$tday."' AND o_month <= '".$tmonth."' AND o_year <= '".$tyear."')
			AND o_mid = '".$s."'
			ORDER BY o_id DESC
		");
	}else{
		$Query = $db->query("
			SELECT * FROM "._ORDER." 
			WHERE (o_day >= '".$fday."' AND o_month >= '".$fmonth."' AND o_year >= '".$fyear."')
			AND (o_day <= '".$tday."' AND o_month <= '".$tmonth."' AND o_year <= '".$tyear."')
			AND o_pid = '".$s."'
			ORDER BY o_id DESC
		");
	}
}else{
	$Query = $db->query("SELECT * FROM "._ORDER." ORDER BY o_id DESC");
}

if($db->rows($Query)){
	while($data = $db->fetch($Query)){
	$product = $db->fetch($db->query("SELECT p_name FROM "._PRODUCT." WHERE p_id = '".$data->o_pid."'"));
	$member = $db->fetch($db->query("SELECT m_name FROM "._MEMBER." WHERE m_id = '".$data->o_mid."'"));
?>  
      <tr>
        <td><?php echo $product->p_name;?></td>
        <td><?php echo $member->m_name;?></td>
        <td class="center">[ <a href="index.php?f=data&id=<?php echo $data->o_id;?>&action=open#showdata">เปิดดู</a> ] | [ <a href="index.php?f=data&id=<?php echo $data->o_id;?>&action=del" onClick="return confirm('คุณต้องการลบบันทึกนี้ ?')">ลบรายการ</a> ] </td>
      </tr>
<?php 
	}
}else{
?>  

      <tr>
        <td colspan="3">ไม่พบข้อมูลการบันทึก</td>
      </tr>
<?php } ?>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<BR><BR>
<div class="dot-header">
<BR><BR>
<div id="showdata" align="center">
<?php
if($action == "open"){
$data = $db->fetch($db->query("SELECT * FROM "._ORDER." WHERE o_id = '".$id."'"));
if($data->o_id){
$product = $db->fetch($db->query("SELECT * FROM "._PRODUCT." WHERE p_id = '".$data->o_pid."'"));
	$member = $db->fetch($db->query("SELECT * FROM "._MEMBER." WHERE m_id = '".$data->o_mid."'"));
?>
  <table width="600" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td colspan="2"><div align="center">ข้อมูลการสั่งซื้อสินค้า</div></td>
      </tr>
	   <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td width="150"><div align="right">สินค้า : </div></td>
        <td width="450">[<?php echo $product->p_id;?>] - <?php echo $product->p_name;?> - [ <a href="index.php?f=pro&action=open&id=<?php echo $product->p_id;?>" target="_blank">ดูข้อมูลสินค้า</a> ]</td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td><div align="right">ลูกค้า : </div></td>
        <td>[<?php echo $member->m_id;?>] - <?php echo $member->m_name;?> - [ <a href="index.php?f=member&action=open&id=<?php echo $member->m_id;?>" target="_blank">ดูข้อมูลลูกค้า</a> ]</td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td><div align="right">จำนวนที่สั่งซื้อ : </div></td>
        <td><?php echo $data->o_item;?> ชิ้น</td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td><div align="right">ราคา / ชิ้น :  </div></td>
        <td><?php echo $product->p_price;?>.- บาท</td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td><div align="right">ราคาสินค้าที่สั่งซื้อ : </div></td>
        <td><?php echo $data->o_item * $product->p_price;?>.- บาท</td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td><div align="right">ส่วนลด : </div></td>
        <td><?php echo $data->o_price - ( $data->o_item * $product->p_price) ;?>.- บาท</td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td><div align="right">ราคาสินค้าทั้งหมด : </div></td>
        <td><?php echo $data->o_price ;?>.- บาท</td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td><div align="right">วันที่ซื้อสินค้า : </div></td>
        <td><?php echo $data->o_day." / ".$data->o_month." / ".$data->o_year;?></td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td><div align="right">สถานะการชำระเงิน : </div></td>
        <td><?php echo $data->o_status?"ชำระแล้ว":"ค้างชำระ";?></td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td><div align="right">หมายเหตุ  :  </div></td>
        <td><?php echo $data->o_note;?></td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
      <tr>
        <td><div align="right">การกระทำ : </div></td>
        <td> [ <a href="index.php?f=data&id=<?php echo $data->o_id;?>&action=del" onClick="return confirm('คุณต้องการลบบันทึกนี้ ?')">ลบรายการ</a> ]</td>
      </tr>
	  <tr><td colspan="2"><div class="dot-header"></div></td></tr>
    </table>
<?php
 }else{ getJavaAlert('ไม่พบข้อมูลรายการบันทึก'); }
}else if($action == "del"){
	$del = $db->del(_ORDER,"o_id = '".$id."'");
	if($del){
		getJavaAlert('ลบข้อมูลสำเร็จ',0);
	}else{
		getJavaAlert('ลบข้อมูลล้มเหลว',0);
	}
	_go("index.php?f=data");
}
?>
</div>
</div>
<BR><BR>
