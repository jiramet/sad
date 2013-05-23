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
$db_selected = mysql_select_db($dbname);// เราจะใช้วิธีปัจจุบัน จะไม่ใช่การ db query
mysql_query("SET character_set_results=utf8");// ใส่เพื่อแสดงภาษาไทยถูกต้อง
mysql_query("SET character_set_client=utf8");// ใส่เพื่อแสดงภาษาไทยถูกต้อง
mysql_query("SET character_set_connection=utf8");// ใส่เพื่อแสดงภาษาไทยถูกต้อง

require(dirname(__FILE__)."/pagination.php");// ทำการ include/require ด้วย เพื่อเรียกใช้งาน

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
		<div class="nav"><a href="./">Method/property ต่างๆ</a> | <a href="./?act=dropdb">drop db</a> | <a href="./?act=droptb">drop table</a> | <a href="./?act=truncate">empty</a> | <a href="./?act=insert">insert ข้อมูลตัวอย่าง</a></div>
		<h1>การแบ่งหน้าแสดงข้อมูล</h1>
		<table border="1">
			<tr>
				<th>id</th>
				<th>name</th>
			</tr>
			<?php
			$sql = "select * from $main_table where 1 order by id asc";
			$result = mysql_query($sql);
			$total = mysql_num_rows($result);// นับจำนวนทั้งหมดในฐานข้อมูลตามเงื่อนไข sql ข้างบน
			##############################
			// กำหนดค่า config ให้กับ pagination class
			$config['base_url'] = "http://localhost/sad/test/page/pagination/view3.php?order=";
			$config['total_rows'] = $total;// ค่าที่นับได้"ทั้งหมด"จาก sql ด้านบน
			$config['per_page'] = 30;
			$config['display_pages'] = false;
			$pagination = new pagination($config);
			$start_item = (!isset($_GET['per_page']) ? "0" : intval($_GET['per_page']));
			##############################
			$sql .= " limit $start_item, " . $config['per_page'];
			$result = mysql_query($sql);
			if ( mysql_num_rows($result) > 0 ) {
				while ( $row = mysql_fetch_object($result) ) {
			?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->name; ?></td>
			</tr>
			<?php
				}
			} else {
			?>
			<tr>
				<td colspan="2">ไม่มีข้อมูล</td>
			</tr>
			<?php
			}
			mysql_free_result($result);
			?>
			
		</table>
		<?php echo $pagination->create_links(); ?>
	</body>
</html>