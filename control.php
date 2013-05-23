<?php
	//$f = trim($_GET[f]);
	if ($_SESSION[login] == "admin") {
		$Query = $db->query("	SELECT w_url, w_urlfull FROM wurl WHERE w_url= '$f'");
		$p = $db->fetch($Query);
		if ($f == 'logout') {
			session_destroy();
			_go($site);
		}elseif  (isset($p->w_urlfull)) {
			include $p->w_urlfull;
		} else {
			include 'default.php';
		}
	} else {
		_go($site);
	}

?>