<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<div align="center"><table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%">&nbsp;</td>
    <td width="96%" style="border: 1px solid #0066FF; "> <div align="center"><table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
	  <? 
		$id = $_GET[id];
		$db_update = mysql_query("UPDATE ".TB_WEBBOARD." SET view=view+1 WHERE webboard_id ='$id' "); // �ӡ�������ӹǹ�����Ҫ� +1
		
		$db_readwebboard = mysql_query("SELECT   board.member,  board.post,  board.view,  board.update_date,  board.postdate,  board.detail,  board.topic,  board.webboard_id,  category.name
       FROM  ".TB_WEBBOARD."
		INNER JOIN  ".TB_CATEGORY." ON (board.category = category.category)
		WHERE webboard_id ='$id' "); // ������ҹ��������纺��� �֧�����¡�÷��ⴹ���͡�Ҩҡ˹���á
		$dbarr[read] = mysql_fetch_array($db_readwebboard); //�֧��������纺����͡���� array
		
		?>
      <tr> <td> [ <span class="topic">��Ǣ��</span>] <?=$dbarr[read][topic];?>&nbsp; [ <span class="topic">����� </span>] <?=$dbarr[read][name];?> &nbsp; [ <span class="topic">��Ҫ� </span>] <?=$dbarr[read][view];?><? if(CheckAdmin()){ ?><a href="javascript:Confirm('index.php?p=del&action=topic&id=<?=$dbarr[read][webboard_id]?>','�س����㹡��ź��Ǣ�͹�� ? ');"><img src="img/trash.gif" border="0" alt="ź" ></a><?}?></td></tr>
	<?=DOT;?>
	<tr><td>[ <span class="topic">���� </span> ]  <?=$dbarr[read][post];?> [<span class="topic"> ʶҳ� </span>]	<? if ($dbarr[read][member]){ echo "��Ҫԡ";}else{ echo "�ؤ�ŷ����";}?></td></tr>
	  <?=DOT; if ($dbarr[read][member]){ // �����Ҫԡ�繤���駡�з��
	  $user_post = $dbarr[read][post]; // ��Ҥ�Ҥ������㹵����  $user_post
	  $member_post = mysql_query("SELECT   level.level_name,  member.user,  member.img, member.ment,  member.post
	  FROM ".TB_MEMBER." 
      INNER JOIN ".TB_LEVEL." ON (member.level = level.level_id)
      WHERE user='$user_post' "); // �Դ��Ͱҹ������ TB_MEMBER ���͡ User ���ç�Ѻ���ͧ͢����
	  $dbarr[member_post] = mysql_fetch_array($member_post); //�֧�����Ţͧ��Ҫԡ�͡���� Array
	  ?>
	  <tr><td><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100" valign="top"><div align="center"><? if ($dbarr[member_post][img]=="nopic.gif") { // ��Ǩ�ͺ������ٻ�Ҿ�������?>
			<img src="<?=IMG_MEMBER?>/nopic.gif" width="48" height="48"><? } else { ?>
			<img src="<?=IMG_MEMBER."/".$dbarr[member_post][img];?>" width='<?=_W;?>' height="<?=_H;?>" /><? } ?></div></td>
            <td width="150" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>���� :
                  <?=$dbarr[member_post][user];?></td>
              </tr>
			  <?=DOT;?>
              <tr>
                <td>�дѺ :
                  <?=$dbarr[member_post][level_name];?>
                  <? Level($dbarr[member_post][level_id]); ?></td>
              </tr>
			  <?=DOT;?>
              <tr>
                <td>��з��&nbsp;:&nbsp;<?=$dbarr[member_post][post];?>&nbsp;�ͺ&nbsp;:&nbsp;<?=$dbarr[member_post][ment];?></td>
              </tr>
			  <?=DOT;?>
            </table></td>
          </tr>
        </table></td></tr>
	  <?=DOT;}?>
	  <tr>
        <td valign="top"><p><br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?=$dbarr[read][detail];?>
          <br />
    
          </td>
	  </tr>
	  <?=DOT;?>
      <tr>
        <td>
		<br>
		<div align="center">
		<? 
		$comment = mysql_query("SELECT * FROM ".TB_COMMENT." WHERE webboard_id ='$id' "); // ������ҹ������ ���ҧ Comment ���ʹ֧��¡���ʴ������Դ��鹢ͧ��¡����麺��촹��
		$sum_comment = mysql_num_rows($comment); // �Өӹǹ���㹵��ҧ������ ����ա�ä�������Ǣ����纺��촹���������
		?>
		
          <table width="95%" border="0" cellspacing="8" cellpadding="2">
		  <? if($sum_comment){   // �����ͺ��� �դ������������?> 
            <tr>
              <td style="border: 1px solid #00FF66;border-collapse:collapse; border-style:dotted;"><div align="center"> <span class="comment">��¡�ä����Դ��繷����� </span><?=$sum_comment;?> <span class="comment">��¡��</span></div></td>
            </tr>
			<? 
			$coun_ment = 1;  // ����Ţ�Ѻ�ӹǹ��Ǣ�ͤ�����
			while($dbarr[comment]=mysql_fetch_array($comment)){ // �ʴ�������
			$user_comment = $dbarr[comment][post];
			
			
			 ?>
			<!--  ǹ��Ҥ������͡�ç���-->
            <tr>
              <td style="border: 1px solid #00FF66;border-collapse:collapse; border-style:dotted;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="24%" valign="top" nowrap="nowrap" style=" border-right:: 1px solid #00FF66;"><div align="center">
				  <? if ($dbarr[comment][member] ){ // �����ͺ�������Ҫԡ�������
			$member_comment = mysql_query("SELECT   level.level_name,  member.user,  member.img, member.ment,  member.post
	  		FROM ".TB_MEMBER." 
     		 INNER JOIN ".TB_LEVEL." ON (member.level = level.level_id)
     		 WHERE user='$user_comment'"); // �Դ��Ͱҹ������ TB_MEMBER ���͡ User ���ç�Ѻ���ͧ͢����
			$dbarr[member] = mysql_fetch_array($member_comment); //�֧�����Ţͧ��Ҫԡ�͡���� Array
			 ?>
				    <? if ($dbarr[member][img]=="nopic.gif") { // ��Ǩ�ͺ������ٻ�Ҿ�������?>
			<img src="<?=IMG_MEMBER?>/nopic.gif" width="48" height="48"><? } else { ?>
			<img src="<?=IMG_MEMBER."/".$dbarr[member][img];?>" width='<?=_W;?>' height="<?=_H;?>" /><? } ?>
				    <table width="95%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>���� : <?=$dbarr[member][user];?></td>
                      </tr>
					  <?=DOT;?>
					   <tr>
                        <td>�дѺ : <?=$dbarr[member][level_name];?><? Level($dbarr[member][level_id]); ?></td>
                      </tr>			
					  <?=DOT;?>		  
                     
                      <tr>
                        <td>��з�� : <?=$dbarr[member][post];?> �ͺ : <?=$dbarr[member][ment];?></td>
                      </tr>
					  <?=DOT;?>
                    </table>
					
					<?}else{?> <?=$dbarr[comment][post];?> <br /> [ �ؤ�ŷ���� ] <?}?>
                  </div>				  </td>
                  <td width="76%" valign="top" style="border-left: 1px solid #00FF66;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td style="border-bottom: 1px solid #00FF66; border-collapse:collapse; border-style:dotted; border-left: 0px; border-right: 0px; border-top: 0px"><div align="center">��¡�ä����Դ��繷�� <?=$coun_ment;?> &nbsp;<? if(CheckAdmin()){ ?><a href="javascript:Confirm('index.php?p=del&action=comment&topic=<?=$dbarr[read][webboard_id]?>&id=<?=$dbarr[comment][comment]?>','�س����㹡��ź��Ǣ�͹�� ? ');"><img src="img/trash.gif" border="0" alt="ź" ></a><?}?></div></td>
                    </tr>
                  </table>
                    <br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$dbarr[comment][detail];?></td>
                </tr>
              </table>			  </td>
            </tr>
			<? $coun_ment++; }?>
			<!--  ��ǹ��Ҥ������͡-->
			
			<?}else{?>
			<tr>
              <td style="border: 1px solid #00FF66; border-collapse:collapse; border-style:dotted;"><div align="center"> <span class="comment">��辺��¡�ä����Դ���</span></div></td>
            </tr>
			<?}?>
          </table>
		  <br>
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><form name="comment" method="post" action="index.php?p=ment" onSubmit="return check();">
		<script language="JavaScript">
function check() {
if(document.comment.name.value=="") {
alert("��س������Ǣ�͡�з����¤�Ѻ") ;
document.comment.name.focus() ;
return false ;
}
else if(document.comment.detail.value=="") {
alert("��س����͡��Ǵ������¤�Ѻ") ;
document.comment.detail.focus() ;
return false ;
} else
return true ;

}
</script>
		
          <table width="75%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"><div align="center"><img src="img/ment.gif" width="234" height="31" /></div></td>
              </tr>
			  <tr>
              <td colspan="2">&nbsp;</td>
              </tr>
            <tr>
              <td width="25%" style="border:1px solid #FF6600; border-collapse:collapse; border-style:dotted;"><div align="right">���� : </div></td>
              <td width="75%" style="border:1px solid #FF6600; border-collapse:collapse; border-style:dotted;"><div align="left"><input name="name" type="text" id="name"  style="background-color: #CCFFFF;"  size="15" <? if(Login()){?> value="<?=$_SESSION[login];?>"  readonly <? }?>> 
              </div></td>
            </tr>
            <tr>
              <td style="border:1px solid #FF6600; border-collapse:collapse; border-style:dotted;"><div align="right">��ͤ��� : </div></td>
              <td style="border:1px solid #FF6600; border-collapse:collapse; border-style:dotted;"><div align="left"><textarea name="detail" cols="50" rows="7" id="detail" style="background-color: #CCFFFF"></textarea></div></td>
            </tr>
            <tr>
              <td colspan="2" style="border:1px solid #FF6600; border-collapse:collapse; border-style:dotted;"><div align="right">
                <input type="submit" name="Submit" value="������" />
                <input type="reset" name="Submit2" value="�����" />
				<input type="hidden" name = "member" value="<? if (isset($_SESSION[login])) { echo 1 ;}else{ echo 0 ;} ?>"  />
				<input type="hidden" name = "post" value="OK"  />
				<input type="hidden" name = "id" value="<?=$_GET[id];?>"  />
              </div></td>
              </tr>
          </table>
        </form>
        </div></td>
      </tr>
    </table>
     </div></td>
    <td width="2%">&nbsp;</td>
  </tr>
</table></div>
