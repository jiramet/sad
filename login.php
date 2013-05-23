
<div align="center">
<?php
	if ($_POST[post] == "YES") {
		//$login = $db->fetch($db->query("SELECT * FROM " . _MEMBER . " WHERE m_id = ' " . $_POST[user] . " ' "));
		$login = $db->fetch($db->query("SELECT * FROM " . _MEMBER . " WHERE m_username = '" . $_POST[user] . "' "));
		//if(trim($_POST[user]) == USER and trim($_POST[pass]) == PASS){             //$m->m_username
		if (trim($_POST[user]) == $login->m_username and trim($_POST[pass]) == $login->m_password) {
			$_SESSION[login] = "admin";
			$_SESSION[id] = $login->m_id ;
			$_SESSION[gpid] = $login->m_gpid ;
			_go($site);
		} else {
			getJavaAlert("กรุณาตรวจสอบชื่อผู้ใช้งานและรหัสผ่าน" , 0);
			_go($site);
		}
	}
?>
  <form name="form1" method="post" action="">
    <table width="500" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td width="127">Username : </td>
        <td width="338"><input name="user" type="text" id="user"></td>
      </tr>
      <tr>
        <td>Password : </td>
        <td><input name="pass" type="password" id="pass"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="Submit" value="Login"></td>
      </tr>
    </table>
	<input type="hidden" value="YES" name="post">
  </form>
  </div>
