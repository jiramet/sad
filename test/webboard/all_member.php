<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<div align="right"><a href="#">��¡����Ҫԡ</a>&nbsp;&nbsp;<br>
<br></div>
<div align="center">
<table width="99%" border="0" cellspacing="0" cellpadding="0"style="border: 1px solid #FFCC33;  ">

  <tr>
    <td width="3%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">���</div></td>
	<td width="12%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">�ٻ</div></td>
    <td width="12%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">���� Login </div></td>
    <td width="10%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">��</div></td>
    <td width="33%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">���� - ���ʡ�� </div></td>
    <td width="22%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">�������</div></td>
    <td width="4%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">��з��</div></td>
    <td width="4%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">�ͺ</div></td>
  </tr>
  <? 
$db_member = mysql_query("SELECT   member.img,  member.email,  member.name,  member.user,  member.post,  member.ment,  level.level_name,  level.level_id
FROM  ".TB_MEMBER." 
  INNER JOIN  ".TB_LEVEL."  ON (member.level = level.level_id)
ORDER BY level.level_id DESC"); // ������ҹ��������Ҫԡ�͡�� �����§�ҡ�ѹ��� Update ����ش��ѧ�ѹ��� Update �����ش
$counter = 1; // ����ŹѺ��¡����Ҫԡ
while($dbarr[member] = mysql_fetch_array($db_member)){ // ǹ Loop ���������ª��ͧ͢��Ҫԡ�͡�Ҩҡ�ҹ������
?>
  <tr>
    <td valign="top" style="border: 1px solid #FFCC33;  "><div align="center"><?=$counter?></div></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><div align="center"><? if ($dbarr[member][img] =="nopic.gif"){ ?> <img src="<?=IMG_MEMBER."/".$dbarr[member][img];?>" width="24" height="24" ><?}else{?><img src="<?=IMG_MEMBER."/".$dbarr[member][img];?>" width="<?=_W/2;?>" height="<?=_H/2;?>" /><?}?></div></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><?=$dbarr[member][user]?></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><div align="center"><?=$dbarr[member][level_name]?><br><? Level($dbarr[member][level_id]); ?></div></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><?=$dbarr[member][name]?><? if(CheckAdmin()){ ?><a href="javascript:Confirm('index.php?p=del&action=member&id=<?=$dbarr[member][user]?>','�س����㹡��ź��Ǣ�͹�� ? ');"><img src="img/trash.gif" border="0" alt="ź" ></a><?}?></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><?=$dbarr[member][email]?></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><div align="center">
      <?=$dbarr[member][post]?>
    </div></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><div align="center">
      <?=$dbarr[member][ment]?>
    </div></td>
  </tr>
<? $counter++; }?>
</table>
</div>
