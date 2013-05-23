<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="canonical" href="http://www.ninenik.com/demo/page_navi3_demo.php"/>
<title>ฟังก์ชัน php แบ่งหน้า แบบ ajax แต่งด้วย css สวยๆ</title>
<style type="text/css">
.browse_page{
	clear:both;
	margin-left:12px;
	height:35px;
	margin-top:5px;
	display:block;
}
.browse_page a,.browse_page a:hover{
	display:block;
	height:18px;
	width:18px;
	font-size:10px;
	float:left;
	margin-right:2px;
	border:1px solid #CCCCCC;
	background-color:#F4F4F4;
	color:#333333;
	text-align:center;
	line-height:18px;
	font-weight:bold;
	text-decoration:none;
}
.browse_page a:hover{
	border:1px solid #0A85CB;
	background-color:#0A85CB;
	color:#FFFFFF;
}
.browse_page a.selectPage{
	display:block;
	height:18px;
	width:18px;
	font-size:10px;
	float:left;
	margin-right:2px;
	border:1px solid #0A85CB;
	background-color:#0A85CB;
	color:#FFFFFF;
	text-align:center;
	line-height:18px;
	font-weight:bold;
}
.browse_page a.SpaceC{
	display:block;
	height:18px;
	width:18px;
	font-size:10px;
	float:left;
	margin-right:2px;
	border:0px dotted #0A85CB;
	font-size:11px;
	background-color:#FFFFFF;
	color:#333333;
	text-align:center;
	line-height:18px;
	font-weight:bold;
}
.browse_page a.naviPN{
	width:50px;
	font-size:12px;
	display:block;
	height:18px;
	float:left;
	border:1px solid #0A85CB;
	background-color:#0A85CB;
	color:#FFFFFF;
	text-align:center;
	line-height:18px;
	font-weight:bold;	
}
</style>
</head>

<body>
<?php
$link=mysql_connect("localhost","root","test");
mysql_select_db("test");
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
<div id="showData" style="width:550px;margin:auto;padding:10px;border:1px solid #CCC;">
<?php
//////////////////////////////////////// เริ่มต้น ส่วนเนื้อหาที่จะนำไปใช้ในไฟล์ ที่เรียกใช้ด้วย ajax
?>
<ul>
<?php
$q="select * from province_th where 1";
$q.=" ORDER BY province_id  ";
$qr=mysql_query($q);
$total=mysql_num_rows($qr);
$e_page=10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
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

while($rs=mysql_fetch_array($qr)){
?>
<li><?=$rs['province_name']?></li>
<?php } ?>
</ul>


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

</div>


<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
$(function(){
	 $(".browse_page a").live("click",function(event){
		 event.preventDefault();
		 var url=$(this).attr("href");
//		 แสดงแบบปกติ
//		 $("#showData").load(url,function(){
//			 
//		 });

//		แสดงแบบ effect  สามารถประยุกต์ effect หรือลูกเล่นอื่นๆ ตามต้องการ
		 $("#showData").animate({
			 opacity:0
		 },100,function(){
			 $("#showData").load(url,function(){
				$("#showData").animate({
			 		opacity:1
				 },200);
			 });			 
		 });

		 return false;
	 });
});
</script>
</body>
</html>