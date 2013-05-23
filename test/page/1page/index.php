<?php include "function.php"; ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
	$db = new mysqli("localhost", "root", "l[kpfu", "sad"); //เชื่อมต่อฐานข้อมูลด้วย mysqli
	if (mysqli_connect_errno())
		die("Connect Failed! :".mysqli_connect_error());
	$db->set_charset("utf8");

	// Setting Page
	$number_per_page = 10; //กำหนดให้แสดง 10 แถวต่อเพจ

	// Get All filed Data...
	//$all_data=$db->rows($db->query("SELECT * FROM member WHERE 1")); 

	
	$all_data = $db->query("SELECT COUNT(m_id) AS data FROM member")->fetch_object()->data;
	
	
	echo 'all_data:='.$all_data;

	// Page Control
	//อ่านลำดับเพจปัจจุบันจาก query string หากไม่มีแสดงว่าเป็นเพจแรก
	$page = intval($_GET['page']);
	if (!$page)
		$page = 1;

	//คำนวณหาแถวเริ่มต้นของเพจนั้นๆ
	$start = ($page - 1) * $number_per_page;
	echo '<br/>start:='.$start;

	//คำนวณหาเพจทั้งหมดที่สามารถแบ่งได้ โดยปัดเศษทศนิยมทิ้ง
	$all_page = floor($all_data / $number_per_page);
	echo '<br/>all_page:='.$all_page;

	//mod แล้วให้บวก 1 เป็นการปัดเศษจากการหารขึ้นนั่นเอง
	if ($all_data % $number_per_page)
		$all_page++;
		
		echo '<br/>all_page:='.$all_page;

	//ต่อไปจะเป็นในส่วนของการแสดงผล
?>
<table border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
  <tr>
    <td width="50" bgcolor="#CCCCCC"><div align="center">ID</div></td>
    <td width="150" bgcolor="#CCCCCC"><div align="center">User </div></td>
  </tr>
<?php
	$Query = $db->query("SELECT * FROM member ORDER BY m_id ASC LIMIT {$start},{$number_per_page}");
	while ($data = $Query->fetch_object()) {
?>
  <tr>
    <td><div align="center"><?php echo $data->m_id; ?></div></td>
    <td><div align="center"><?php echo $data->m_name; ?></div></td>
  </tr>
<?php
	}
?>
</table><br>
<?php
	//เรียกใช้งาน function SplitPageใน function.php
	SplitPage($page, $all_page, "?page=");
	//ตรงกลางต้องใส่ url ของเว็บไซต์แล้วต้องตามด้วย page= เสมอ .. ไม่เกี่ยวนะ
?>
</body>
</html>