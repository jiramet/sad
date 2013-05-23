<?php
$username = "test"; 
$password = "123"; 
function authenticate() { 
header("WWW-authenticate: basic realm='Protected'"); 
header("HTTP/1.0 401 Unauthorized"); 
echo "You must enter a valid login ID and password! "; 
exit; 
} 
function CheckPwd($user,$pass) { 
	global $username,$password; 
	return ($user != $username || $pass != $password)?false:true; 
} 
if(!isset($PHP_AUTH_USER)) { 
	authenticate(); 
}elseif(!CheckPwd($PHP_AUTH_USER,$PHP_AUTH_PW)) { 
	authenticate(); 
} 
?>