<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<div align="center">

<form name="add" method="post" action="?p=new_add" onSubmit="return check();">
<script language="JavaScript">
function check() {
if(document.add.topic.value=="") {
alert("��س������Ǣ�͡�з����¤�Ѻ") ;
document.add.topic.focus() ;
return false ;
}
else if(document.add.category.value=="") {
alert("��س����͡��Ǵ������¤�Ѻ") ;
document.add.category.focus() ;
return false ;
}else if(document.add.detail.value=="") {
alert("��سҡ�͡��ͤ������¤�Ѻ") ;
document.add.detail.focus() ;
return false ;
}else if(document.add.name.value=="") {
alert("��سҡ�͡���ʹ��¤�Ѻ") ;
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
      <td width="81%"><div align="right">������з��ŧ��纺���</div></td>
    </tr>
    <tr>
      <td><div align="right">��Ǣ�� :</div></td>
      <td><div align="left">&nbsp;<input name="topic" type="text" id="topic" style="background-color: #CCFFFF;">
        
        
        <span class="red">**</span></div></td>
    </tr>
    <tr>
      <td><div align="right">����� : </div></td>
      <td><div align="left">&nbsp;<select name="category" id="category" style="background-color:#CCFFFF;">>
		<option value="">���͡��Ǵ����</option>
		<? $db_category = mysql_query("SELECT category,name FROM ".TB_CATEGORY." "); // ������ҹ������ ������ͧ��纺���
		while ($dbarr[category]=mysql_fetch_array($db_category)){  //  �֧��¡�á�����ͧ��纺����͡���� Array ���ǹ��������ʴ���
		?>
		
		<option value="<?=$dbarr[category][category];?>"><?=$dbarr[category][name];?></option>
	<? } // �����ǹ���?>
		
		
        </select>
        <span class="red">**</span></div></td>
    </tr>
    <tr>
      <td><div align="right">������ : </div></td>
      <td align="center" valign="middle"><div align="left">&nbsp;<textarea name="detail" cols="50" rows="5" id="detail" style="background-color:#CCFFFF;"></textarea> <span class="red">**</span></div></td>
    </tr>
	<tr>
      <td><div align="right">�����ͧ͢�س :</div></td>
      <td><div align="left">&nbsp;<input name="name" type="text" id="name" style="background-color:#CCFFFF;" <? if(Login()){ // ��Ǩ�ͺ����� Login ������� ?> value="<?=$_SESSION[login];?>" readonly <? }?>>        
        <span class="red">**</span></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="left">
        <input type="Submit" name="Submit" value="�����" />
        <input type="reset" name="Submit2" value="���¤��" />
		<input type="hidden" name = "post" value="OK"  />
      </div></td>
    </tr>
  </table>
</form>
</div>
