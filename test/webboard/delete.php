<? 
if (!(CheckAdmin())){ // �����ͺ����繼������������
	echo "<meta http-equiv=refresh content=0;URL=index.php>" ;
	exit();
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<? 
$action = $_GET[action]; // ��Ǩ�ͺ���ź���� �ҡ Url
// ź������ ź��Ǣ�� ź��Ҫԡ
if($action=="member"){ // ���ź��Ҫԡ
		$user = $_GET[id] ; // �Ѻ��� user �ҡ Url
		$db_del_img = mysql_query("SELECT img FROM ".TB_MEMBER." WHERE user='$user' "); // �֧�������ٻ��Ҫԡ�͡�ҡ�ҹ������
		$unimg = mysql_fetch_array($db_del_img); // �֧�������ٻ��Ҫԡ�͡�ҡ�ҹ������
		if ($unimg[img] !="nopic.gif" ) { unlink(IMG_MEMBER.$unimg[img]); } // �����Ҫԡ���ٻ�Ҿ���� ���ź�ٻ�Ҿ��Ҫԡ
	$db_del = mysql_query("DELETE FROM ".TB_MEMBER." WHERE user='$user' "); // ź��¡����Ҫԡ�͡�ҡ�ҹ��������Ҫԡ
	if($db_del){  // ���ź��Ҫԡ�����
		echo "<center><BR><BR>�ӡ��ź��Ҫԡ�����<BR><BR></center>";
		echo "<meta http-equiv=refresh content=3;URL=?p=member>" ;
	}
}else if($action=="topic"){ //  ���ź��Ǣ�͡�з��
$topic = $_GET[id];// �Ѻ��� ���ʡ�з�� �ҡ Url

		$db_del = mysql_query("DELETE FROM ".TB_WEBBOARD." WHERE webboard_id='$topic' "); // ź��з���õ��ҧ��纺���
		$db_del_comment = mysql_query("DELETE FROM ".TB_COMMENT." WHERE webboard_id='$topic' "); // ź�����鹷���繢ͧ��з����
		if($db_del && $db_del_comment ){  // ���ź����ͧ���ҧ����� 
		echo "<center><BR><BR>�ӡ��ź��Ǣ����纺��������<BR><BR></center>"; // ⪢�ͤ����͡��
		echo "<meta http-equiv=refresh content=3;URL=index.php>" ; // ��Ѻ��ѧ˹����ѡ
	}


}else if($action=="comment"){ // ���ź������
$comment = $_GET[id]; // �Ѻ������ʤ����鹨ҡ URL
$topic = $_GET[topic]; // �Ѻ���������Ǣ�͡�з��ҡ URL
		$db_del_comment = mysql_query("DELETE FROM ".TB_COMMENT." WHERE comment='$comment' "); // ź��¡�ä����鹨ҡ���ҧ������
		if($db_del_comment){  // ���ź�����
		echo "<center><BR><BR>�ӡ��ź�����������<BR><BR></center>"; // ⪢�ͤ����͡��
		echo "<meta http-equiv=refresh content=3;URL=index.php?p=red&id=".$topic.">" ; // ��Ѻ��ѧ��з������ҹ
	}


}
?>