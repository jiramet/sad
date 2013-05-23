<?php
//---class แบ่งเพจ---//
require_once('cls_padding.php');     //เรียกใช้งาน class
//---ติดต่อฐานข้อมูล---//
mysql_connect("localhost","root","l[kpfu");
//-----------SET CHARSET = tisุ620----------//
$charset = "SET NAMES tis620";
mysql_query($charset) or die('Invalid query: ' . mysql_error());
mysql_select_db("sad");
//---query---//
$sql = "select * from member";
//---instance class---//
$cls_padding = new cls_padding();
//---แบ่งหน้า---//
$query = $cls_padding->padding($sql,2);   //ผมแสดง 2 รายการต่อหน้า
//---แสดงผล---//
while($result=mysql_fetch_array($query)) {
    echo "รหัส : ".$result['m_id']." ชื่อ : ".$result['m_username']."<br>";
}
//---แสดงการแบ่งหน้า---//
$cls_padding->show($option); 
?>