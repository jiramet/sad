<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<div align="center">
<? 
if ($_POST[post]=="OK"){ // �����ͺ������ʢ�ͤ������������
$topic = $_POST[topic]; // ��������������
$category = $_POST[category];// ��������������
$detail =$_POST[detail];// ��������������
$name = $_POST[name];// ��������������
		
			if (isset($_SESSION[login])){ // ��Ǩ�ͺ����� Login �������
				$member = 1; // ������������� 1
				$connect_member = mysql_query("select post,ment,user from ".TB_MEMBER." where user = '".$_SESSION[login]."' "); // ������ҹ��������Ҫԡ �����͹� user = user ��� Login ����㹵͹���
				$dbarr[member] = mysql_fetch_array($connect_member); // �֧�����Ť������͡���� array
				$post = $dbarr[member][post]+$member; // ���������
				$levelup = $post + $dbarr[member][ment] ;  // ����Ҥ�ҵ�駡�з�� ��� ������������ѹ
				LevelUp($levelup,$_SESSION[login]);  // ��Ǩ�ͺ Level �������͹����������
				$update_post = mysql_query("UPDATE ".TB_MEMBER." SET post ='$post' WHERE user = '".$_SESSION[login]."' "); // Update Post �����Ҫԡ
				}else{ // �������� Login
				$member = 0; // ���ʶҳ���Ҫԡ�� 0 ����������Ҫԡ
				}
			$posttime = TIME; // �Ӥ�����һѨ�غѹ���㹵����
		$db_newboard =  mysql_query( "INSERT INTO `".TB_WEBBOARD."` 
		(`webboard_id` ,`category` ,`topic` ,`detail` ,`postdate`  ,`view` ,`post` ,`member`)
VALUES ( '', '$category', '$topic', '$detail', '$posttime','', '$name', '$member')"); // ����������Űҹ��������纺���
		if ($db_newboard){ echo "��駡�з�������<br>���ѧ�Ҥس��ѧ˹����ѡ��Ѻ"; // �����ͺ��� ���������� ������������
	echo "<meta http-equiv=refresh content=3;URL=index.php>" ; // ������������
		}else{echo "��駡�з����������";  // �����������
		}
} else {echo "<meta http-equiv=refresh content=0;URL=index.php>" ; // ������������ �������¡˹�ҹ���·���ѧ���������
}
?></div>