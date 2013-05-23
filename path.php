<?php
session_start();
if (@eregi("path.php",$PHP_SELF)) { 
	header("HTTP/1.0 404 Not Found");
	die("Error...");
}
require_once "setting.php" ;
require_once "class.mysql.php" ;
require_once "function.php";

$db = New __DATABASE(""._DB_HOSTNAME."",""._DB_USERNAME.""	,""._DB_PASSWORD."",""._DB_DATABASE."") ;
$db->connectdb();
$f = intval($_GET[f]);
$id = intval($_GET[id]);
$cat = trim($_GET[cat]);
$user = trim($_GET[user]);
$action = trim($_GET[action]);
?>

