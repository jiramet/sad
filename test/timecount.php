<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php 
session_start(); 
if (!isset($_SESSION['timeend'])){ 
	unset($_SESSION['timeend']);
    $endtime = time() + 10; 
    $_SESSION['timeend'] = $endtime; 
} 

($_SESSION['timeend'] - time()) < 0 ? $EndTime = 0 :  $EndTime = $_SESSION['timeend'] - time();

if($EndTime <= 0) { 
	unset($_SESSION['timeend']);
//session_destroy(); 
} 

?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
แกเหลือเวลา <span id="timer" style="color:red;"><?=$EndTime?></span> วินาที นะเฟร้ย


<script type="text/javascript"> 
var pastTime = <?=$EndTime;?>; 

function mycountdown(){ 
      if(pastTime > 0) { 
            pastTime -= 1; 
            document.getElementById('timer').innerHTML = pastTime; 
      } 
if(pastTime < 1) { 
            window.location = "http://www.google.com/" 
      } 
} 
	if(pastTime >0){
		setInterval(mycountdown,1000); 
	}
</script>
</body>
</html>