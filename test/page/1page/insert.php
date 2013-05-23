<?php
	$db = new mysqli("localhost", "root", "l[kpfu", "page"); //เชื่อมต่อฐานข้อมูลด้วย mysqli
	if (mysqli_connect_errno())
		die("Connect Failed!:".mysqli_connect_error());
	$db->set_charset("utf8");

	for ($i = 1; $i <= 900; $i++) {
		$sql = $db->query("INSERT INTO testpage(id, user) VALUES(0,'user{$i}')");
	}
?>