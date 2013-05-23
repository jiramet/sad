<?php
//-------------------ตัดคำหลังเท่ากับ(รวมเท่ากับมาด้วย)---------------------------------
	echo strchr("http://localhost/sad/index.php?f=member", "=");
	echo "<br />";
//-------------------ตัดตัวอักษรออก 1 ตัว---------------------------------";
	$rest = substr("abcdef", 1);
	echo $rest;
	echo "<br /><br /><br />";
	//-------------------เอาชื่อ host ออกมาแสดง---------------------------------";
	echo $_SERVER['HTTP_HOST'];
	echo "<br /><br /><br />";
		//-------------------เอาพาท มาแสดง---------------------------------";
	echo $_SERVER['REQUEST_URI'];
	echo "<br /><br /><br />";
		//-------------------เอาทั้ง url มาแสดง---------------------------------";
	echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	echo "<br /><br /><br />";
		//--------------------------------------------------------------------------";
	//$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	//$url = 'http://localhost/sad/index.php?f=member&action=add';
	$url = 'http://localhost/sad/index.php?f=member&action=open&id=3#showdata';
	echo $url;

	echo "<br /><br /><br />";
		//--------------------------------------------------------------------------";
	$pos = strrpos($url, '/') + 1;
	$str = substr($url, $pos);
	echo $str;
		//--------------------------------------------------------------------------";
	echo "<br /><br /><br />";

	$str = 'http://www.sanoook.com/home/index';
	$str = str_replace('http://www.sanoook.com/home/', '', $str);
		//--------------------------------------------------------------------------";
	echo "<br /><br /><br />";

	$str = explode("/", "$url");
	echo $str[3];
		//--------------------------------------------------------------------------";
	echo "<br /><br /><br />";
	echo "<br /><br /><br />";
	echo strchr("$url", "=");
	echo "<br />";
	echo substr(strchr("$url", "="), 1);

	/*
	 * การตัดคำ
	 * substr(strchr("http://localhost/sad/index.php?f=member","=") , 1)
	 *            strchr เป็นคำสั่งที่ตัดคำหลังจากคำที่เราค้นหา จากตัวอย่างข้างบน จะได้คำตอบคือ  =member
	 * substr เป็นคำสั่งตัดคำข้างหน้า หรือข้างหลังออก   1 = ตัดคำข้างหน้าออก -1 =ตัดคำข้างหลังออก1
	 * รวมกันก็คือ ได้  =member มา ให้ตัด เท่ากับออก
	 */
	
	echo "<br /><br /><br />";
echo parse_url($url, PHP_URL_QUERY);

	echo "<br /><br /><br />";

	echo parse_url($url, PHP_URL_HOST);

?>