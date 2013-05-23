<?php
header("Content-type:text/html; charset=UTF-8");              
header("Cache-Control: no-store, no-cache, must-revalidate");             
header("Cache-Control: post-check=0, pre-check=0", false);   
mysql_connect("localhost","root","l[kpfu") or die("Cannot connect the Server");   
mysql_select_db("ajaxadd") or die("Cannot select database");   
mysql_query("set character set utf8");  
?>
<?php   
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){   
	global $e_page;
	global $querystr;
	$urlfile="ajax_data.php"; // ส่วนของไฟล์เรียกใช้งาน ด้วย ajax (ajax_dat.php)
	$per_page=10;
	$num_per_page=floor($chk_page/$per_page);
	$total_end_p=($num_per_page+1)*$per_page;
	$total_start_p=$total_end_p-$per_page;
	$pPrev=$chk_page-1;
	$pPrev=($pPrev>=0)?$pPrev:0;
	$pNext=$chk_page+1;
	$pNext=($pNext>=$total_p)?$total_p-1:$pNext;		
	$lt_page=$total_p-4;
	if($chk_page>0){  
		echo "<a  href='$urlfile?s_page=$pPrev&querystr=".$querystr."' class='naviPN'>Prev</a>";
	}
	for($i=$total_start_p;$i<$total_end_p;$i++){  
		$nClass=($chk_page==$i)?"class='selectPage'":"";
		if($e_page*$i<=$total){
		echo "<a href='$urlfile?s_page=$i&querystr=".$querystr."' $nClass  >".intval($i+1)."</a> ";   
		}
	}		
	if($chk_page<$total_p-1){
		echo "<a href='$urlfile?s_page=$pNext&querystr=".$querystr."'  class='naviPN'>Next</a>";
	}
}   
?>
<?php
// ส่วนของการเพิ่ม ลบ แก้ไข ข้อมูล
if($_GET['method']=="insert"){
	if($_POST['h_member_id']!=""){
		$q="UPDATE  `tbl_member` SET `member_name` = '".$_POST['member_name']."',
`member_password` = '".$_POST['member_password']."',
`member_fullname` = '".$_POST['member_fullname']."',
`member_type` = '".$_POST['member_type']."' WHERE `tbl_member`.`member_id` ='".$_POST['h_member_id']."' ";
	}else{
		$q="INSERT INTO `tbl_member` (
		`member_id` ,
		`member_name` ,
		`member_password` ,
		`member_fullname` ,
		`member_type` 
		)
		VALUES (
		NULL , '".$_POST['member_name']."', '".$_POST['member_password']."',
		 '".$_POST['member_fullname']."', '".$_POST['member_type']."'
		);";		
	}
	mysql_query($q);	
}
if($_GET['method']=="delete"){
	$q="DELETE FROM tbl_member WHERE member_id='".$_POST['id']."' ";
	mysql_query($q);	
	exit;
}
if($_GET['method']=="getupdate"){
	$q="SELECT * FROM tbl_member WHERE member_id='".$_POST['id']."' ";
	$qr=mysql_query($q);	
	$rs=mysql_fetch_array($qr);
	echo $rs['member_id']."|";
	echo $rs['member_name']."|";
	echo $rs['member_password']."|";
	echo $rs['member_fullname']."|";
	echo $rs['member_type'];
	exit;
}
?>
<?php
//////////////////////////////////////// เริ่มต้น ส่วนเนื้อหาที่จะนำไปใช้ในไฟล์ ที่เรียกใช้ด้วย ajax
?>

<?php
$q="select * from tbl_member where 1";
$q.=" ORDER BY member_id DESC   ";
$qr=mysql_query($q);
$total=mysql_num_rows($qr);
$e_page=5; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
if(!isset($_GET['s_page'])){   
	$_GET['s_page']=0;   
}else{   
	$chk_page=$_GET['s_page'];     
	$_GET['s_page']=$_GET['s_page']*$e_page;   
}   
$q.=" LIMIT ".$_GET['s_page'].",$e_page";
$qr=mysql_query($q);
if(mysql_num_rows($qr)>=1){   
	$plus_p=($chk_page*$e_page)+mysql_num_rows($qr);   
}else{   
	$plus_p=($chk_page*$e_page);       
}   
$total_p=ceil($total/$e_page);   
$before_p=($chk_page*$e_page)+1;  
?>
<?php
$arr_typemember=array(
	"1"=>"ประเภทที่ 1",
	"2"=>"ประเภทที่ 2"
);
?>
<table width="500" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td width="35" height="20" align="center" bgcolor="#CCCCCC">#</td>
  <td height="20" align="center" bgcolor="#CCCCCC">ชื่อ นามสกุล</td>
  <td width="150" height="20" align="center" bgcolor="#CCCCCC">ประเภท</td>
  <td height="20" colspan="2" align="center" bgcolor="#CCCCCC">จัดการ</td>
  </tr>
<?php
$i=1;
while($rs=mysql_fetch_array($qr)){
?>  
<tr>
  <td height="20" align="center"><?=($chk_page*$e_page)+$i?></td>
  <td height="20" align="left">&nbsp; <?=$rs['member_fullname']?></td>
  <td height="20" align="center">&nbsp; <?=$arr_typemember[$rs['member_type']]?></td>
  <td width="45" height="20" align="center"><a href="#<?=$rs['member_id']?>" class="updateItem">แก้ไข</a></td>
  <td width="45" height="20" align="center"><a href="#<?=$rs['member_id']?>" class="delItem">ลบ</a></td>
</tr>
<?php $i++; } ?>
</table>

<?php if($total>0){ ?>
<div class="browse_page">
 <?php   
 // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
  page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);    
  ?> 
</div>
<?php } ?>
<?php
////////////////////////////////////////////  จบ ส่วนเนื้อหาที่จะนำไปใช้ในไฟล์ ที่เรียกใช้ด้วย ajax
?>