<?
$a="test";
if (@eregi("class.mysql.php",$_SERVER['PHP_SELF'])) {
    die("ไม่พบไฟล์ที่คุณกำลังเรียกอยู่<br>
	กำลังพาคุณกลับไปที่หน้าหลัก<br>
	<meta http-equiv='refresh' content='3;url=../index.php'>");
}

define("_DB_HOSTNAME","localhost");
define("_DB_USERNAME","root");
define("_DB_PASSWORD","l[kpfu");
define("_DB_DATABASE","sad");
define("_MEMBER","member");
define("_PRODUCT","product");
define("_ORDER","orders");
define("_TITLE","title");
define("_WURL","wurl");
define("_MPER","mpermission");

$db = New __DATABASE(""._DB_HOSTNAME."",""._DB_USERNAME.""
					,""._DB_PASSWORD."",""._DB_DATABASE."") ;
$db->connectdb();

class __DATABASE{
	var $db_host ;
	var $db_user ;
	var $db_pass ;
	var $db_database ;
	var $db_connectdb ;
	var $db_selectdb ;

	function __construct($db_host="localhost",$db_user="user",$db_pass="pass",$db_database="database"){
		$this->db_host = $db_host;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_database = $db_database;
	}
	# ติดต่อฐานข้อมูล
	function connectdb(){
		$this->db_connectdb = mysql_connect ( $this->db_host, $this->db_user, $this->db_pass ) or $this->_error();
		$this->db_selectdb = mysql_select_db ( $this->db_database) or $this->_error();
		mysql_query("SET NAMES UTF8"); 
		mysql_query("SET character_set_results=UTF8"); 
		return true;
	}
	
	# ปิดการเชื่อมต่อฐานข้อมูล
	function closedb(){
		mysql_close ( $this->db_connectdb ) or $this->_error();
	}

	# เพิ่มข้อมูลลงฐานข้อมูล
	# $db->add_db("table",array("field"=>"value")); 
	function add_db($table="table", $data="data"){
		$key = array_keys($data); 
        $value = array_values($data); 
		$sumdata = count($key); 
		for ($i=0;$i<$sumdata;$i++) 
        { 
            if (empty($add)){ 
                $add="("; 
            }else{ 
                $add=$add.","; 
            } 
            if (empty($val)){ 
                $val="("; 
            }else{ 
                $val=$val.","; 
            } 
            $add=$add.$key[$i]; 
            $val=$val."'".$value[$i]."'"; 
        } 
        $add=$add.")"; 
        $val=$val.")"; 
        $sql="INSERT INTO ".$table." ".$add." VALUES ".$val; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
	}

	# อัพเดรตข้อมูลลงฐานข้อมูล 
	# $db->update_db("tabel",array("field"=>"value"),"where"); 
    function update_db($table="table",$data="data",$where="where"){ 
        $key = array_keys($data); 
        $value = array_values($data); 
        $sumdata = count($key); 
        $set=""; 
        for ($i=0;$i<$sumdata;$i++) 
        { 
            if (!empty($set)){ 
                $set=$set.","; 
            } 
            $set=$set.$key[$i]."='".$value[$i]."'"; 
        } 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	# อัพเดรตฐานข้อมูลลงฐานข้อมูลแบบเดี๋ยว
	# $db->update("table","set","where");
	function update($table="table",$set="set",$where="where"){ 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	# ลบตาราง
	# $db->del("table","where"); 
    function del($table="table",$where="where"){ 
        $sql="DELETE FROM ".$table." WHERE ".$where; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	# หาจำนวนแถว
	# $db->num_rows("table","field","where"); 
    function num_rows($table="table",$field="field",$where="where") { 
        if ($where=="") { 
            $where = ""; 
        } else { 
            $where = " WHERE ".$where; 
        } 
        $sql = "SELECT ".$field." FROM ".$table.$where; 
        if($res = mysql_query($sql)){ 
            return mysql_num_rows($res); 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	# Query ช้อมูลในฐานข้อมูล
	# $res = $db->query('SELECT field FROM table WHERE where'); 
    function query($sql="sql"){ 
        if ($res = mysql_query($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	# นับจำนวนเรคคอร์ด
	# $res = $db->query('SELECT field FROM table WHERE where'); 
	# $rows = $db->rows($res); 
    function rows($sql="sql"){ 
      if ($res = mysql_num_rows($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	# เอาข้อมูลออกมาเป็น array
	# $res = $db->query('SELECT field FROM table WHERE where'); 
	# while ($arr = $db->fetch($res)) { 
	# 		echo $arr['a']." - ".$arr['c']."<br>\n"; 
	# }
    function fetch($sql="sql"){ 
      if ($res = mysql_fetch_object($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        }
    } 
	# show Error
    function _error(){ 
        $this->error[]= mysql_errno(); 
    } 
	
	function anty_db($query = ""){
		return htmlspecialchars(trim($query));
	}

}

#Mod เขียนนะครับ
# function  Check ว่า  มีค่า 1 หรือ เป็นค่าว่าง  ถ้าเป็นค่าว่างให้ มีค่า = 0
# echo fnc0(test);

function fnc0($value)
{
	if ($_POST[$value]==1){
		$ret=1;
		return $ret;
	}else{
		$ret=0;
		return $ret;
	}
}

?>