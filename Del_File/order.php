<h1>บันทึกการซื้อสินค้า</h1>
<div align="center">
<?php 
if($_POST[p] == "YES"){
	$pid = intval($_POST[pid]);
	$mid = intval($_POST[mid]);
	$item = intval($_POST[item]);
	$day = intval($_POST[day]);
	$month = intval($_POST[month]);
	$year = intval($_POST[year]);
	$div = intval($_POST[div]);
	$note = $_POST[note];
	$pricedata = $db->fetch($db->query("
		SELECT p_price,p_all
		FROM "._PRODUCT."
		WHERE p_id = '".$pid."'
	"));
	$price = ($pricedata->p_price * $item ) - $div;
	if($pricedata->p_all >= $item){
		$update = $db->update(_PRODUCT,"p_all = '".($pricedata->p_all-$item)."'","p_id = '".$pid."'");
		if($update){
		
		}else{
			die(getJavaAlert("การอัพเดตจำนวนสินค้าล้มเหลว"));
		}
	}else{
		die(getJavaAlert("สินค้าไม่เพียงพอต่อการซื้อ"));
	}
	if($_POST[checkout] == "YES"){
	$add = $db->add_db(_ORDER,array(
			"o_mid"	=>	$mid,
			"o_pid"	=>	$pid,
			"o_item"	=>	$item,
			"o_price"	=>	$price,
			"o_day"	=>	$day,
			"o_month"	=>	$month,
			"o_year"	=>	$year,
			"o_status"	=>	1,
			"o_note"	=>	$note,
		));
	}else{
	$add = $db->add_db(_ORDER,array(
			"o_mid"	=>	$mid,
			"o_pid"	=>	$pid,
			"o_item"	=>	$item,
			"o_price"	=>	$price,
			"o_day"	=>	$day,
			"o_month"	=>	$month,
			"o_year"	=>	$year,
			"o_note"	=>	$note,
		));
	}
	if($add){
		getJavaAlert("บันทึกข้อมูลสำเร็จ",0);
		_go("index.php?f=order");
	}else{
		getJavaAlert("บันทึกข้อมูลล้มเหลว");
	}
}
?>
<form name="form1" method="post" action="">
  <table width="600" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td colspan="2"><div align="center">กรอกข้อมูลการซื้อ</div></td>
      </tr>
    <tr>
      <td width="109"><div align="right">สินค้าขาย</div></td>
      <td width="456"><select name="pid" id="pid">
	  <option value="">เลือกสินค้า</option>
	  <?php
	  	$Query = $db->query("
				SELECT p_id,p_name,p_all
				FROM "._PRODUCT."
				ORDER BY p_id DESC
			");
		while($p = $db->fetch($Query)){
			echo '<option value="'.$p->p_id.'">['.$p->p_id.'] - '.$p->p_name.' [ '.$p->p_all.' ชิ้น ]</option>';
		}
	  ?>
      </select>      </td>
    </tr>
    <tr>
      <td><div align="right">ผู้ซื้อ</div></td>
      <td><select name="mid" id="mid">
	  <option value="">เลือกสมาชิก</option>
	   <?php
	  	$Query = $db->query("
				SELECT m_id,m_name
				FROM "._MEMBER."
				ORDER BY m_id DESC
			");
		while($m = $db->fetch($Query)){
			echo '<option value="'.$m->m_id.'">['.$m->m_id.'] - '.$m->m_name.'</option>';
		}
	  ?>
            </select></td>
    </tr>
    <tr>
      <td><div align="right">จำนวนสินค้า</div></td>
      <td><input name="item" type="text" id="item" size="10">
        ชิ้น</td>
    </tr>
    <tr>
      <td><div align="right">วันที่สั่งซื้อ</div></td>
      <td>
	  
	  <select name="day" id="day">
		<option value="">เลือกวัน</option>
		<?php for($i=1;$i<=31;$i++){ ?>
		<option value="<?php echo $i;?>" <?php if(date("d") == $i){?> selected="selected"<?php } ?>><?php echo $i;?></option>  	
		<?php } ?>
	</select> 
			
			<select name="month" id="month">
			<option value="">เลือกเดือน</option> 
			<?php for($i=1;$i<=12;$i++){ ?>
		<option value="<?php echo $i;?>" <?php if(date("m") == $i){?> selected="selected"<?php } ?>><?php echo $i;?></option>  	
		<?php } ?> 
          </select>
      <select name="year" id="year">
	  <?php for($i=(date("Y")+540);$i<=(date("Y")+547);$i++){ ?>
		<option value="<?php echo $i;?>" <?php if($i == (date("Y")+543) ){?> selected="selected"<?php } ?>><?php echo $i;?></option>  	
		<?php } ?>
       </select>	   </td>
    </tr>
    <tr>
      <td><div align="right">ส่วนลด</div></td>
      <td><input name="div" type="text" id="div" size="10">
        บาท</td>
    </tr>
    <tr>
      <td><div align="right">หมายเหตุ </div></td>
      <td><input name="note" type="text" id="note" size="50"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="checkout" type="radio" value="YES" checked="checked" class="click">
        จ่ายเงินแล้ว
          <input name="checkout" type="radio" value="NO" class="click">
          ค้างชำระ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="บันทึกการสั่งซื้อ"></td>
    </tr>
  </table>
 <input name="p" value="YES" type="hidden">
</form> </div>
