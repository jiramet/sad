<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<div align="right"><a href="?p=add"><img src="img/icon_add.gif" width="16" height="16" border="0"/> ��駡�з������</a>&nbsp;&nbsp;&nbsp;</div>
<br>
	<div align="center">
      <table width="95%"  cellpadding="0" cellspacing="0" style="border: 1px solid #FFCC33;  ">
        <tr>
          <td width="7%" style="border: 1px solid #FFCC33;  "><div align="center">�ӴѺ���</div></td>
          <td width="75%" style="border: 1px solid #FFCC33;  "><div align="center">��Ǣ��</div></td>
          <td width="18%" style="border: 1px solid #FFCC33;  "><div align="center">����</div></td>
        </tr>
		<?
$db_board = mysql_query("SELECT board.webboard_id,board.member,  board.post,  board.view,  board.update_date,  board.postdate,  board.detail,  board.topic,  category.name
FROM  ".TB_WEBBOARD."
INNER JOIN ".TB_CATEGORY." ON (board.category = category.category)
ORDER BY  board.update_date DESC"); // ������ҹ������ Webboard ���§����ѹ��� update ����ش
$coun = 1; // ���ӹǹ�ӴѺ��� ��������� 1
while ($dbarr[webboard]=mysql_fetch_array($db_board)){ // ǹ Loop �����ʴ���¡�á�з��㹰ҹ������ Webboard
   $webboard_id = $dbarr[webboard][webboard_id]; // ���������纺���������� $webboard_id
	$num_comment = mysql_num_rows(mysql_query("SELECT * FROM ".TB_COMMENT." WHERE webboard_id ='$webboard_id'")); // ������ҹ������ Comment �֧�����¡�÷���繢ͧ ������纺���
	if ($dbarr[webboard][member]){ // ��Ǩ�ͺ����駡�з�� ����Ҫԡ�������
	$showimg = "<img src=\"img/member.gif\"  width='14' height='14'>"; // �������Ҫԡ
	}else { $showimg = "<img src=\"img/pencil_icon.gif\"  >";} // ����������Ҫԡ
?>
        <tr>
          <td style="border: 1px solid #FFCC33;  "><div align="center"><?=$coun;?></div></td>
          <td style="border: 1px solid #FFCC33;  ">&nbsp;<img src="img/comment.gif" border="0" />&nbsp;<a href="?p=red&id=<?=$dbarr[webboard][webboard_id];?>"><?=$dbarr[webboard][topic];?></a> ( ����� : <?=$dbarr[webboard][name];?>) ( ��ҹ : <?=$dbarr[webboard][view]; ?> / �ͺ : <?=$num_comment;?>)<? CheckNew($dbarr[webboard][postdate]);?> <? CheckUpdate($dbarr[webboard][update_date]);?> <? CheckHot($dbarr[webboard][view]);?></td>
          <td style="border: 1px solid #FFCC33;  "><div align="center"><?=$showimg;?> <?=$dbarr[webboard][post];?></div></td>
        </tr>
        
	<? $coun ++ ; // �����ӹǹ��Ǣ�ͷ��� 1 
	 }	 // ������ʴ�����纺���?>
	<tr>
          <td >&nbsp;</td>
          <td colspan="2" ><img src="img/new.gif" width="29" height="7" /> = ��Ǣ������, <img src="img/update.gif" width="50" height="12" />= �Ѿ�õ����ش, <img src="img/hot.gif" width="29" height="7" /> = �ʹ����, <img src="img/member.gif" width="14" height="14" /> = ��Ҫԡ, <img src="img/pencil_icon.gif" width="10" height="10" /> = �ؤ�ŷ���� </td>
        </tr>
      </table>      
	</div>