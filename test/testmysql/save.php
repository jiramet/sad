<?php
/*  หลังจาก ไม่ยอมเขียนอธิบาย Code ไว้  บทลงโทษ คือ  ต้องกลับมา  อ่าน ไม่ใช้ อ่านสิ มาแกะ Code ตัวเองใหม่ ซึ่ง  กรูเกียจ ตัวเองมาก   เป็นบทเรียนะครับ  ไอ่มด
http://www.basic-skill.com/content.php?cont_title=%E0%B8%84%E0%B8%B3%E0%B8%AA%E0%B8%B1%E0%B9%88%E0%B8%87%20foreach&cont_id=49&sec_id=2

*/
	include("db_connect.php");
	connect();
	$strstring2=array();
	foreach ($_REQUEST as $key => $val) // All Key & Value
		{
		if ($key == 'Submit') {
			break;
		} else {
			$strstring2[$key]= trim($val);

		}
	}
	
	echo $strstring2[surname];

   // insert("student", $strstring2); // student คือชื่อตาราง	
	
	
?>