<?php
	require_once "path.php";
	//echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	//echo '</br></br>';
	//echo substr(strchr('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], "="), 1);
	//$wurl2 = $db->fetch($db->query("SELECT * FROM "._WURL." WHERE w_url =  '".$_GET['f']."'  "));
	//echo $_GET['f'].'</br>';
	//echo $_GET['action'].'</br>';
	//echo $_GET['id'] . '</br>';
	//echo 'ID_User := '.$_SESSION["id"].'</br>';
	$wurl2 = $db->fetch($db->query("SELECT * FROM " . _WURL . " WHERE w_url =  '" . $_GET['f'] . "'  "));
	//echo 'ID Menu : '.$wurl2->w_id.'     ชื่อMenu : '.$wurl2->w_url.'</br>';
	$wurl3 = $db->fetch($db->query("SELECT * FROM " . _MPER . " WHERE mp_mid =  '" . $_SESSION["gpid"] . "' and mp_wid='" . $wurl2->w_id . "'  "));
	//echo 'เปิดดูหน้าweb  : '.$wurl3->mp_wper.'</br>';
	//echo 'เปิดดูข้อมูลภายใน  : '.$wurl3->mp_oper.'</br>';
	//echo 'เพิ่มข้อมูล  : '.$wurl3->mp_aper.'</br>';
	//echo 'แก้ไขข้อมูล  : '.$wurl3->mp_eper.'</br>';
	//echo 'ลบข้อมูล  : '.$wurl3->mp_dper.'</br>';
	//echo 'ค้นหา  : '.$wurl3->mp_sper.'</br>';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>ระบบอนงค์การค้า</title>
        <link rel="stylesheet" type="text/css" href="styles.css">

    </head>

    <body>



        <div align="center">
            <table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="2" valign="top"><div class="dot-footer" align="center"><img src="./images/header.png" width="960" height="200"></div></td>
                </tr>
                <tr>
                    <td width="179" valign="top">

                        <style>
                            ul
                        </style>
                        <div class="menu">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <?php
	if ($_SESSION[login] == "admin") {
		$qmenu = $db->query("	SELECT * FROM " . _MPER . "	WHERE mp_mid = " . $_SESSION["gpid"] . " and mp_wper = 1 ");
		$sum = $db->rows($qmenu);
		if ($sum) {
			while ($url = $db->fetch($qmenu)) {
				//$qumenu=$db->query("SELECT * FROM"._WURL."WHERE w_id =".$url->mp_wid);
				//$purl=$db->fetch($qumenu);
				//$purl=$db->fetch($db->query("SELECT * FROM"._WURL."WHERE w_id = ".$url->mp_wid));
				$purl = $db->fetch($db->query("SELECT * FROM " . _WURL . " WHERE w_id =  ' " . $url->mp_wid . " ' and w_status = 1  "));
				if (!$purl == '') {
?>
                                                <li><a href="index.php?f=<?php echo $purl->w_url; ?>"><?php echo $purl->w_nmenu; ?></a></li>

                                                <?php
				}
			}
		}
	}
	if ($_SESSION[id]) {
?>
                                <li><a href="index.php?f=logout">ออกจากระบบ</a></li>
<?php
	} else {
?>
								<li><a href="index.php?f=login">Login</a></li>
<?php
	}
?>
                            </ul>
                        </div>	  </td>
                    <td width="785" valign="top" style="border-left:1px solid #F0F0F0;height:auto; border-collapse:collapse;">
                        <div style="margin:10px;">

<?php
	$f = trim($_GET[f]);
	if ($_SESSION[login] == "admin") {
		include "control.php";
	} elseif ($f == 'login') {
		include "login.php";
	} else {
	echo '<center><h1>รายงานระบบ งานแจ้งซอม  และ แจ้งซื้อ ให้ User ทุกคนรับรู้ </h1></center>';
	}
?>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color:#F0F0F0;"><div class="dot-header" align="center">© Copyright 2010 ระบบงาน iT G-TEKT.  All Right Reserved | Mr.Thirachai (Mod  iT) </div>
                        <div class="dot-footer"></div>

                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>