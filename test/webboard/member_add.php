<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<? 
if($_POST[post] == "OK"){ // ตรวจสอบว่าได้โพสหรือไม่
	$email = $_POST[email]; // รับค่าจากการโพส
	$user = $_POST[user];// รับค่าจากการโพส
	$FILE = $_FILES['FILE'];// รับค่าจากการโพส
	$result = mysql_query("SELECT user from ".TB_MEMBER." where user='$user'") ; // ดึงฐานข้อมูลเพื่อตรวสสอบว่า user นี้ตรงกับ user ใดในฐานข้อมุลหรือไม่
	$numrow = mysql_num_rows($result) ; // ตรวจสอบว่าตรงหรือไม่ ถ้าตรง เป็น 1 ถ้าไม่ตรงเป็น 0

		if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)",$email)){ // ตรวสสอชรูปแบบของอีเมลล์
				echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณากรอกอีเมล์ให้ถูกต้องด้วยครับ</b></font><br><br><input type='button' value='กลับไปลองใหม่' 		onclick='history.back();'></center>" ; // ถ้าอีเมลล์ผิดรูปแบบ
		} else if ( $FILE['size'] > LIMIT_IMG && $FILE != "" ) { // ตรวจสอบขนาดของไฟล์รูป
	echo "<br><br><center><font size='3' face='MS Sans Serif'><b>ขนาดรูปที่แนบมามีขนาดเกิน ".(LIMIT_IMG/1024)." kB กรุณาตรวจสอบรูปภาพของท่าน</b></font><br><br><input type='button' value='กลับไปลองใหม่' onclick='history.back();'></center>" ; // ถ้าไฟล์รูปใหม่เกิน
	}  else if($numrow!=0) { // ตรวสสอบ username ว่าตรงกับตาราง user ในฐานข้อมูลหรือไม่
				echo "<br><br><center><font size='3' face='MS Sans Serif'>ขอโทษด้วยครับ user $user นี้ ได้มีผู้ใช้ไปแล้วครับ กรุณาเปลี่ยนชื่อ Login ใหม่<br><br><input type='button' value='กลับไปลองใหม่' onclick='history.back();'></center>" ;  // ถ้า User ที่ใส่เข้ามาซ้ำกันในฐานข้อมู
		} else { // ถ้าไม่มีอะไรผิดพลาด
				$name = $_POST[name];// รับค่าจากการโพส
				$day_member = $_POST[day_member];// รับค่าจากการโพส
				$address = $_POST[address];// รับค่าจากการโพส
				$tel = $_POST[tel];// รับค่าจากการโพส
				$pass = $_POST[pass];// รับค่าจากการโพส
			
				if ( $FILE['type'] == "image/gif" ) // ตรวจนามสกุลไฟล์รูป
						{$img = FILENAME.".gif";} // เปลี่ยนซื่อไฟล์รูป
				else if (($FILE['type']=="image/jpg")||($FILE['type']=="image/jpeg")||($FILE['type']=="image/pjpeg"))// ตรวจนามสกุลไฟล์รูป
						{$img = FILENAME.".jpg";} // เปลี่ยนซื่อไฟล์รูป
				@copy ($FILE['tmp_name'] , IMG_MEMBER.$img );// ตรวจนามสกุลไฟล์รูป 
				if ($img==""){$img="nopic.gif";} // เปลี่ยนซื่อไฟล์รูป
				$l = 1; $p = 0; $m = 0;  // ค่าเริ่มต้นสำหรับการตั้งกระทู้ และคอมเม้น

				$add_member = mysql_query("INSERT INTO `".TB_MEMBER."` (`user` ,`level` ,`pass`,`name` ,`date_member` ,`address` ,`email` ,`tel` ,`post` ,`ment` ,`img`)
VALUES ('$user', '$l', '$pass', '$name', '$day_member', '$address' , '$email', '$tel' , '$p', '$m', '$img')"); // เพิ่มข้อมูลลงฐานข้อมูล
				if ($add_member ) { // ตรวจสอบว่า เพิ่มข้อมูลลงฐานข้อมูลสำเร็จหรือไม่
				$_SESSION[login] = $user; // ถ้าเพิ่มได้ ให้กำหนด Sission ซึ่งหมายความว่า ได้ Login แล้ว
							echo "<center>การสมัครสมาชิกเสร็จสมบูรณ์ <br>กำลังพาคุณไปยังหน้าระบบสมาชิก</center>";
							echo "<meta http-equiv=refresh content=3;URL=?p=mi>"; // พาไปยังหน้าระบบสมาชิก
				}else{  echo "ไม่สามารถบันทึกข้อมูลได้<br><input type='button' value='กลับไปลองใหม่' onclick='history.back();'>";} // เผื่อมีอะไรผิดหลาด
		}
} else {echo "<meta http-equiv=refresh content=0;URL=index.php>" ;} // ถ้าไม่ได้โพสมา หรือเรียกไฟล์นี้โดยตรง

?>
