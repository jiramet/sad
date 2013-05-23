<?php
// ฟังก์ชันสำหรับเชื่อมต่อกับฐานข้อมูล
function connect()
{
  // เริ่มต้นส่วนกำหนดการเชิ่อมต่อฐานข้อมูล //
  $HOST="localhost"; // ชื่อ server หรือ domain name ปกติใช้ localhost
  $PORT=""; // กำหนดหรือไม่ก็ได้
  $DB_USER="root"; // ชื้อผู้ใช้
  $DB_PWD="l[kpfu"; // รหัสผ่าน
  $DB_NAME="school";	 // ชื่อฐานข้อมูล
  // สิ้นสุุดส่วนกำหนดการเชิ่อมต่อฐานข้อมูล // 
  $DB_HOST=(!empty($PORT)) ? $HOST.":".$PORT : $HOST;
  if(@mysql_connect($DB_HOST,$DB_USER,$DB_PWD)){
	  $conServ=@mysql_select_db($DB_NAME) or die("SQL Error: <br>".mysql_error());	  
  }else{
	  die("SQL Error: <br>".mysql_error());	  
  }
}
//	  ฟังก์ชันสำหรับคิวรี่คำสั่ง sql
function query($sql)
{
  if(@mysql_query($sql)) { return true; } 
  else { die("SQL Error: <br>".$sql."<br>".mysql_error()); return false; }
}
//    ฟังก์ชัน select ข้อมูลในฐานข้อมูลมาแสดง
function select($sql)
{
  $result=array();
  $req =@mysql_query($sql) or die("SQL Error: <br>".$sql."<br>".mysql_error());
  while($data=@mysql_fetch_assoc($req)) {
    $result[]=$data;
  }
  return $result;	
}
//    ฟังก์ชันสำหรับการ insert ข้อมูล
function insert($table,$data)
{
  $fields=""; $values="";
  $i=1;
  foreach($data as $key=>$val)
  {
    if($i!=1) { $fields.=", "; $values.=", "; }
    $fields.="$key";
    $values.="'$val'";
    $i++;
  }
  $sql = "INSERT INTO $table ($fields) VALUES ($values)";
  if(@mysql_query($sql)) { return true; } 
  else { die("SQL Error: <br>".$sql."<br>".mysql_error()); return false;}
}
//    ฟังก์ชันสำหรับการ update ข้อมูล
function update($table,$data,$where)
{
  $modifs="";
  $i=1;
  foreach($data as $key=>$val)
  {
    if($i!=1){ $modifs.=", "; }
    if(is_numeric($val)) { $modifs.=$key.'='.$val; }
    else { $modifs.=$key.' = "'.$val.'"'; }
    $i++;
  }
  $sql = ("UPDATE $table SET $modifs WHERE $where");
  if(@mysql_query($sql)) { return true; } 
  else { die("SQL Error: <br>".$sql."<br>".mysql_error()); return false; }
}
//    ฟังก์ชันสำหรับการ delete ข้อมูล
function delete($table, $where)
{
  $sql = "DELETE FROM $table WHERE $where";
  if(@mysql_query($sql)) { return true; } 
  else { die("SQL Error: <br>".$sql."<br>".mysql_error()); return false; }
}
//    ฟังก์ชันสำหรับแสดงรายการฟิลด์ในตาราง
function listfield($table)
{
	$req=@mysql_query("SELECT * FROM $table");
	$numberfields =@mysql_num_fields($req);
	$row_title="\$data=array(<br/>";
	for($i=0; $i<$numberfields ; $i++ ) {
		   $var=@mysql_field_name($req, $i);
		   $row_title.="\"$var\"=>\"value$i\",<br/>";
	}
	$row_title.=");<br/>";
	echo $row_title;
}
?>