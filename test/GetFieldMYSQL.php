<html>
<head>
<title>ThaiCreate.Com PHP & MySQL Tutorial</title>
</head>
<body>
<?
	$objConnect = mysql_connect("localhost","root","l[kpfu") or die("Error Connect to Database");
	$objDB = mysql_select_db("sad");
	$strSQL = "SELECT * FROM member";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$intNumField = mysql_num_fields($objQuery);
	$i = 0;
	echo "<b>Table customer have $intNumField Fields.</b><br>";

	for($i=0;$i<$intNumField;$i++)
	{
		echo $i."=".mysql_field_name($objQuery,$i)."<br>";	
	}
	mysql_close($objConnect);
?>
</body>
</html>