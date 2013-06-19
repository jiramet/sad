<?php
function _go($url = "http://www.ichat.in.th",$time = 0){
	echo"<meta http-equiv='refresh' content='".$time.";URL=".$url."'>";
}

function getJavaAlert($msg = "",$go = 1){ ?>
<script language="javascript">
alert("<?=$msg;?>")
<?php if ($go){ ?>
javascript:history.go(-1)
<?php } ?>
</script>
<?php }

		//======================Function การแบ่งหน้า===============================
function SplitPage($page = 1,$totalpage = 1,$option = ""){
	if($totalpage <= 1){

	}else if($totalpage <= 10){
		if($totalpage >= 3){
			echo '<div><a href="'.$option.'1" target="_self"><span class="preicon">หน้าแรก</span></a> | ';
			echo 'ทั้งหมด '.$totalpage.' หน้า';
			echo ' | <a href="'.$option.''.$totalpage.'" target="_self">หน้าสุดท้าย <span class="nexticon">&nbsp;</span></a> </div>';
		}

		if($page == 1){

			echo '<span class="preicon">&nbsp;</span>| <span class="tal bold f16">'.$page.'</span> | ';
			for($l = 2; $l <= $totalpage; $l++){
				echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
			}

			echo '<a href="'.$option.''.($page+1).'" target="_self"> <span class="nexticon">&nbsp;</span></a>';


		}else if($page == $totalpage){
			echo '<a href="'.$option.''.($page-1).'" target="_self"><span class="preicon"></span></a> | ';

			for($l = 1; $l < $totalpage; $l++){
				echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
			}

			echo '<span class="tal bold f16">'.$page.'</span> | <span class="nexticon">&nbsp;</span>';

		}else{
			echo '<a href="'.$option.''.($page-1).'" target="_self"><span class="preicon"></span></a> | ';

			for($l = 1 ; $l < $page; $l++){
				echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
			}

			echo '<span class="tal bold f16">'.$page.'</span> |';

			for($r = $page+1 ; $r <= $totalpage; $r++){
				echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
			}

			echo '<a href="'.$option.''.($page+1).'" target="_self"> <span class="nexticon">&nbsp;</span></a>';

		}
	}else{

		if($totalpage >= 3){
			echo '<div><a href="'.$option.'1" target="_self"><span class="preicon">หน้าแรก</span></a> | ';
			echo 'ทั้งหมด '.$totalpage.' หน้า';
			echo ' | <a href="'.$option.''.$totalpage.'" target="_self">หน้าสุดท้าย <span class="nexticon">&nbsp;</span></a> </div>';
		}

		if($page == 1){

			echo '<span class="preicon">&nbsp;</span>| <span class="tal bold f16">'.$page.'</span> | ';
			for($l = 2; $l <= 5; $l++){
				echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
			}
			echo '... | ';
			for($r = $totalpage - 4; $r <= $totalpage; $r++){
				echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
			}

			echo '<a href="'.$option.''.($page+1).'" target="_self"> <span class="nexticon">&nbsp;</span></a>';


		}else if($page == $totalpage){
			echo '<a href="'.$option.''.($page-1).'" target="_self"><span class="preicon"></span></a> | ';

			for($l = 1; $l <= 5; $l++){
				echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
			}
			echo '... | ';
			for($r = $totalpage - 4; $r < $totalpage; $r++){
				echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
			}

			echo '<span class="tal bold f16">'.$page.'</span> | <span class="nexticon">&nbsp;</span>';

		}else{

			if($page > 1 and $page < 10){
				echo '<a href="'.$option.''.($page-1).'" target="_self"><span class="preicon"></span></a> | ';

				for($l = 1 ; $l < $page; $l++){
					echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
				}

				echo '<span class="tal bold f16">'.$page.'</span> | ';

				for($r = $page+1 ; $r <= 10; $r++){
					echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
				}
				echo '... | ';
				echo '<a href="'.$option.''.$totalpage.'" target="_self">'.$totalpage.'</a> | ';

				echo '<a href="'.$option.''.($page+1).'" target="_self"> <span class="nexticon">&nbsp;</span></a>';
			}else if($page >= $totalpage - 8 and $page < $totalpage){
				echo '<a href="'.$option.''.($page-1).'" target="_self"><span class="preicon"></span></a> | ';
				echo '<a href="'.$option.'1" target="_self">1</a> | ';
				echo '... | ';
				for($l = $totalpage - 9 ; $l < $page; $l++){
					echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
				}
				echo '<span class="tal bold f16">'.$page.'</span> | ';
				for($r = $page+1 ; $r <= $totalpage; $r++){
					echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
				}
				echo '<a href="'.$option.''.($page+1).'" target="_self"> <span class="nexticon">&nbsp;</span></a>';
			}else{
				echo '<a href="'.$option.''.($page-1).'" target="_self"><span class="preicon"></span></a> | ';
				for($l = 1 ; $l <= 3; $l++){
					echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
				}
				echo '... | ';
				echo '<a href="'.$option.''.($page-1).'" target="_self">'.($page-1).'</a> | ';
				echo '<span class="tal bold f16">'.$page.'</span> | ';
				echo '<a href="'.$option.''.($page+1).'" target="_self">'.($page+1).'</a> | ';
				echo '... | ';

				for($r = $totalpage - 2; $r <= $totalpage; $r++){
					echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
				}

				echo '<a href="'.$option.''.($page+1).'" target="_self"> <span class="nexticon">&nbsp;</span></a>';
			}
		}
	}
}
		//======================จบFunction การแบ่งหน้า===============================


	#Mod เขียนนะครับ
	# function  Check ว่า  มีค่า 1 หรือ เป็นค่าว่าง  ถ้าเป็นค่าว่างให้ มีค่า = 0
	# echo fnc0(test);

	function fnc0($value) {
		if ($_POST[$value] == 1) {
			$ret = 1;
			return $ret;
		} else {
			$ret = 0;
			return $ret;
		}
	}

	#Permission
	#action = add edit del open
	#permiss = เป็นข้อมูลที่ดึงจาก Databases มีค่า 1 กับ 0
	#id = เป็นค่าที่ส่งมาเพื่อ ระบุ id ที่จะลบ
	#text = ขอความที่จะให้แสดงออกมา เช่น เพิ่มสมาชิค ลบ แก้ไข  เพื่อ แสดงให้ user เห็น ชื่อปุ่ม
	#if (empty($Vnum)) {   empty  ตรวจสอบว่ามีค่าในตัวแปลหรือเปล่า  if (!(empty($i)) ){

	/* วิธีใช้ Function
	 *  รูปแบบกรกรอก
	 *  fperurl($f, $action, $id, $text, $permiss)
	 *
	 *          	  fperurl(      $f,           $action,     $id,        $text,                    $permiss, 			$page)
	 *  	echo fperurl($_GET['f'],      'add',       '$id',     'เพิ่มสมาชิค',     $wurl3->mp_aper,	$page=2);
	 *
	 *  	echo fperurl($_GET['f'], 'add', '', 'เพิ่มสมาชิค', $wurl3->mp_aper);
	 */

	$objConnect = mysql_connect($host, $userdb, $passdb) or die("Error Connect to Database");
	$objDB = mysql_select_db($db);

	function fperurl($f, $action, $id, $text, $permiss, $page) {
		$strSQL = "SELECT * FROM wurl WHERE w_url="."'$f'";
		$objQuery = @mysql_query($strSQL);
		$ret = @mysql_fetch_array($objQuery);
		$ret3 = $ret[w_id];
		//return $ret3;

		$strSQL1 = "SELECT * FROM mpermission WHERE mp_mid = ".$_SESSION["gpid"]." and mp_wid="."'$ret[w_id]'" ;
		$objQuery1 = @mysql_query($strSQL1);
		$ret1 = @mysql_fetch_array($objQuery1);
		$ret2 = $ret1[mp_wper];


		// select w1.w_id, w1.w_url, m1.mp_mid, m1.mp_wid from wurl w1, mpermission m1  where m1.mp_mid = "14" and m1.mp_wid = "1"

		if (!(empty($action)) and !(empty($id)) and $permiss == 1) { 			// เปิดดู แก้ไข ลบ   มีค่า ใน Action   และ id
			if ($action == 'open' or $action == 'edit') {    										// เปิดดู  แก้ไข
				$ret = ' [ <a href="index.php?f='.$f.'&action='.$action.'&id='.$id.'&page='.$page. '#link1" >'.$text.'</a> ] |';
				return $ret;
			}elseif ($action == 'del'){      																// ลบอย่างเดียวเลย
				$ret=  ' [ <a href="index.php?f=' . $f. '&action='.$action.'&id='.$id.'&page='.$page. ' " onclick="return confirm(\'คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?\')" >ลบ</a> ] |';
				return $ret;
			}
		} elseif (!(empty($action)) and empty($id) and $permiss == 1) {  			//เพิ่มข้อมูล มีค่าใน Act แต่ id ไม่มีค่า
			$ret = ' [ <a href="index.php?f='.$f.'&action='.$action.'#link1">'.$text.'</a> ]';
			return $ret;
		} elseif (empty($action) and !(empty($id)) and $ret1[mp_wper] == 1) {    // สิทธิ ในการเข้าขึง   ไม่มีค่าใน Act.  แต่มีค่า ID
			$ret = ' [ <a href="index.php?f='.$f.'&id='.$id.'">'.$text.'</a> ]';
			return $ret;
		} elseif (empty($action) and empty($id) and $ret1[mp_wper] == 1) {     	// ไปหน้า อื่น  ไม่ทั้ง Acc และ ID  w
			$ret = ' [ <a href="index.php?f='.$f.'">'.$text.'</a> ]';
			return $ret;
		}

	}

			//======================Function เช็คสิทธิในการเข้าถึง หน้า Page นั้น ๆ===============================
	/*
	 * มดเขียนครับ
	 * function
	 */
	function fpermiss($f){
		//$ret = $db->fetch($db->query("SELECT * FROM "._WURL." WHERE w_url="."'$f'"));
		$strSQL = "SELECT * FROM "._WURL." WHERE w_url="."'$f'";
		$objQuery = @mysql_query($strSQL);
		$ret = @mysql_fetch_array($objQuery);
		//$ret3 = $ret[w_id];
		//return $ret3;

//	$strSQL1 = "SELECT * FROM "._MPER."  WHERE mp_mid = ".$_SESSION["id"]." and mp_wid="."'$ret[w_id]'" ;
	$strSQL1 = "SELECT * FROM "._MPER."  WHERE mp_mid = ".$_SESSION["gpid"]." and mp_wid="."'$ret[w_id]'" ;
		$objQuery1 = @mysql_query($strSQL1);
		$ret1 = @mysql_fetch_array($objQuery1);
		$ret2 = $ret1[mp_wper];
		//return $ret2;
		if ($ret2==0){
			getJavaAlert("คุณไม่มีสิทธิ เข้า หน้านี้ครับ  อะ อะ อย่า Hack กันนิ สาด....", 0);
			_go("index.php");
		}

	}
				//จบFunction เช็คสิทธิในการเข้าถึง หน้า Page นั้น ๆ

				//=========Function ในการตรวจสอบ การเข้าถึง ภายใน Page เช่น เพิ่ม, แก้ไข, ลบ, และ การจัดการสิทธิ===========================
				//finwebper ย่อมาจาก  Function in web permission
				function finwebper($f,$action) {

					$strSQL = "SELECT * FROM "._WURL." WHERE w_url="."'$f'";
					$objQuery = @mysql_query($strSQL);
					$ret = @mysql_fetch_array($objQuery);

					$strSQL1 = "SELECT * FROM "._MPER."  WHERE mp_mid = ".$_SESSION["gpid"]." and mp_wid="."'$ret[w_id]'" ;
					$objQuery1 = @mysql_query($strSQL1);
					$ret1 = @mysql_fetch_array($objQuery1);
					$ret3 = $ret1[mp_oper];
					//return $ret2;
					if ($action == 'open' and $ret3 == 0){
						getJavaAlert("คุณไม่มีสิทธิ เข้า หน้านี้ครับ  อะ อะ อย่า Hack กันนิ สาด....1".$ret3.$action, 0);
						_go("index.php");
					}elseif ($action == 'add' and $ret1[mp_aper] == 0) {
						getJavaAlert("คุณไม่มีสิทธิ เข้า หน้านี้ครับ  อะ อะ อย่า Hack กันนิ สาด....2", 0);
						_go("index.php");
					}elseif ($action == 'edit' and $ret1[mp_eper] == 0) {
						getJavaAlert("คุณไม่มีสิทธิ เข้า หน้านี้ครับ  อะ อะ อย่า Hack กันนิ สาด....3", 0);
						_go("index.php");
					}elseif ($action == 'del' and $ret1[mp_dper] == 0) {
						getJavaAlert("คุณไม่มีสิทธิ เข้า หน้านี้ครับ  อะ อะ อย่า Hack กันนิ สาด....4", 0);
						_go("index.php");
					}elseif ($action == 'search' and $ret1[mp_sper] == 0) {
						getJavaAlert("คุณไม่มีสิทธิ เข้า หน้านี้ครับ  อะ อะ อย่า Hack กันนิ สาด....5", 0);
						_go("index.php");
					}


				}



		      	//จบ===Function ในการตรวจสอบ การเข้าถึง ภายใน Page เช่น เพิ่ม, แก้ไข, ลบ, และ การจัดการสิทธิ





				//======================Function ดึงรายชื่อ Field ใน Mysql ออกมาใช้งาน===============================

	//Function หาจำนวน Field ใน Mysql
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
		for ($i = 0; $i < $intNumField; $i++) {
			$j=$i+1;
			$valu[$j] = mysql_field_name($objQuery, $i);
		}
		return $valu;
		mysql_close($objConnect);
	}





?>