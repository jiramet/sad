
<form action="test_class.php" method="post">
  
<input name="test" type="text" />
<input name="" type="submit" value="submit" />
</form>
<?php
	include 'class.mysql.TEST.php';
	
	/* Comment ใหญ่  กรุณาอ่านก่อน
	 * ในส่วนของ File นี้  เป็น แค่ File Test เท่านั้น เวลานำไปใช้จริง กรุณา นำไปประยุกใช้นะครับ
	 * 		1. ให้สังเกตุ  ในสวนของ table นะครับขอยกตัวอย่าง วิธีการลบข้อมูลในตารางนะครับ
	 *			 ****รูปแบบ $db->del("table","where"); 
	 * 						เวลา  Test ใช้แบบนี้   				$db->del("mpermission","mp_id=1");   
	 * 						เวลา นำไปใช้จริง ใช้แบบนี้			$db->del("_MPER","mp_id=1");   
	 * 				**** ให้สังเกตุ  ตรงส่วน ของ Table นะครับ Test ใช้ mpermission  ส่วนนำไปใช้จริง _MPER นะครับ 
	 * 
	 */
	
	# วิธีลบข้อมูลในตาราง
	# $db->del("table","where"); 
	#$db->del("mpermission","mp_id=1");
	
	# วิธีหาจำจวนแถว
	# $db->num_rows("table","field","where");   _MPER  mpermission
	$num=$db->num_rows("mpermission","mp_mid,mp_wid","mp_mid=18 and mp_wid=1");
	echo $num."<br>";
	
	# เพิ่มข้อมูลลงฐานข้อมูล
	# $db->add_db("table",array("field"=>"value")); 
	# $add = $db->add_db(_MEMBER, array("m_username" => trim($_POST[username]), "m_password" => trim($_POST[password]), "m_title" => trim($_POST[title]), "m_name" => trim($_POST[name]), "m_surname" => trim($_POST[surname]), "m_email" => trim($_POST[email]), "m_address" => trim($_POST[address]), "m_tel" => trim($_POST[tel]), ));

	# อัพเดรตข้อมูลลงฐานข้อมูล 
	# $db->update_db("tabel",array("field"=>"value"),"where"); 
	# $save = $db->update_db(_MEMBER, array( "m_title" => trim($_POST[title]), "m_name" => trim($_POST[name]), "m_surname" => trim($_POST[surname]), "m_email" => trim($_POST[email]), "m_address" => trim($_POST[address]), "m_tel" => trim($_POST[tel]),"m_password" => trim($_POST[password]),  ), "m_id = '" . $id . "'");
	
	# อัพเดรตฐานข้อมูลลงฐานข้อมูลแบบเดี๋ยว
	# $db->update("table","set","where");
	
	# Query ช้อมูลในฐานข้อมูล
	# $res = $db->query('SELECT field FROM table WHERE where'); 
	
	# นับจำนวนเรคคอร์ด
	# $res = $db->query('SELECT field FROM table WHERE where'); 
	# $rows = $db->rows($res); 
	
	# เอาข้อมูลออกมาเป็น array
	# $res = $db->query('SELECT field FROM table WHERE where'); 
	# while ($arr = $db->fetch($res)) { 
	# 		echo $arr['a']." - ".$arr['c']."<br>\n"; 
	# }
	
	echo "<br>";
	echo fnc0(test);
	

?>