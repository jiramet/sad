<? CheckLogin(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<div align="center">
 <form name="reg" method="post" action="?p=add_member" enctype="multipart/form-data"  onSubmit="return check();">
 <script language="JavaScript">
function check() {
if(document.reg.name.value=="") {
alert("��س������ͧ͢�س���¤�Ѻ") ;
document.reg.name.focus() ;
return false ;
}
else if(document.reg.day_member.value=="") {
alert("��س����͡��� ��͹ �� �Դ�ͧ�س���¤�Ѻ") ;
document.reg.day_member.focus() ;
return false ;
}else if(document.reg.email.value=="") {
alert("��س��к� Enail �ͧ�س���¤�Ѻ") ;
document.reg.email.focus() ;
return false ;
}else if(document.reg.user.value=="") {
alert("��س��к� username �ͧ��ҹ���¤�Ѻ") ;
document.reg.user.focus() ;
return false ;
}else if(document.reg.pass.value=="") {
alert("��سҡ�͡ password �ͧ��ҹ���¤�Ѻ") ;
document.reg.pass.focus() ;
return false ;
}
else 
return true ;

}
</script>
  <table width="95%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2"><div align="right">��Ѥ���Ҫԡ</div></td>
    </tr>
	
	 <tr>
       <td width="20%">&nbsp;</td>
       <td width="80%"><div align="left"><span class="comment" >&nbsp;��������Ҫԡ</span></div></td>
    </tr>
	<?=DOT2 ;?>
    <tr>
      <td width="20%"><div align="right">���� - ����ʡ�� : </div></td>
      <td width="80%"><div align="left">&nbsp;<input name="name" type="text" id="name"  style="background-color: #CCFFFF;" size="25">
        
        </div></td>
    </tr>
	<?=DOT2 ;?>
    <tr>
      <td><div align="right">�ѹ-��͹-�� �Դ : </div></td>
      <td><div align="left">&nbsp;<input name="day_member" type="text" id="day_member" style="background-color: #CCFFFF;" size="15" readonly>
      &nbsp;<a href="javascript:NewCal('day_member','yyyymmdd',false,12,'arrow')" border="0"><img src="img/cal.gif" width="16" height="16" border="0"  alt="���͡�ѹ���"> </a></div></td>
    </tr>
	<?=DOT2 ;?>
    <tr>
      <td><div align="right">������� : </div></td>
      <td>&nbsp;<input name="address" type="text" id="address"  style="background-color: #CCFFFF;" size="35" /></td>
    </tr>
	<?=DOT2 ;?>
    <tr>
      <td><div align="right">������� : </div></td>
      <td><div align="left">&nbsp;<input name="email" type="text" id="email"  style="background-color: #CCFFFF;" size="25" />
      </div></td>
    </tr>
	<?=DOT2 ;?>
    <tr>
      <td><div align="right">������ : </div></td>
      <td><div align="left">&nbsp;<input name="tel" type="text" id="tel"  style="background-color: #CCFFFF;" size="15" />
      </div></td>
    </tr>
	<?=DOT2 ;?>
    <tr>
      <td><div align="right">�ٻ�ͧ��ҹ : </div></td>
      <td><div align="left">&nbsp;<input type="file" name="FILE" style="width:250" class="inputform" ><br>
        ( jpg, jpeg, gif ) limit  
        <?= LIMIT_IMG / 1024 ; ?> kb
      </div></td>
    </tr>
	<?=DOT2 ;?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<?=DOT2 ;?>
	<tr>
      <td>&nbsp;</td>
      <td><div align="left"><span class="comment" >&nbsp;�����š���������к�</span></div></td>
    </tr>
	<?=DOT2 ;?>
	<tr>
      <td><div align="right">Username : </div></td>
      <td>&nbsp;<input name="user" type="text" id="user"  style="background-color: #CCFFFF;" size="20" /></td>
    </tr>
	<?=DOT2 ;?>
	<tr>
      <td><div align="right">Password : </div></td>
      <td>&nbsp;<input name="pass" type="text" id="pass"  style="background-color: #CCFFFF;" size="20" /></td>
    </tr>
	<?=DOT2 ;?>
	<tr>
      <td>&nbsp;</td>
      <td>
        <div align="left">&nbsp;<input name="Submit" type="submit" id="Submit" value="��Ѥ���Ҫԡ" />&nbsp;<input type="reset" name="Submit2" value="����" />
          </div></td>
    </tr>
	<?=DOT2 ;?>
    
  </table>
  <input type="hidden" value="OK" name="post" />
 </form>
</div>
