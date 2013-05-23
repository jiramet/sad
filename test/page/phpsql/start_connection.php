<?php
/* --- Configuration connect to server ---- */	
	# Connect to localhost
	$serv_name = "localhost";
	$dbas_name = "sad";
	$user_name = "root";
	$user_pass = "l[kpfu";
	
	$conn = @mysql_connect($serv_name, $user_name, $user_pass) or die
					("ERROR : ไม่สามารถติดต่อเซิฟเวอร์ ได้ค่ะ!!!<br /> Mysql report : ".mysql_error());		# Create connection 
	@mysql_select_db($dbas_name, $conn) or die
					("ERROR: ไม่สามารถเลือกฐานข้อมูล ได้ค่ะ!!!<br /> Mysql report : ".mysql_error());		# Select database
	@mysql_query("SET NAMES UTF8") or die
					("ERROR : ไม่สามารถเซ็ตอ็นโค๊ดดิ้ง ได้ค่ะ!!!<br /> Mysql report : ".mysql_error());		# SET database encoding
?>