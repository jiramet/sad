<?php
	$site = "http://localhost/sad/";
	define("USER", "admin");
	define("PASS", "admin");
	//echo USER.'นี่คือ user </br>';

	// Set System  by mod kung

	$host = 'localhost';
	$userdb = 'root';
	$passdb = 'l[kpfu';
	$db = 'sad';

	// Setting Page
	$number_per_page = 10; //กำหนดให้แสดง 10 แถวต่อเพจ

	// Setting Database   เพิ่มได้  แต่เวลาลบ คิดหนักๆนะครับ  เพราะ ว่ามีผลกับการ connect databases นะครับ
	define("_DB_HOSTNAME", $host);
	define("_DB_USERNAME", $userdb);
	define("_DB_PASSWORD", $passdb);
	define("_DB_DATABASE", $db);
	define("_MEMBER", "member");
	define("_TITLE", "title");
	define("_WURL", "wurl");
	define("_MPER", "mpermission");
	define("_GRO", "groups");
	define("_PERGRO", "groupper");
	define("_HARDWARE", "hardwareasset");

?>