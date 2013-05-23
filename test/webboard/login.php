<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<? CheckLogin(); ?>
<div align="center">
<div align="right">ระบบ Login&nbsp;</div>
  <form  name="login" method="post" action="" onSubmit="return check();">
  <script language="JavaScript">
function check() {
if(document.login.user.value=="") {
alert("กรุณา กรอก่ชื่อ ในการ Login ด้วยครับ") ;
document.login.user.focus() ;
return false ;
}
else if(document.login.pass.value=="") {
alert("กรุณา กรอกรหัสผ่าน ในการเข้าสู่ระบบของท่านด้วยครับ") ;
document.login.pass.focus() ;
return false ;
}else 
return true ;

}
</script>
    <table width="50%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td width="25%"><div align="right">Username : </div></td>
        <td width="75%"><div align="left">&nbsp;<input name="user" type="text" id="user" size="15" />
        </div></td>
      </tr>
      <tr>
        <td><div align="right">Password : </div></td>
        <td><div align="left">&nbsp;<input name="pass" type="password" id="pass" size="15" />
        </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="left">&nbsp;
          <input type="submit" name="Submit" value="เข้าสู่ระบบ" />
          <input type="reset" name="Submit2" value="เคลีย์" />
        </div></td>
      </tr>
    </table>
	<input type="hidden" name="post" value="OK" />
  </form>
  <?
if ($_POST[post]=="OK"){ // ถ้าโพส
$user = $_POST[user]; // รับค่าจากการโพส
$pass = $_POST[pass];// รับค่าจากการโพส


$db_member = mysql_query("SELECT user,pass FROM ".TB_MEMBER." WHERE user = '$user' AND pass = '$pass' "); // ตรวจสอบว่าถูกต้องหรือไม่
$check_member = mysql_num_rows($db_member); // ตรวจว่าตรงกับข้อมุลในฐานข้อมูลหรือไม่
		if ($check_member){ // ตรวสสอบว่าเป็นสมาชิกหรือไม่
		$_SESSION[login] = $user;
		echo "ล็อคอินเข้าสู่ระบบสำเร็จ <BR> กำลังพาคุณไปยังหน้าระบบสมาชิก";
		echo "<meta http-equiv=refresh content=3;URL=?p=mi>";
		}else {
		echo "กรุณาตรวสสอบ UserName และ Password ของท่าน";
		
		}
}
?>
</div>
