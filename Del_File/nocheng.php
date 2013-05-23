<h1>รายการค้างชำระ</h1>
<div style=" margin-top:5px;" class="dot-footer"></div>

<div align="center" style="margin:25px 0;">
  <table width="600" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="405"><div align="center">รายการ</div></td>
      <td width="189"><div align="center">การกระทำ</div></td>
    </tr>
<?php
if($action == "active"){
	$update = $db->update(_ORDER,"o_status = 1","o_id = '".$id."'");
	if($update){
		getJavaAlert("ยืนยันการชำระสำเร็จ",0);
	}else{
		getJavaAlert("การยืนยันการชำระเงินล้มเหลว",0);
	}
	die(_go("index.php?f=".$_GET[f]));
}
$Query = $db->query("
		SELECT o_id,o_mid,o_pid
		FROM "._ORDER."
		WHERE o_status IS NULL
	");
if($db->rows($Query)){
	while($order = $db->fetch($Query)){
	$p = $db->fetch($db->query("
			SELECT p_name
			FROM "._PRODUCT."
			WHERE p_id = '".$order->o_pid."'
		"));
	$m = $db->fetch($db->query("
			SELECT m_name
			FROM "._MEMBER."
			WHERE m_id = '".$order->o_mid."'
		"));
?>	
	
    <tr>
      <td><?php echo $p->p_name;?> - [ <?php echo $m->m_name;?> ]</td>
      <td class="center"><div align="center">
	  
	  [ <a href="index.php?f=data&id=<?php echo $order->o_id;?>&action=open#showdata" target="_blank">ดูข้อมูล</a> ] |
	  [ <a href="index.php?f=<?php echo $_GET[f];?>&id=<?php echo $order->o_id;?>&action=active" onClick="return confirm('ยืนยัน การชำระเงินแล้ว ?')">ชำระแล้ว</a> ]
	  
	  
	  </div></td>
    </tr>
<?php }
}else{ ?>
    <tr>
      <td colspan="2"><div align="center">ไม่มีรายการค้างชำระ</div></td>
    </tr>
<?php } ?>
	
  </table>
</div>
<div class="dot-header"></div>
