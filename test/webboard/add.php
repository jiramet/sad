<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<div align="center">

<form name="add" method="post" action="?p=new_add" onSubmit="return check();">
<script language="JavaScript">
function check() {
if(document.add.topic.value=="") {
alert("กรุณาใส่หัวข้อกระทุ้ด้วยครับ") ;
document.add.topic.focus() ;
return false ;
}
else if(document.add.category.value=="") {
alert("กรุณาเลือกหมวดหมู่ด้วยครับ") ;
document.add.category.focus() ;
return false ;
}else if(document.add.detail.value=="") {
alert("กรุณากรอกข้อความด้วยครับ") ;
document.add.detail.focus() ;
return false ;
}else if(document.add.name.value=="") {
alert("กรุณากรอกชื่อด้วยครับ") ;
document.add.name.focus() ;
return false ;
}
else
return true ;

}
</script>
<table width="95%">
    <tr>
      <td width="19%"><div align="right"></div></td>
      <td width="81%"><div align="right">เพิ่มกระทู้ลงเว็บบอร์ด</div></td>
    </tr>
    <tr>
      <td><div align="right">หัวข้อ :</div></td>
      <td><div align="left">&nbsp;<input name="topic" type="text" id="topic" style="background-color: #CCFFFF;">
        
        
        <span class="red">**</span></div></td>
    </tr>
    <tr>
      <td><div align="right">กลุ่ม : </div></td>
      <td><div align="left">&nbsp;<select name="category" id="category" style="background-color:#CCFFFF;">>
		<option value="">เลือกหมวดหมู่</option>
		<? $db_category = mysql_query("SELECT category,name FROM ".TB_CATEGORY." "); // คิวรี่ฐานข้อมูล กลุ่มของเว็บบอร์ด
		while ($dbarr[category]=mysql_fetch_array($db_category)){  //  ดึงรายการกลุ่มของเว็บบอร์ดออกมาเป็น Array และวนซ้ำเพื่อแสดงผล
		?>
		
		<option value="<?=$dbarr[category][category];?>"><?=$dbarr[category][name];?></option>
	<? } // จบการวนซ้ำ?>
		
		
        </select>
        <span class="red">**</span></div></td>
    </tr>
    <tr>
      <td><div align="right">เนื้อหา : </div></td>
      <td align="center" valign="middle"><div align="left">&nbsp;<textarea name="detail" cols="50" rows="5" id="detail" style="background-color:#CCFFFF;"></textarea> <span class="red">**</span></div></td>
    </tr>
	<tr>
      <td><div align="right">ใส่ชื่อของคุณ :</div></td>
      <td><div align="left">&nbsp;<input name="name" type="text" id="name" style="background-color:#CCFFFF;" <? if(Login()){ // ตรวจสอบว่าได้ Login หรือไม่ ?> value="<?=$_SESSION[login];?>" readonly <? }?>>        
        <span class="red">**</span></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="left">
        <input type="Submit" name="Submit" value="โพสเลย" />
        <input type="reset" name="Submit2" value="เคลียค่า" />
		<input type="hidden" name = "post" value="OK"  />
      </div></td>
    </tr>
  </table>
</form>
</div>
