<? 
CheckUser(); // ����ͺ����� Login �������
$val_user =  $_SESSION[login]; // ��Ҫ��ͤ���ͤ�Թ������� $val_user 

if($_POST[post]=="OK"){ // �����ͺ �������������������
$imgfile = $_FILES['FILE']; // ��Ҥ������� upload �����㹵����
		if ( $imgfile['size'] > LIMIT_IMG && $imgfile != "" ) { // ��Ǩ�ͺ��Ҵ�ͧ����ٻ
	echo "<br><br><center><font size='3' face='MS Sans Serif'><b>��Ҵ�ٻ���Ṻ���բ�Ҵ�Թ ".(LIMIT_IMG/1024)." kB ��سҵ�Ǩ�ͺ�ٻ�Ҿ�ͧ��ҹ</b></font><br><br><input type='button' value='��Ѻ��ͧ����' onclick='history.back();'></center>" ;
	} else{
				if ($_FILES['FILE']){ // ��Ǩ�ͺ���������� upload ���������
				$db_member = mysql_query("SELECT img FROM ".TB_MEMBER." WHERE user='$val_user' "); // ������ҹ������ MEMBER ���ʹ֧�����Ţͧ��Ҫԡ��� login �͡��
				$dbarr[member] = mysql_fetch_array($db_member ); // �֧�������͡���� Array
				if ($dbarr[member][img]!="nopic.gif"){ @unlink(IMG_MEMBER.$dbarr[member][img]); } // �����ͺ������ٻ������� ��������ź�ٻ������
								if ( $imgfile['type'] == "image/gif" ) // ��Ǩ�ͺ���ʡ���ٻ
										{$img = FILENAME.".gif";} // ����¹�����ٻ
								else if (($imgfile['type']=="image/jpg")||($imgfile['type']=="image/jpeg")||($imgfile['type']=="image/pjpeg"))// ��Ǩ�ͺ���ʡ���ٻ
										{$img = FILENAME.".jpg";}// ����¹�����ٻ
								@copy ($imgfile['tmp_name'] , IMG_MEMBER.$img );// ��Ǩ�ͺ���ʡ���ٻ
								if($img==''){ $img="nopic.gif";}// ����¹�����ٻ
								$db_up_img = mysql_query("UPDATE ".TB_MEMBER." SET img='$img' WHERE user='$val_user' "); // ����ٻ㹰ҹ������
								if(!$db_up_img){ echo "Error Up Img";} // �������ٻ㹰ҹ�����������
					}

				$up = $_SESSION[login]; // �Ѻ��Ҩҡ�����
				$name = $_POST[name]; // �Ѻ��Ҩҡ�����
				$date_member = $_POST[date_member]; // �Ѻ��Ҩҡ�����
				$address = $_POST[address]; // �Ѻ��Ҩҡ�����
				$email = $_POST[email]; // �Ѻ��Ҩҡ�����
				$tel = $_POST[tel]; // �Ѻ��Ҩҡ�����

					$ms[0] = "UPDATE ".TB_MEMBER." SET name='$name' WHERE user='$up' "; // ����� Update �ҹ������
					$ms[1] = "UPDATE ".TB_MEMBER." SET date_member='$date_member' WHERE user='$up' ";// ����� Update �ҹ������
					$ms[2] = "UPDATE ".TB_MEMBER." SET address='$address' WHERE user='$up' ";// ����� Update �ҹ������
					$ms[3] = "UPDATE ".TB_MEMBER." SET email='$email' WHERE user='$up' ";// ����� Update �ҹ������
					$ms[4] = "UPDATE ".TB_MEMBER." SET tel='$tel' WHERE user='$up' ";// ����� Update �ҹ������
					
									for ($i = 0; $i < 5; $i++){ // ǹ Loop ���� Update �ҹ������
												$db_update = mysql_query($ms[$i]); // Update �ҹ������
												if (!$db_update) { echo "<center> ��� update Error ���".$i."</center><br>"; exit();} // ����ջѭ�ҼԴ��Ҵ㹰ҹ������
									}
									echo "<center> ��� update ����� </center><br>";
					}
} 
if ( $_POST[PASS]=="newpass" ){  // ��Ǩ�ͺ������� Password �������
	$pass = $_POST[p1]; // �Ѻ��Ҩҡ�����
		$db_update_pass = mysql_query("UPDATE ".TB_MEMBER." SET pass='$pass' WHERE user='$val_user' "); // Update Pass ŧ�ҹ������
		if($db_update_pass) { echo "<center>Update Password �����<br>���ѧ�͡�ҡ��ú ���� Login ����</center><br>"; // ��� Update �����
		session_unset(); // ź��� Sission �������ӡ�� Logon ����
		session_destroy();// ź��� Sission �������ӡ�� Logon ����
		echo "<meta http-equiv=refresh content=2;URL=?p=log>"; // �����˹���������Ѻ��ѧ˹����ѡ
		}else{echo "<br><center>�������ö Update ��������</center><br>";}
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<div align="center">
<table width="45%" cellspacing="1" cellpadding="0" >
  <tr>
    <td style="border:1px solid #00FF00; border-collapse:collapse; border-style:dotted;"><div align="center"><a href="?p=mi&amp;action=detail">�٢�������Ҫԡ</a></div></td>
    <td style="border:1px solid #00FF00; border-collapse:collapse; border-style:dotted;"><div align="center"><a href="?p=mi&amp;action=edit">��䢢�������Ҫԡ</a></div></td>
  </tr>
  <tr>
    <td style="border:1px solid #00FF00; border-collapse:collapse; border-style:dotted;"><div align="center"><a href="?p=mi&amp;action=pass">����¹���ʼ�ҹ</a></div></td>
    <td style="border:1px solid #00FF00; border-collapse:collapse; border-style:dotted;"><div align="center"><a href="?p=mi&amp;action=log">�͡�ҡ�к�</a></div></td>
  </tr>
</table><br>
<? if ($_GET[action]=="detail"){ 
$db_memner = mysql_query("SELECT   member.img,  member.email,  member.name, member.post,  member.date_member,  member.ment,  level.level_name,  level.level_id,  member.tel
FROM  ".TB_MEMBER." 
INNER JOIN ".TB_LEVEL."  ON (member.level = level.level_id)
WHERE user='$val_user' 
ORDER BY  level.level_id DESC"); // ����������Ũҡ���ҧ Member �´֧��Ҥ�Ңͧ��� Login �͡��
$dbarr[member] = mysql_fetch_array($db_memner); // �֧����͡���� Array ?>
 <table width="95%"  cellpadding="0" cellspacing="0" style="border: 1px solid #0066FF; border-style:dotted">
 <tr><td><div align="center">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="17%" align="center" valign="top"><BR /><BR /><img src="<?=IMG_MEMBER.$dbarr[member][img];?>" width="<?=_W;?>" height="<?=_H;?>"></td>
       <td width="83%" valign="top"><div align="center">
         <table width="85%" >
           <tr>
             <td width="33%" >&nbsp;</td>
             <td width="67%" >&nbsp;</td>
           </tr>
           <tr>
             <td colspan="2" ><div align="right"><a href="#">�����Ţͧ��ҹ</a> &nbsp;</div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">���� - ���ʡ�� : </div></td>
             <td ><div align="left">&nbsp;
                   <?=$dbarr[member][name];?>
             </div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">�ѹ ��͹ ���Դ :</div></td>
             <td ><div align="left">&nbsp;
                   <?=$dbarr[member][date_member];?>
             </div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">������� : </div></td>
             <td ><div align="left">&nbsp;
                   <? if($dbarr[member][address]){ echo $dbarr[member][address] ;} else { echo "��辺������";}?>
             </div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">������� : </div></td>
             <td ><div align="left">&nbsp;
                   <?=$dbarr[member][email];?>
             </div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">������ : </div></td>
             <td ><div align="left">&nbsp;
                   <? if ($dbarr[member][tel]){ echo $dbarr[member][tel] ;} else { echo "��辺������";}?>
             </div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">��з�� : </div></td>
             <td ><div align="left">&nbsp;
                   <?=$dbarr[member][post];?>
               &nbsp;�ͺ : &nbsp;
               <?=$dbarr[member][ment];?>
             </div></td>
           </tr>
           <?=DOT2;?>
		      <tr>
             <td ><div align="right">��з�� : </div></td>
             <td ><div align="left">&nbsp;<?=$dbarr[member][level_name]?><? Level($dbarr[member][level_id]); ?>
               <br></div></td>
           </tr>
           <?=DOT2;?>
		   
		  
           <tr>
             <td >&nbsp;</td>
             <td >&nbsp;</td>
           </tr>
         </table>
       </div></td>
     </tr>
   </table>
 </div></td></tr>
 </table>
<? } else if ($_GET[action]=="edit"){ 
$db_memner = mysql_query("SELECT * FROM ".TB_MEMBER." WHERE user='$val_user' ");// ����������Ũҡ���ҧ Member �´֧��Ҥ�Ңͧ��� Login �͡��
$dbarr[member] = mysql_fetch_array($db_memner);// �֧����͡���� Array?>
<table width="95%"  cellpadding="0" cellspacing="0" style="border: 1px solid #0066FF; border-style:dotted">
 <tr><td><div align="center">
   <form id="form1" name="form1" method="post" action="?p=mi" enctype="multipart/form-data"  >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="22%" align="center" valign="top"><br /><br /><img src="<?=IMG_MEMBER.$dbarr[member][img];?>" width="<?=_W;?>" height="<?=_H;?>"></td>
         <td width="78%" valign="top"><div align="center">
           <table width="90%" >
             <tr>
               <td width="31%" >&nbsp;</td>
               <td width="69%" >&nbsp;</td>
             </tr>
             <tr>
               <td colspan="2" ><div align="right"><a href="#">������Ţͧ��ҹ</a> &nbsp;</div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right">���� - ���ʡ�� : </div></td>
               <td ><div align="left">&nbsp;
                     <input name="name" type="text" id="name" value="<?=$dbarr[member][name];?>" />
               </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right">�ѹ ��͹ ���Դ :</div></td>
               <td ><div align="left">&nbsp;
                     <input name="date_member" type="text" id="date_member" value="<?=$dbarr[member][date_member];?>" size="13" readonly="readonly" />
                 &nbsp;<a href="javascript:NewCal('date_member','yyyymmdd',false,12,'arrow')" border="0"><img src="img/cal.gif" width="16" height="16" border="0"  alt="���͡�ѹ���" /> </a> </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right">������� : </div></td>
               <td ><div align="left">&nbsp;
                     <input name="address" type="text" id="address" value="<?=$dbarr[member][address];?>" size="35" />
               </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right">������� : </div></td>
               <td ><div align="left">&nbsp;
                     <input name="email" type="text" id="email" value="<?=$dbarr[member][email];?>" size="25" />
               </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right">������ : </div></td>
               <td ><div align="left">&nbsp;<input name="tel" type="text" id="tel" value="<?=$dbarr[member][tel];?>" size="15" />
               </div></td>
             </tr>
             <?=DOT2;?>
			 <tr>
               <td ><div align="right">�ٻ�Ҿ : </div></td>
               <td ><div align="left">&nbsp;<input type="file" name="FILE" style="width:250" class="inputform" ><BR />
                   ( jpg, jpeg, gif ) limit<?= LIMIT_IMG / 1024 ; ?> kb 
               </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right"></div></td>
               <td ><div align="left">&nbsp;
                     <input type="submit" name="Submit" value="��䢢�����" />
                       <input type="reset" name="Submit2" value="����" />
               </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td >&nbsp;</td>
               <td >&nbsp;</td>
             </tr>
           </table>
         </div></td>
       </tr>
     </table>
     <input type="hidden" name="post" value="OK" />
     </form> </div></td></tr>
 </table>
<? }else if ($_GET[action]=="pass"){ ?>
      <form  name="pass" method="post" action="?p=mi" onSubmit="return check();">
	  <script language="JavaScript">
function check() {
if(document.pass.p1.value=="") {
alert("��س� ��͡���ʼ�ҹ����㹪�ͧ�á���¤�Ѻ") ;
document.pass.p1.focus() ;
return false ;
}
else if(document.pass.p2.value=="") {
alert("��سҡ�͡���ʼ�ҹ㹪�ͧ 2 ���¤�Ѻ") ;
document.pass.p2.focus() ;
return false ;
}else if(document.pass.p2.value!=document.pass.p1.value) {
alert("���ʼ�ҹ����ͧ��ͧ���ç�ѹ��Ѻ") ;
document.pass.p2.focus() ;
return false ;
}else 
return true ;

}
</script>
<table width="50%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><div align="right">����¹ Password </div></td>
    </tr><?=DOT2;?>
  <tr>
    <td width="43%"><div align="right">New Pass 1 : </div></td>
    <td width="57%"><div align="left">&nbsp;<input name="p1" type="password" id="p1" />
    </div></td>
  </tr><?=DOT2;?>
  <tr>
    <td><div align="right">New Pass 2 : </div></td>
    <td><div align="left">&nbsp;<input name="p2" type="password" id="p2" />
    </div></td>
  </tr> <?=DOT2;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;<input type="submit" name="Submit3" value="����¹ Pass" /></td>
  </tr>
  <?=DOT2;?>
</table>
<input type="hidden" name="PASS" value="newpass"  />
     </form>
<? }else if ($_GET[action]=="log"){
echo "���ѧ�͡�ҡ�к�";
session_unset();
session_destroy();
echo "<meta http-equiv=refresh content=3;URL=index.php>";
} else { echo "���͡��¡������ �к���Ҫԡ" ;  }

?>
</div>
