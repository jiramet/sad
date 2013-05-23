<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ajax simple all in one file</title>
<style type="text/css">
*{
	font-family:tahoma, "Microsoft Sans Serif", Verdana;
	font-size:12px;	
}
</style>
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


<div style=" text-align:center;margin:auto;width:80%;">
<form id="form_member" name="form_member" method="post" action="">
<table width="500" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td width="100" align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">ชื่อผู้ใข้</td>
    <td align="left"><input name="member_name" type="text" id="member_name" size="45" /></td>
  </tr>
  <tr>
    <td align="right">รหัสผ่าน</td>
    <td align="left"><input name="member_password" type="text" id="member_password" size="45" /></td>
  </tr>
  <tr>
    <td align="right">ชื่อ นามสกุล</td>
    <td align="left"><input name="member_fullname" type="text" id="member_fullname" size="45" /></td>
  </tr>
  <tr>
    <td align="right">ประเภท</td>
    <td align="left"><select name="member_type" id="member_type">
      <option value="">เลือกประเภท</option>
      <option value="1">ประเภทที่ 1</option>
      <option value="2">ประเภทที่ 2</option>
    </select></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left"><input type="button" name="save" id="save" value="Save" />
      &nbsp; <input type="button" name="cancel" id="cancel" value="Cancel" />
      <input name="h_member_id" type="hidden" id="h_member_id" value="" /></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
</table>
</form>

<div id="showData" style="margin:auto;padding:10px;text-align:center;">

</div>


</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<!--<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>-->
<script type="text/javascript">
$(function(){
	$("#showData").load("ajax_data.php");
	
	$("#save").click(function(){
		$.post("ajax_data.php?method=insert",$("#form_member").serialize(),function(){
			$("#showData").load("ajax_data.php");
			$("#form_member")[0].reset();
		});
	});
	$("#cancel").click(function(){
		$("#form_member")[0].reset();
	});	

	 $(".browse_page a").live("click",function(event){
		 event.preventDefault();
		 var url=$(this).attr("href");
//		 แสดงแบบปกติ
		 $("#showData").load(url,function(){
			 
		 });

////		แสดงแบบ effect  สามารถประยุกต์ effect หรือลูกเล่นอื่นๆ ตามต้องการ
//		 $("#showData").animate({
//			 opacity:0
//		 },100,function(){
//			 $("#showData").load(url,function(){
//				$("#showData").animate({
//			 		opacity:1
//				 },200);
//			 });			 
//		 });

		 return false;
	 });

	$(".delItem").live("click",function(event){
		event.preventDefault();
		var idMember=$(this).attr("href");
		idMember=idMember.replace("#","");
		$(this).parent("td").parent("tr").fadeOut();
		$.post("ajax_data.php?method=delete",{id:idMember},function(){
			$("#showData").load("ajax_data.php");
		});
	});
	
	$(".updateItem").live("click",function(event){
		event.preventDefault();
		var idMember=$(this).attr("href");
		idMember=idMember.replace("#","");
		$.post("ajax_data.php?method=getupdate",{id:idMember},function(data){
			var returnData=data.split("|");
			$("#h_member_id").val(returnData[0]);
			$("#member_name").val(returnData[1]);
			$("#member_password").val(returnData[2]);
			$("#member_fullname").val(returnData[3]);
			$("#member_type").val(returnData[4]);

		});
	});	
	
});
</script>

<pre>
CREATE TABLE `tbl_member` (
`member_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`member_name` VARCHAR( 255 ) NOT NULL ,
`member_password` VARCHAR( 255 ) NOT NULL ,
`member_fullname` VARCHAR( 255 ) NOT NULL ,
`member_type` VARCHAR( 255 ) NOT NULL ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
</pre>

</body>
</html>