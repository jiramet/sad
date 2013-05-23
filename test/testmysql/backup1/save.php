<?php
	include("db_connect.php");
	connect();
	$strstring2=array();
	foreach ($_REQUEST as $key => $val) // All Key & Value
		{
		if ($key == 'Submit') {
			break;
		} else {
			$strstring2[$key]= trim($val);

		}
	}

    insert("student", $strstring2); // student คือชื่อตาราง	
	
	
?>