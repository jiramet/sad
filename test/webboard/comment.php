<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?
if ($_POST[post]=="OK"){ // ����ա�ä�����
	$name = $_POST[name]; // �Ѻ��Ҩҡ��ä�����
	$detail = $_POST[detail];// �Ѻ��Ҩҡ��ä�����
	$id = $_POST[id];// �Ѻ��Ҩҡ��ä�����
	$member = $_POST[member];// �Ѻ��Ҩҡ��ä�����
	if($member){ // ��Ǩ�ͺ�������Ҫԡ�������������
				$member = 1; // ����������㹡��������ä�����
				$connect_member = mysql_query("SELECT post,ment,user FROM ".TB_MEMBER." WHERE user = '".$_SESSION[login]."' "); // �֧�����Ţͧ��Ҫԡ��������͡��
				$dbarr[member] = mysql_fetch_array($connect_member); // �֧�������͡���� Array
				$ment = $dbarr[member][ment]+$member; // ������ä����鹢ͧ��Ҫԡ� 1
				$levelup = $ment + $dbarr[member][post] ;// ��Ҥ�Ҥ�������е�駡�з��������ѹ
				LevelUp($levelup,$_SESSION[login]); // ત���������͹����������
				$update_post = mysql_query("UPDATE ".TB_MEMBER." SET ment ='$ment' WHERE user = '".$_SESSION[login]."' "); // Update ��Ңͧ��� Ment
	}
	$db_comment = "INSERT INTO ".TB_COMMENT." (comment,webboard_id,detail,post,member) VALUES ('','$id','$detail','$name','$member')";
	$add_comment = mysql_query($db_comment ); // ����������ŧ㹰ҹ������ Comment
	if ($add_comment){ // ��Ǩ�ͺ�������������ŧ���������������
	$T = time(); // ��Ҥ�����һѨ�غѹ������㹵���� $T
	$db_update = mysql_query("UPDATE  ".TB_WEBBOARD." SET update_date='$T'  WHERE webboard_id ='$id' "); // Upfate �ҹ�������������Ǣ�ͷ���� Update
	echo "<div align=\"center\">Comment ����� ���ѧ�Ҥس��ѧ˹���ʴ���</div><meta http-equiv=refresh content=3;URL=index.php?p=red&id=$id> " ;
	}else { "������������� <input type='button' value='��Ѻ����' onclick='history.back();'>"; }

} else {echo "<meta http-equiv=refresh content=0;URL=index.php>" ; // �������ա����
}


?>