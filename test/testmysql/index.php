 <?php 
require_once 'db_connect.php';
 //start------------------กำหนดตัวแปลจาก Databases-----------------------
	$value1 = 'id';
	$value2 = 'name';
	$value3 = 'surname';
	$value4 = 'grade';
	function getsumfieldmysql($value1) {
		$strSQL = "SELECT * FROM ".$value1;
		$objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");
		$intNumField = mysql_num_fields($objQuery);
		return $intNumField;		
		mysql_close($objConnect);
	}
	
	function getfieldmysql($value1) {
		$strSQL = "SELECT * FROM ".$value1;
		$objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");
		$intNumField = mysql_num_fields($objQuery);
		$i = 0;		
		$valu = array();
		for ($i = 0; $i <= $intNumField; $i++) {
			$j=$i+1;
			$valu[$j] = mysql_field_name($objQuery, $i);
		}
		return $valu;
		mysql_close($objConnect);
	}
	$dbcp = _MEMBER;
 ?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
 <form name="form2" method="post" action="save.php">
                    <table width="500" border="0" cellspacing="5" cellpadding="5">
                        <tr>
                            <td colspan="2"><div align="center"><a name="link1">กรอกข้อมูลนักเรียน</a></div></td>
                        </tr>
                        <tr>
                            <td width="120"><div align="right">ชื่อ</div></td>
                            <td width="374"><input name="<?php echo $value2;?>" type="text" id="<?php echo $value2;?>" size="50" value=11></td>
                        </tr>
                        <tr>
                            <td width="120"><div align="right">สกุล</div></td>
                            <td width="374"><input name="<?php echo $value3;?>" type="text" id="<?php echo $value3;?>" size="50" value=22></td>
                        </tr>
                        <tr>
                            <td width="120"><div align="right">ห้อง</div></td>
                            <td width="374"><input name="<?php echo $value4;?>" type="text" id="<?php echo $value5;?>" size="50" value=33></td>
                        </tr>
                        <tr>
                            <td><div align="right"></div></td>
                            <td><input type="submit" name="Submit" value="เพิ่มสมาชิก"></td>
                        </tr>
                    </table>
                </form>

<body>
</body>
</html>
                