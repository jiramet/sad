<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<? 
if (eregi("function.php",$PHP_SELF)) { // ����ա�����¡˹�ҹ�����ҵç �
    echo "<meta http-equiv='refresh' content='0; url=index.php'>" ; // ��Ѻ��ѧ˹����ѡ���ѵ��ѵ�
    exit(); // �͡�ҡ����觷������˹�ҹ��
}


function connectdb(){ // �ѧ���㹡�õԴ��Ͱҹ������

// ��ǹ��õ�駤�ҡ���������� DB

define("DB_HOST","localhost"); // ���� Host
define("DB_NAME","webboard"); // ���Ͱҹ������
define("DB_USERNAME","root"); // ���ͼ�����Է�����ҹ������
define("DB_PASSWORD","l[kpfu"); // ���ʼ�ҹ�������Ұҹ������

$connect_db = mysql_connect("".DB_HOST."","".DB_USERNAME."","".DB_PASSWORD."") ; // �������Ͱҹ������
$select_db = mysql_select_db("".DB_NAME.""); // ���͡�ҹ������
mysql_query("SET NAMES TIS620");  // ����������������� TIS-620
mysql_query("SET character_set_results=tis620");// ����������������� TIS-620
	}

function closedb(){ // Function �Դ����������Ͱҹ������
		mysql_close(); // �Դ����������Ͱҹ������
	}
// �Դ˹����ѡ
function Detail(){ // function �ʴ���˹����ѡ
	  
	  if ($_GET[p]==''){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "main.php";
		}else if ($_GET[p]=='add'){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "add.php";
		} else if ($_GET[p]=='new_add'){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "new_add.php";
		} 	else if ($_GET[p]=='red'){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "red.php";
		}  else if ($_GET[p]=='ment'){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "comment.php";
		} else if ($_GET[p]=='reg'){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "register.php";
		} else if ($_GET[p]=='add_member'){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "member_add.php";
		} else if ($_GET[p]=='mi'){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "member_detail.php";
		}else if ($_GET[p]=='log'){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "login.php";
		}else if ($_GET[p]=='member'){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "all_member.php";
		}else if ($_GET[p]=='del'){ // ��Ǩ�ͺ�����  $_GET[p] �����ʴ�˹�ҷ�����͡
	  			include "delete.php";
		}else  // �������ͧ�Ѻ˹���˹��� 
		echo "<div align=\"center\">��辺˹�ҷ��س��ͧ��ê�  </div><meta http-equiv=refresh content=3;URL=index.php>";
		
}

// �ѧ���ડ�������Ǣ�������������
function CheckNew($post_time =""){  // "TIME",date("Y-m-d")
 $day = date("d",strtotime($post_time))+1;
 $resultday = date("Y-m-").$day;
	if (TIME <=  $resultday) { echo "<img src='img/new.gif'>";}
}
//�ѧ���ત��� ����Ǣ�ͷ���� update �������
function CheckUpdate($update_time =""){  // "TIME",date("Y-m-d")
if ( $update_time != ""){

	if (time()-86400 <=  $update_time) { echo "<img src='img/update.gif'>";}
}
}


// �ѧ��蹷��ત�������Ǣ�ͷ���դ�����ҡ���� 100 �������
function CheckHot($hot =""){  // "TIME",date("Y-m-d")

	if ($hot >= 50) { echo "<img src='img/hot.gif'>";}
}
function Level($level=""){ // Function Up Level ��Ҫԡ return ���ٻ���
		if ($level <= 3 ){ 
		echo "<img src='img/star.png'>";
		} else if ($level <= 6){
		echo "<img src='img/star.png'><img src='img/star.png'>";
		}else {
		echo "<img src='img/star.png'><img src='img/star.png'><img src='img/star.png'>";
		}
}
function CheckUser(){ // Function �����ͺ��� �� Login �������
@session_start();
				if (!session_is_registered("login"))  {
						echo "<br><center>��س� Login �������к���͹��Ѻ</center><br>";
						echo "<meta http-equiv=refresh content=3;URL=index.php>";
						exit();
				}
}
function CheckAdmin(){ // Function �����ͺ�����������������
		if($_SESSION[login]=="admin"){
				return true;
		}else{ 
				return false;
		}
}
function CheckLogin(){ // Function �����ͺ��� �� Login �������
 			if (session_is_registered("login")){ echo "<meta http-equiv=refresh content=0;URL=?p=mi>"; 
 			exit();} 
}
function Login(){
 			if (session_is_registered("login") ){ // Function �����ͺ��� �� Login �������
			return true;
			}else{
			return false;
			}
}
function LevelUp($result="",$user=""){ // Function Up Level ��Ҫԡ return ���ٻ���
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