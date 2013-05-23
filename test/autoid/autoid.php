<?php
	$host='localhost';
	$userdb='root';
	$passdb='l[kpfu';
	$db='school';
	$objConnect = mysql_connect($host, $userdb, $passdb) or die("Error Connect to Database");
	$objDB = mysql_select_db($db);
	
	    //$new_id =mysql_result(mysql_query("Select Max(substr(std_id,-4))+1 as MaxID from  std"),0,"MaxID");
	    $new_id =mysql_query("Select Max(substr(id_mem,1,0))+1 as MaxID from  member");
		//$strSQL = "SELECT * FROM member WHERE 1";
		//$strSQL = "substr(std_id,-4))+1 as MaxID from  std"),0,"MaxID";
		//$objQuery = @mysql_query($strSQL);
		//$ret = @mysql_fetch_array($new_id);
		//$ret3 = $ret[id_mem];
		
		//echo $new_id;
		
	 // $last_id = "SELECT MAX(id_mem) AS maxid FROM member"; // query อ่านค่า id สูงสุด
	  $last_id = mysql_result(mysql_query("SELECT Max(substr(id_mem,-1))+1 as MaxID from member"),0,"MaxID"); // query อ่านค่า id สูงสุด
      $ret = mysql_fetch_assoc($result); // อ่านค่า
      echo '</br>'.$last_id;
      echo '</br>'.substr($last_id, 1);
      echo '</br>'.$ret[0];
	
?>