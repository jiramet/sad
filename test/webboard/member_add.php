<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<? 
if($_POST[post] == "OK"){ // ��Ǩ�ͺ��������������
	$email = $_POST[email]; // �Ѻ��Ҩҡ�����
	$user = $_POST[user];// �Ѻ��Ҩҡ�����
	$FILE = $_FILES['FILE'];// �Ѻ��Ҩҡ�����
	$result = mysql_query("SELECT user from ".TB_MEMBER." where user='$user'") ; // �֧�ҹ���������͵����ͺ��� user ���ç�Ѻ user �㹰ҹ�������������
	$numrow = mysql_num_rows($result) ; // ��Ǩ�ͺ��ҵç������� ��ҵç �� 1 ������ç�� 0

		if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)",$email)){ // �����ͪ�ٻẺ�ͧ�������
				echo "<br><br><center><font size='3' face='MS Sans Serif'><b>��سҡ�͡���������١��ͧ���¤�Ѻ</b></font><br><br><input type='button' value='��Ѻ��ͧ����' 		onclick='history.back();'></center>" ; // ����������Դ�ٻẺ
		} else if ( $FILE['size'] > LIMIT_IMG && $FILE != "" ) { // ��Ǩ�ͺ��Ҵ�ͧ����ٻ
	echo "<br><br><center><font size='3' face='MS Sans Serif'><b>��Ҵ�ٻ���Ṻ���բ�Ҵ�Թ ".(LIMIT_IMG/1024)." kB ��سҵ�Ǩ�ͺ�ٻ�Ҿ�ͧ��ҹ</b></font><br><br><input type='button' value='��Ѻ��ͧ����' onclick='history.back();'></center>" ; // �������ٻ�����Թ
	}  else if($numrow!=0) { // �����ͺ username ��ҵç�Ѻ���ҧ user 㹰ҹ�������������
				echo "<br><br><center><font size='3' face='MS Sans Serif'>���ɴ��¤�Ѻ user $user ��� ���ռ��������Ǥ�Ѻ ��س�����¹���� Login ����<br><br><input type='button' value='��Ѻ��ͧ����' onclick='history.back();'></center>" ;  // ��� User ����������ҫ�ӡѹ㹰ҹ�����
		} else { // �����������üԴ��Ҵ
				$name = $_POST[name];// �Ѻ��Ҩҡ�����
				$day_member = $_POST[day_member];// �Ѻ��Ҩҡ�����
				$address = $_POST[address];// �Ѻ��Ҩҡ�����
				$tel = $_POST[tel];// �Ѻ��Ҩҡ�����
				$pass = $_POST[pass];// �Ѻ��Ҩҡ�����
			
				if ( $FILE['type'] == "image/gif" ) // ��Ǩ���ʡ������ٻ
						{$img = FILENAME.".gif";} // ����¹��������ٻ
				else if (($FILE['type']=="image/jpg")||($FILE['type']=="image/jpeg")||($FILE['type']=="image/pjpeg"))// ��Ǩ���ʡ������ٻ
						{$img = FILENAME.".jpg";} // ����¹��������ٻ
				@copy ($FILE['tmp_name'] , IMG_MEMBER.$img );// ��Ǩ���ʡ������ٻ 
				if ($img==""){$img="nopic.gif";} // ����¹��������ٻ
				$l = 1; $p = 0; $m = 0;  // ��������������Ѻ��õ�駡�з�� ��Ф�����

				$add_member = mysql_query("INSERT INTO `".TB_MEMBER."` (`user` ,`level` ,`pass`,`name` ,`date_member` ,`address` ,`email` ,`tel` ,`post` ,`ment` ,`img`)
VALUES ('$user', '$l', '$pass', '$name', '$day_member', '$address' , '$email', '$tel' , '$p', '$m', '$img')"); // ����������ŧ�ҹ������
				if ($add_member ) { // ��Ǩ�ͺ��� ����������ŧ�ҹ������������������
				$_SESSION[login] = $user; // ��������� ����˹� Sission ������¤������ �� Login ����
							echo "<center>�����Ѥ���Ҫԡ��������ó� <br>���ѧ�Ҥس��ѧ˹���к���Ҫԡ</center>";
							echo "<meta http-equiv=refresh content=3;URL=?p=mi>"; // ����ѧ˹���к���Ҫԡ
				}else{  echo "�������ö�ѹ�֡��������<br><input type='button' value='��Ѻ��ͧ����' onclick='history.back();'>";} // ���������üԴ��Ҵ
		}
} else {echo "<meta http-equiv=refresh content=0;URL=index.php>" ;} // ������������ �������¡������µç

?>
