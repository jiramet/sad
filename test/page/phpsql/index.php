<?php require_once ('start_connection.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="defalut.css" />
</head>
<body>
<?php
	require_once('kgPager.class.php');
	
	/**
	 * string query
	 */
	$command = 'SELECT * FROM mpermission';
	
	/**
	 * get object result from database
	 */ 
	$result  = mysql_query($command);
	
	/*
	 * Configuration pager
	 */
	$config['url_page'] = 'index.php?page=';
	$config['all_recs'] = mysql_num_rows($result);	// จำนวนแถวทั้งหมดของข้อมูล
	$config['scr_page'] = 10;				// จำนวนเลขหน้าที่แสดงในหน้านั้น
	$config['per_page'] = 5;				// จำนวนแถวต่อหน้า
	$config['cur_page'] = ($_GET['page']) ? $_GET['page'] : 1; 	// หน้าปัจจุบัน
	$config['act_page'] = 'class="current_page"';								// ใส่ class css ให้หน้าปัจจุบัน
	$config['css_page'] = 'class="css-pager"';									// ใส่ clss css ให้กับส่วนการแบ่งหน้า
	$config['first'] = '&laquo; หน้าแรก';													// ข้อความปุมหน้าแรก
	$config['previous'] = '&lsaquo; ก่อนหน้า';											// ข้อความปุมหน้าก่อนหน้า
	$config['next']  = 'ถัดไป &rsaquo;';													// ข้อความปุมหน้าถัดไป
	$config['last']  = 'หน้าสุดท้าย &raquo;';												// ข้อความปุมหน้าสุดท้าย
	
	/**
	 * create pager instance
	 */
	$pager = new Pager($config);
	
	/**
	 * display pager up data
	 */
	try {
		$pager->createPager();
	} 
	catch(Exception $e) { echo $e->getMessage(); } 
	
	/**
	 * display data
	 */
	$result = mysql_query($command." ORDER BY id ASC LIMIT ".$pager->limitStart().", ".$config['per_page']) or die (mysql_error());
	echo ' &nbsp;&nbsp; <span>ชื่อ</span>&nbsp;&nbsp; ';
	echo ' &nbsp;&nbsp; <span>นามสกุล</span>&nbsp;&nbsp; ';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; อีเมล์';
	echo '<br />';
	if($result) { 
		while($rs = mysql_fetch_assoc($result)) {
				echo '<span>'.$rs['mp_id'].'</span>&nbsp;&nbsp; ';
				echo '<span>'.$rs['mp_mid'].'</span>&nbsp;&nbsp; ';
				echo '<a href="mailto:ranarong@live.com">'.$rs['email'].'</a>';
				echo '<br />';
		}
	}
	
	/**
	 * display pager down data
	 */
	try {
		$pager->createPager();
	} 
	catch(Exception $e) { echo $e->getMessage(); } 
	
?>
</body>
</html>