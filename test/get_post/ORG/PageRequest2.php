<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
$tests=$_POST['txtname'];
echo $_REQUEST["txtName"]."<br>"; // txtName
echo $_REQUEST["txtSiteName"]."<br>"; // txtSiteName
echo "<hr>";


foreach($_REQUEST as $key => $val) // All Key & Value
{
	if ($key=='Submit'){
		break;
	}else{
		$strstring2 .=  $key . " : " . $val . "&nbsp;";
	}
}

echo $strstring2."<br>";



echo 'test';


?>
</body>
</html>