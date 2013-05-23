<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<? 
if (eregi("function.php",$PHP_SELF)) { // ถ้ามีการเรียกหน้านี้ขึ้นมาตรง ๆ
    echo "<meta http-equiv='refresh' content='0; url=index.php'>" ; // กลับไปยังหน้าหลักโดยอัตโนมัติ
    exit(); // ออกจากคำสั่งทั้งหมดในหน้านี้
}


function connectdb(){ // ฟังชั่นในการติดต่อฐานข้อมูล

// ส่วนการตั้งค่าการเชื่อมต่อ DB

define("DB_HOST","localhost"); // ชื่อ Host
define("DB_NAME","webboard"); // ชื่อฐานข้อมุล
define("DB_USERNAME","root"); // ชื่อผู้มีสิทธิ์ใช้ฐานข้อมูล
define("DB_PASSWORD","l[kpfu"); // รหัสผ่านที่ใช้เข้าฐานข้อมูล

$connect_db = mysql_connect("".DB_HOST."","".DB_USERNAME."","".DB_PASSWORD."") ; // เชื่อมต่อฐานข้อมูล
$select_db = mysql_select_db("".DB_NAME.""); // เลือกฐานข้อมูล
mysql_query("SET NAMES TIS620");  // คิวรี่ข้อมูลเป้นภาษา TIS-620
mysql_query("SET character_set_results=tis620");// คิวรี่ข้อมูลเป้นภาษา TIS-620
	}

function closedb(){ // Function ปิดการเชื่อมต่อฐานข้อมูล
		mysql_close(); // ปิดการเชื่อมต่อฐานข้อมูล
	}
// เปิดหน้าหลัก
function Detail(){ // function แสดงผลหน้าหลัก
	  
	  if ($_GET[p]==''){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "main.php";
		}else if ($_GET[p]=='add'){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "add.php";
		} else if ($_GET[p]=='new_add'){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "new_add.php";
		} 	else if ($_GET[p]=='red'){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "red.php";
		}  else if ($_GET[p]=='ment'){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "comment.php";
		} else if ($_GET[p]=='reg'){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "register.php";
		} else if ($_GET[p]=='add_member'){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "member_add.php";
		} else if ($_GET[p]=='mi'){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "member_detail.php";
		}else if ($_GET[p]=='log'){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "login.php";
		}else if ($_GET[p]=='member'){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "all_member.php";
		}else if ($_GET[p]=='del'){ // ตรวจสอบตัวแปล  $_GET[p] เพื่อแสดงหน้าที่เลือก
	  			include "delete.php";
		}else  // ถ้าไม่ต้องกับหน้าไหนเลย 
		echo "<div align=\"center\">ไม่พบหน้าที่คุณต้องการชม  </div><meta http-equiv=refresh content=3;URL=index.php>";
		
}

// ฟังชั่นเชกว่าเป็นหัวข้อใหม่หรือไม่
function CheckNew($post_time =""){  // "TIME",date("Y-m-d")
 $day = date("d",strtotime($post_time))+1;
 $resultday = date("Y-m-").$day;
	if (TIME <=  $resultday) { echo "<img src='img/new.gif'>";}
}
//ฟังชั่นเชคว่า เป็นหัวข้อที่พึ่ง update หรือไม่
function CheckUpdate($update_time =""){  // "TIME",date("Y-m-d")
if ( $update_time != ""){

	if (time()-86400 <=  $update_time) { echo "<img src='img/update.gif'>";}
}
}


// ฟังชั่นที่เชคว่าเป็นหัวข้อที่มีคนเข้ามากกว่า 100 หรือไม่
function CheckHot($hot =""){  // "TIME",date("Y-m-d")

	if ($hot >= 50) { echo "<img src='img/hot.gif'>";}
}
function Level($level=""){ // Function Up Level สมาชิก return เป็นรูปดาว
		if ($level <= 3 ){ 
		echo "<img src='img/star.png'>";
		} else if ($level <= 6){
		echo "<img src='img/star.png'><img src='img/star.png'>";
		}else {
		echo "<img src='img/star.png'><img src='img/star.png'><img src='img/star.png'>";
		}
}
function CheckUser(){ // Function ตรวสสอบว่า ได้ Login หรือไม่
@session_start();
				if (!session_is_registered("login"))  {
						echo "<br><center>กรุณา Login เข้าสู่ระบบก่อนครับ</center><br>";
						echo "<meta http-equiv=refresh content=3;URL=index.php>";
						exit();
				}
}
function CheckAdmin(){ // Function ตรวสสอบว่าใช้ผู้ดูแลหรือไม่
		if($_SESSION[login]=="admin"){
				return true;
		}else{ 
				return false;
		}
}
function CheckLogin(){ // Function ตรวสสอบว่า ได้ Login หรือไม่
 			if (session_is_registered("login")){ echo "<meta http-equiv=refresh content=0;URL=?p=mi>"; 
 			exit();} 
}
function Login(){
 			if (session_is_registered("login") ){ // Function ตรวสสอบว่า ได้ Login หรือไม่
			return true;
			}else{
			return false;
			}
}
function LevelUp($result="",$user=""){ // Function Up Level สมาชิก return เป็นรูปดาว
if($result >100){ $level = 9;}
else if($result >80){$level = 8; }
else if($result >70){$level = 7;}
else if($result >60){$level = 6;}
else if($result >50){$level = 5;}
else if($result >40){$level = 4;}
else if($result >30){$level = 3;}
else if($result >20){$level = 2;}
else {$level = 1;}
$update_level = mysql_query("UPDATE ".TB_MEMBER." SET level ='$level' where user='$user' ");
}
?>