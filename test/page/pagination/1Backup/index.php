<?php
/**
 * @author mr.v
 * @website http://okvee.
 */

// กำหนดค่า
$db_host = "localhost";
$dbname = "pagination";
$db_username = "root";
$db_password = "l[kpfu";
$main_table = "testpag";

//
$act = (isset($_GET['act']) ? trim($_GET['act']) : '');

// connect to db
$link = mysql_connect($db_host, $db_username, $db_password);
if ( ! $link ) {die("could not connect to database");}

// selected db แล้ว ไม่ต้องมี select db, db query อีก.
$db_selected = mysql_select_db($dbname);
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");

############act=

if ( $act == "createdb" ) {
	$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
	mysql_query($sql);
	mysql_close($link);
	header("Location: ./");
	exit();
}

// act=createtable
if ( $act == "createtable" ) {
	$sql = "CREATE TABLE IF NOT EXISTS `$main_table` (
	`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`name` VARCHAR( 255 ) NULL DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
	$result = mysql_query($sql);
	if ( ! $result ) {
		die("could not create table: ".mysql_error());
		mysql_close($link);
	} else {
		mysql_close($link);
		header("Location: ./");
		exit();
	}
}

// insert ข้อมูลตัวอย่าง
if ( $act == "insert" ) {
	set_time_limit(300);
	$sql = "select * from $main_table where 1 order by id asc";
	$result = mysql_query($sql);
	if ( mysql_num_rows($result) > 0 ) {
		// ไม่ต้อง insert เพราะมีอยู่แล้ว
		mysql_close($link);
		header("Location: ./");
		exit();
	}
	for ( $i=1; $i<=300; $i++ ) {
		$sql = "INSERT INTO $dbname.$main_table (
		`id`,
		`name`
		) VALUES (
		NULL,
		'".random_string(5)."+".$i."'
		);";
		$result = mysql_query($sql);
	}
	if ( ! $result ) {
		die("could not insert data: ".mysql_error()."<br />".$sql);
		mysql_close($link);
	} else {
		mysql_close($link);
		header("Location: ./");
		exit();
	}
}

// act=truncate
if ( $act == "truncate" ) {
	$sql = "truncate table $main_table";
	mysql_query($sql);
	mysql_close($link);
	header("Location: ./");
	exit();
}

// act = droptb
if ( $act == "droptb" ) {
	$sql = "drop table $main_table";
	mysql_query($sql);
	mysql_close($link);
	header("Location: ./");
	exit();
}

// act=dropdb
if ( $act == "dropdb" ) {
	$sql = "drop database $dbname";
	mysql_query($sql);
	mysql_close($link);
	header("Location: ./");
	exit();
}

#####################check

// check if db exists
if ( ! $db_selected ) {
	mysql_close($link);
	die("database not found <a href=\"?act=createdb\">create db?</a>");
}

// check if table exists
$table_selected = mysql_query("show tables where tables_in_$dbname = '$main_table'");
if ( !mysql_fetch_array($table_selected) ) {
	mysql_close($link);
	die("table not found <a href=\"?act=createtable\">create table?</a>");
}

##########functions

/**
 * random string
 * method นี้ได้มาจาก http://www.thaiseoboard.com/index.php?topic=38092.0 โดยคุณ kengz ตอบ #7
 * @param string $length
 * @return string
 */
function random_string($length = '10') {
	if ( ! is_numeric($length) ) {$length = '10';}
	$prepared_txt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$new_string = "";
	for ( $i = 1; $i <= $length; $i++ ) {
		$new_string .= substr($prepared_txt, mt_rand(0, mb_strlen($prepared_txt) - 1), 1);
	}
	unset($prepared_txt, $i);
	return $new_string;
}// random_string

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>php pagination class</title>
		<style type="text/css" media="all">
			.nav {background: #eee; margin: 0 0 20px 0; padding: 3px;}
		</style>
	</head>
	<body>
		<div class="nav"><a href="./?act=dropdb">drop db</a> | <a href="./?act=droptb">drop table</a> | <a href="./?act=truncate">empty</a> | <a href="./?act=insert">insert ข้อมูลตัวอย่าง</a></div>
		<h1>การแบ่งหน้าแสดงข้อมูล</h1>
		<p>ดูตัวอย่างการแบ่งหน้า <a href="view1.php">ตัวอย่างที่ 1</a> <a href="view2.php">ตัวอย่างที่ 2</a> <a href="view3.php">ตัวอย่างที่ 3</a></p>
		<hr />
		<h2>การกำหนดค่า config ต่างๆ</h2>
		<table width="100%" border="1" cellspacing="0" cellpadding="2">
			<tr>
				<td bgcolor="#CCCCCC"><strong>config หลัก</strong></td>
				<td bgcolor="#CCCCCC"><strong>คำอธิบาย</strong></td>
			</tr>
			<tr>
				<td>$config['base_url']</td>
				<td>URL แบบเต็มสำหรับหน้าที่จะแบ่งการแสดงผล(แบ่งหน้า) โดยอย่างน้อยให้มี querystring 1 อย่าง เช่น http://localhost/page.php?orders=</td>
			</tr>
			<tr>
				<td>$config['total_rows']</td>
				<td>จำนวนผลลัพธ์ทั้งหมด ก่อนทำการแบ่งแสดงผล</td>
			</tr>
			<tr>
				<td>$config['per_page']</td>
				<td>จำนวนรายการที่จะแสดงต่อ 1 หน้า เช่น 10, 20</td>
			</tr>
			<tr>
				<td bgcolor="#CCCCCC"><strong>ค่า config ที่เป็นส่วนเสริม</strong></td>
				<td bgcolor="#CCCCCC"><strong>คำอธิบาย</strong></td>
			</tr>
			<tr>
				<td>$config['num_links']</td>
				<td>จำนวนลิ้งค์ก่อนและหลังตัวเลขหน้าปัจจุบัน เช่นปัจจุบันคลิกอยู่หน้า 5 กำหนดจำนวนลิ้งค์ 2 จะแสดง 3 4 5 6 7</td>
			</tr>
			<tr>
				<td>$config['full_tag_open']</td>
				<td>แทกเปิดของการแบ่งหน้าทั้งหมด</td>
			</tr>
			<tr>
				<td>$config['full_tag_close']</td>
				<td>แทกปิดของการแบ่งหน้าทั้งหมด</td>
			</tr>
			<tr>
				<td>$config['first_link']</td>
				<td>คำที่จะใช้แทนคำว่าหน้าแรก หากไม่ต้องการให้มี ให้กำหนดเป็น false</td>
			</tr>
			<tr>
				<td>$config['first_tag_open']</td>
				<td>แทกเปิดของคำว่าหน้าแรก</td>
			</tr>
			<tr>
				<td>$config['first_tag_close']</td>
				<td>แทกปิดของคำว่าหน้าแรก</td>
			</tr>
			<tr>
				<td>$config['last_link']</td>
				<td>คำที่จะใช้แทนคำว่าหน้าสุดท้าย หากไม่ต้องการให้มี ให้กำหนดเป็น false</td>
			</tr>
			<tr>
				<td>$config['last_tag_open']</td>
				<td>แทกเปิดของคำว่าหน้าสุดท้าย</td>
			</tr>
			<tr>
				<td>$config['last_tag_close']</td>
				<td>แทกปิดของคำว่าหน้าสุดท้าย</td>
			</tr>
			<tr>
				<td>$config['next_link']</td>
				<td>คำที่จะใช้แทนคำว่าหน้าถัดไป หากไม่ต้องการให้มี ให้กำหนดเป็น false</td>
			</tr>
			<tr>
				<td>$config['next_tag_open']</td>
				<td>แทกเปิดของคำว่าหน้าถัดไป</td>
			</tr>
			<tr>
				<td>$config['next_tag_close']</td>
				<td>แทกปิดของคำว่าหน้าถัดไป</td>
			</tr>
			<tr>
				<td>$config['prev_link']</td>
				<td>คำที่จะใช้แทนคำว่าหน้าก่อน หากไม่ต้องการให้มี ให้กำหนดเป็น false</td>
			</tr>
			<tr>
				<td>$config['prev_tag_open']</td>
				<td>แทกเปิดของคำว่าหน้าก่อน</td>
			</tr>
			<tr>
				<td>$config['prev_tag_close']</td>
				<td>แทกปิดของคำว่าหน้าก่อน</td>
			</tr>
			<tr>
				<td>$config['cur_tag_open']</td>
				<td>แทกเปิดของเลขหน้าปัจจุบัน</td>
			</tr>
			<tr>
				<td>$config['cur_tag_close']</td>
				<td>แทกปิดของเลขหน้าปัจจุบัน</td>
			</tr>
			<tr>
				<td>$config['num_tag_open']</td>
				<td>แทกเปิดของตัวเลขหน้า</td>
			</tr>
			<tr>
				<td>$config['num_tag_close']</td>
				<td>แทกปิดของตัวเลขหน้า</td>
			</tr>
			<tr>
				<td>$config['display_pages']</td>
				<td>แสดงเลขหน้า หากไม่ต้องการแสดงเลขหน้าให้กำหนดเป็น false</td>
			</tr>
		</table>
	</body>
</html>