<? 
if (!(CheckAdmin())){ // ตรวสสอบว่าเป็นผุ้ดูแลหรือไม่
	echo "<meta http-equiv=refresh content=0;URL=index.php>" ;
	exit();
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<? 
$action = $_GET[action]; // ตรวจสอบว่าลบอะไร จาก Url
// ลบคอมเม้น ลบหัวข้อ ลบสมาชิก
if($action=="member"){ // ถ้าลบสมาชิก
		$user = $_GET[id] ; // รับค่า user จาก Url
		$db_del_img = mysql_query("SELECT img FROM ".TB_MEMBER." WHERE user='$user' "); // ดึงข้อมูลรูปสมาชิกออกจากฐานข้อมูล
		$unimg = mysql_fetch_array($db_del_img); // ดึงข้อมูลรูปสมาชิกออกจากฐานข้อมูล
		if ($unimg[img] !="nopic.gif" ) { unlink(IMG_MEMBER.$unimg[img]); } // ถ้าสมาชิกมีรูปภาพอยู่ ให้ลบรูปภาพสมาชิก
	$db_del = mysql_query("DELETE FROM ".TB_MEMBER." WHERE user='$user' "); // ลบรายการสมาชิกออกจากฐานข้อมูลสมาชิก
	if($db_del){  // ถ้าลบสมาชิกสำเร็จ
		echo "<center><BR><BR>ทำการลบสมาชิกสำเร็จ<BR><BR></center>";
		echo "<meta http-equiv=refresh content=3;URL=?p=member>" ;
	}
}else if($action=="topic"){ //  ถ้าลบหัวข้อกระทู้
$topic = $_GET[id];// รับค่า รหัสกระทู้ จาก Url

		$db_del = mysql_query("DELETE FROM ".TB_WEBBOARD." WHERE webboard_id='$topic' "); // ลบกระทู้ใรตารางเว็บบอร์ด
		$db_del_comment = mysql_query("DELETE FROM ".TB_COMMENT." WHERE webboard_id='$topic' "); // ลบคอมเม้นที่เป็นของกระทู้นี้
		if($db_del && $db_del_comment ){  // ถ้าลบทั้งสองอย่างสำเร็จ 
		echo "<center><BR><BR>ทำการลบหัวข้อเว็บบอร์ดสำเร็จ<BR><BR></center>"; // โชข้อความออกมา
		echo "<meta http-equiv=refresh content=3;URL=index.php>" ; // กลับไปยังหน้าหลัก
	}


}else if($action=="comment"){ // ถ้าลบคอมเม้น
$comment = $_GET[id]; // รับค่ารหัสคอมเม้นจาก URL
$topic = $_GET[topic]; // รับค่ารหัสหัวข้อกระทู้จาก URL
		$db_del_comment = mysql_query("DELETE FROM ".TB_COMMENT." WHERE comment='$comment' "); // ลบรายการคอมเม้นจากตารางคอมเม้น
		if($db_del_comment){  // ถ้าลบสำเร็จ
		echo "<center><BR><BR>ทำการลบคอมเม้นสำเร็จ<BR><BR></center>"; // โชข้อความออกมา
		echo "<meta http-equiv=refresh content=3;URL=index.php?p=red&id=".$topic.">" ; // กลับไปยังกระทู้ที่อ่าน
	}


}
?>