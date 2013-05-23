<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?

if (eregi("config.php",$PHP_SELF)) {
    echo "<meta http-equiv='refresh' content='0; url=index.php'>" ;
    exit();
}
	
// ส่วนของชื่อตาราง DB
define("TB_LEVEL","level"); // ตารางระดับสมาชิก
define("TB_MEMBER","member"); // ตารางสมาชิก
define("TB_WEBBOARD","board"); // ตารางเว็บบอร์ด
define("TB_COMMENT","comment"); // ตารางคอมเม้น
define("TB_CATEGORY","category");// ตารางกลุ่มของเว็บบอร์ด



// ตั้งค่าการแสดงผลหน้าเว็บบอร์ด
define("WEB_TITLE","My Webboard"); // แสดงไตเติ้ล
define("FOOTER","จัดทำโดย : นายสมชาย เสงี่ยมศักดิ์, นายธนวัฒน์ นุชสุข<br>จัดทำขึ้นเพื่อศึกษาการสร้างฐานข้อมูลด้วย MySQL "); // แสดงไตเติ้ล
define("WEB_INDEX","My Webboard"); // แสดงหน้าหลัก
define("WEB_URL","http://localhost/webboard/"); // ที่อยู่ของเว็บไซต์ ต้องมี / ด้วยนะครับ
define("TIME",date("Y-m-d")) ; // เวลาปัจจุบัน อ้างอิงจาก server
define("DOT","<TR><TD height=1 class=\"dot\"></TD></TR>") ; //แสดงส่วนของจุดใต้บรรทัด
define("DOT2","<TR><TD colspan=\"2\" height=1 class=\"dot\"></TD></TR>") ; //แสดงส่วนของจุดใต้บรรทัด 2 ตาราง
define("_W","55") ; // ความกว้างรูปของคนโพส
define("_H","75") ; // ความสูงของรูปคนโพส


// สมาชิก
define("IMG_MEMBER","img_m/"); // ที่อยู่รูปของสมาชิก ต้องมี / ด้วยนะครับ
define("LIMIT_IMG","102400"); // ขนาดรูปสูงสุดที่สมาชิกสามารถใส่ได้
define("FILENAME",time()) ; // เวลาปัจจุบัน อ้างอิงจาก server
$namefileupload = array('jpg', 'jpeg','gif','png'); // ไฟล์ที่สามารถ upload ได้
$filename_img = "jpg, jpeg, gif, png"; // ไฟล์ที่สามารถ upload ได้


// ตั้งค่าผู้ดูแลระบบ
define("ADMIN_EMAIL","admin@xvlnw.com"); // อีเมลล์ของผุ้ดูแลระบบ
?>
