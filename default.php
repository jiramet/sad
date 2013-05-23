<h1>ระบบจัดการ อนงค์การค้า</h1>
<div class="dot-header"></div>

<div style="margin:50px;" class="f16">
<?php
$sum_member = $db->fetch($db->query("SELECT COUNT(m_id) AS data FROM "._MEMBER.""));
?>
<div class="dot-footer">ณ ปัจจุบันมีสมาชิกอยู่ในระบบทั้งหมด  <span class="bold blue"><?php echo $sum_member->data; ?></span> คน</div>

<?php
$sum_title = $db->fetch($db->query("SELECT COUNT(t_id) AS data FROM "._TITLE.""));
?>
<div class="dot-footer">ณ มีคำนำหน้าชื่อ  <span class="bold blue"><?php echo $sum_title->data; ?></span> นาม</div>


<?php
$sum_product = $db->fetch($db->query("SELECT COUNT(p_id) AS data FROM "._PRODUCT.""));
?>
<div class="dot-footer">มีสินค้าอยู่ในระบบทั้งหมด  <span class="bold blue"><?php echo $sum_product->data; ?></span> ชนิด</div>


<?php
$sum_order = $db->fetch($db->query("SELECT COUNT(o_id) AS data FROM "._ORDER.""));
?>
<div class="dot-footer">และมีบันทึกการขายทั้งสิ้น  <span class="bold blue"><?php echo $sum_order->data; ?></span> รายการ</div>

<BR><BR>
<?php
$sum_product = $db->fetch($db->query("SELECT SUM(p_all) AS sum FROM "._PRODUCT.""));
?>
<div class="dot-footer">จากข้อมูลพบว่า มีสินค้าทั้งหมดในระบบ <span class="bold blue"><?php echo $sum_product->sum?$sum_product->sum:0; ?></span> ชิ้น</div>

<?php
$sum_order = $db->fetch($db->query("SELECT SUM(o_item) AS sum FROM "._ORDER.""));
?>
<div class="dot-footer">และมียอดขายไปแล้ว <span class="bold blue"><?php echo $sum_order->sum?$sum_order->sum:0; ?></span> ชิ้น</div>

<?php
$sum_price = $db->fetch($db->query("SELECT SUM(o_price) AS sum FROM "._ORDER.""));
?>
<div class="dot-footer">รวมเป็นเงินมูลค่าทั้งสิ้น <span class="bold blue"><?php echo $sum_price->sum?$sum_price->sum:0; ?></span> บาท</div>


<?php
$sum_price = $db->fetch($db->query("SELECT SUM(o_price) AS sum FROM "._ORDER." WHERE o_status IS NOT NULL"));
?>
<div class="dot-footer">เป็นเงินที่ชำระแล้ว <span class="bold blue"><?php echo $sum_price->sum?$sum_price->sum:0; ?></span> บาท</div>

<?php
$sum_price = $db->fetch($db->query("SELECT SUM(o_price) AS sum FROM "._ORDER." WHERE o_status IS NULL"));
?>
<div class="dot-footer">และยังไม่ได้ชำระอีก <span class="bold red"><?php echo $sum_price->sum?$sum_price->sum:0; ?></span> บาท</div>

<?php
$sum_price = $db->fetch($db->query("SELECT COUNT(o_price) AS sum FROM "._ORDER." WHERE o_status IS NULL"));
?>
<div class="dot-footer">โดยรวมรายการที่ยังไมได้ชำระทั้งสิ้น <span class="bold pink"><?php echo $sum_price->sum?$sum_price->sum:0; ?></span> รายการ</div>





</div>