<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?

if (eregi("config.php",$PHP_SELF)) {
    echo "<meta http-equiv='refresh' content='0; url=index.php'>" ;
    exit();
}
	
// ��ǹ�ͧ���͵��ҧ DB
define("TB_LEVEL","level"); // ���ҧ�дѺ��Ҫԡ
define("TB_MEMBER","member"); // ���ҧ��Ҫԡ
define("TB_WEBBOARD","board"); // ���ҧ��纺���
define("TB_COMMENT","comment"); // ���ҧ������
define("TB_CATEGORY","category");// ���ҧ������ͧ��纺���



// ��駤�ҡ���ʴ���˹����纺���
define("WEB_TITLE","My Webboard"); // �ʴ������
define("FOOTER","�Ѵ���� : �������� �ʧ�����ѡ���, ��¸��Ѳ�� �ت�آ<br>�Ѵ�Ӣ�������֡�ҡ�����ҧ�ҹ�����Ŵ��� MySQL "); // �ʴ������
define("WEB_INDEX","My Webboard"); // �ʴ�˹����ѡ
define("WEB_URL","http://localhost/webboard/"); // �������ͧ���䫵� ��ͧ�� / ���¹Ф�Ѻ
define("TIME",date("Y-m-d")) ; // ���һѨ�غѹ ��ҧ�ԧ�ҡ server
define("DOT","<TR><TD height=1 class=\"dot\"></TD></TR>") ; //�ʴ���ǹ�ͧ�ش���÷Ѵ
define("DOT2","<TR><TD colspan=\"2\" height=1 class=\"dot\"></TD></TR>") ; //�ʴ���ǹ�ͧ�ش���÷Ѵ 2 ���ҧ
define("_W","55") ; // �������ҧ�ٻ�ͧ����
define("_H","75") ; // �����٧�ͧ�ٻ����


// ��Ҫԡ
define("IMG_MEMBER","img_m/"); // ��������ٻ�ͧ��Ҫԡ ��ͧ�� / ���¹Ф�Ѻ
define("LIMIT_IMG","102400"); // ��Ҵ�ٻ�٧�ش�����Ҫԡ����ö�����
define("FILENAME",time()) ; // ���һѨ�غѹ ��ҧ�ԧ�ҡ server
$namefileupload = array('jpg', 'jpeg','gif','png'); // ���������ö upload ��
$filename_img = "jpg, jpeg, gif, png"; // ���������ö upload ��


// ��駤�Ҽ������к�
define("ADMIN_EMAIL","admin@xvlnw.com"); // �������ͧ�������к�
?>
