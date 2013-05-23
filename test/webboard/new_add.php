<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<div align="center">
<? 
if ($_POST[post]=="OK"){ // ตรวสสอบว่าได้โพสข้อความมาหรือไม่
$topic = $_POST[topic]; // เก็บว่าโพสใส่ตัวแปล
$category = $_POST[category];// เก็บว่าโพสใส่ตัวแปล
$detail =$_POST[detail];// เก็บว่าโพสใส่ตัวแปล
$name = $_POST[name];// เก็บว่าโพสใส่ตัวแปล
		
			if (isset($_SESSION[login])){ // ตรวจสอบว่าได้ Login หรือไม่
				$member = 1; // ให้ค่าเพิ่มทีละ 1
				$connect_member = mysql_query("select post,ment,user from ".TB_MEMBER." where user = '".$_SESSION[login]."' "); // คิวรี่ฐานข้อมูลสมาชิก โดยเงื่อนไข user = user ที่ Login อยู่ในตอนนี้
				$dbarr[member] = mysql_fetch_array($connect_member); // ดึงข้อมูลคิวรี่ออกมาเป็น array
				$post = $dbarr[member][post]+$member; // เพิ่มค่าโพส
				$levelup = $post + $dbarr[member][ment] ;  // นำเอาค่าตั้งกระทู้ และ คอมเม้นมารวมกัน
				LevelUp($levelup,$_SESSION[login]);  // ตรวจสอบ Level ว่าเลื่อนขั้นหรือไม่
				$update_post = mysql_query("UPDATE ".TB_MEMBER." SET post ='$post' WHERE user = '".$_SESSION[login]."' "); // Update Post ให้สมาชิก
				}else{ // ถ้าไม่ได้ Login
				$member = 0; // ค่าสถาณะสมาชิกเป็น 0 คือไม่ใช่สมาชิก
				}
			$posttime = TIME; // นำค่าเวลาปัจจุบันใส่ในตัวแปล
		$db_newboard =  mysql_query( "INSERT INTO `".TB_WEBBOARD."` 
		(`webboard_id` ,`category` ,`topic` ,`detail` ,`postdate`  ,`view` ,`post` ,`member`)
VALUES ( '', '$category', '$topic', '$detail', '$posttime','', '$name', '$member')"); // เพิ่มข้อมูลลฐานข้อมูลเว็บบอร์ด
		if ($db_newboard){ echo "ตั้งกระทู้สำเร็จ<br>กำลังพาคุณไปยังหน้าหลักครับ"; // ตรวสสอบว่า เพิ่มข้อมูล สำเร็จหรือไม่
	echo "<meta http-equiv=refresh content=3;URL=index.php>" ; // ถ้าเพิ่มสำเร็จ
		}else{echo "ตั้งกระทู้ไม่สำเร็จ";  // ถ้าไม่สำเร็จ
		}
} else {echo "<meta http-equiv=refresh content=0;URL=index.php>" ; // ถ้าไม่ได้โพสมา หรือเรียกหน้านี้โดยที่ยังไม่ได้โพสมา
}
?></div>