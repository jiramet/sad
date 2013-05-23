<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pagenav</title>
<style type="text/css">
	.pageclass {
		color: #000000;
		font-size: 12px;
		font-family: tahoma;
	}
	.currentclass{
		color: #D0D0D0;
	}
	.linkclass {
		color: #ff6d00;
		text-decoration: none;
	}
</style>
</head>
<body>
<?php

require_once("class.pagenav.php");

$param = array("word" => "test");

$page = new PageNav(51 , $_GET["page"] , 5 , 7 , "index.php", $param);
$page->globalclass = "pageclass";
$page->currentclass = "currentclass";
$page->linkclass = "linkclass";

//$tpl = "PageNav : {prevgroup:<b>&lt;&lt;</b>} {prev:<b>&lt;Prev</b>} | {loop:begin}{page}{seperate: . }{loop:end} | {next:<b>Next&gt;</b>} {nextgroup:<b>&gt;&gt;</b>} <br /> {first:First Page} | {last:Last Page} | Total : <b>{total}</b> pages";

$tpl = "{prev:ก่อนหน้า} {loop:begin}{page}{seperate: - }{loop:end} {next:ถัดไป}";

echo $page->getPageNav($tpl,"currentcenter");

?>
</body>
</html>