<?php 
	if(empty($_POST['sex'])){
		$sex='0';
		echo $sex;
	}else {
		$sex=$_POST['sex'];
		echo $sex;
	}
	echo $_POST['testsex'];
?>