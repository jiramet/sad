<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<? CheckLogin(); ?>
<div align="center">
<div align="right">�к� Login&nbsp;</div>
  <form  name="login" method="post" action="" onSubmit="return check();">
  <script language="JavaScript">
function check() {
if(document.login.user.value=="") {
alert("��س� ��͡���� 㹡�� Login ���¤�Ѻ") ;
document.login.user.focus() ;
return false ;
}
else if(document.login.pass.value=="") {
alert("��س� ��͡���ʼ�ҹ 㹡���������к��ͧ��ҹ���¤�Ѻ") ;
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
          <input type="submit" name="Submit" value="�������к�" />
          <input type="reset" name="Submit2" value="�����" />
        </div></td>
      </tr>
    </table>
	<input type="hidden" name="post" value="OK" />
  </form>
  <?
if ($_POST[post]=="OK"){ // �����
$user = $_POST[user]; // �Ѻ��Ҩҡ�����
$pass = $_POST[pass];// �Ѻ��Ҩҡ�����


$db_member = mysql_query("SELECT user,pass FROM ".TB_MEMBER." WHERE user = '$user' AND pass = '$pass' "); // ��Ǩ�ͺ��Ҷ١��ͧ�������
$check_member = mysql_num_rows($db_member); // ��Ǩ��ҵç�Ѻ������㹰ҹ�������������
		if ($check_member){ // �����ͺ�������Ҫԡ�������
		$_SESSION[login] = $user;
		echo "��ͤ�Թ�������к������ <BR> ���ѧ�Ҥس��ѧ˹���к���Ҫԡ";
		echo "<meta http-equiv=refresh content=3;URL=?p=mi>";
		}else {
		echo "��سҵ����ͺ UserName ��� Password �ͧ��ҹ";
		
		}
}
?>
</div>
