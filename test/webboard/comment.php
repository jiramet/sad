<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?
if ($_POST[post]=="OK"){ // ถ้ามีการคอมเม้น
	$name = $_POST[name]; // รับค่าจากการคอมเม้น
	$detail = $_POST[detail];// รับค่าจากการคอมเม้น
	$id = $_POST[id];// รับค่าจากการคอมเม้น
	$member = $_POST[member];// รับค่าจากการคอมเม้น
	if($member){ // ตรวจสอบว่าเป็นสมาชิกคอมเม้นหรือไม่
				$member = 1; // ค่าเริ่มต้นในการเพิ่มการคอมเม้น
				$connect_member = mysql_query("SELECT post,ment,user FROM ".TB_MEMBER." WHERE user = '".$_SESSION[login]."' "); // ดึงข้อมูลของสมาชิกคนที่โพสออกมา
				$dbarr[member] = mysql_fetch_array($connect_member); // ดึงข้อมูลออกมาเป็น Array
				$ment = $dbarr[member][ment]+$member; // เพิ่มการคอมเม้นของสมาชิกไป 1
				$levelup = $ment + $dbarr[member][post] ;// เอาค่าคอมเม้นและตั้งกระทู้มารวมกัน
				LevelUp($levelup,$_SESSION[login]); // เชคว่าได้เลื่อนขั้นหรือไม่
				$update_post = mysql_query("UPDATE ".TB_MEMBER." SET ment ='$ment' WHERE user = '".$_SESSION[login]."' "); // Update ค่าของการ Ment
	}
	$db_comment = "INSERT INTO ".TB_COMMENT." (comment,webboard_id,detail,post,member) VALUES ('','$id','$detail','$name','$member')";
	$add_comment = mysql_query($db_comment ); // เพิ่มข้อมูลลงในฐานข้อมูล Comment
	if ($add_comment){ // ตรวจสอบว่าเพิ่มข้อมูลลงได้สำเร็จหรืออไม่
	$T = time(); // เอาค่าเวลาปัจจุบันใส่ไว้ในตัวแปล $T
	$db_update = mysql_query("UPDATE  ".TB_WEBBOARD." SET update_date='$T'  WHERE webboard_id ='$id' "); // Upfate ฐานข้อมูลให้เป็นหัวข้อที่ได้ Update
	echo "<div align=\"center\">Comment สำเร็จ กำลังพาคุณไปยังหน้าแสดงผล</div><meta http-equiv=refresh content=3;URL=index.php?p=red&id=$id> " ;
	}else { "การโพสไม่สำเร็จ <input type='button' value='กลับไปแก้ไข' onclick='history.back();'>"; }

} else {echo "<meta http-equiv=refresh content=0;URL=index.php>" ; // ถ้าไม่มีการโพส
}


?>