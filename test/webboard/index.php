<? session_start() ;

include "config.php";
include "function.php";
connectdb();
?>
<html>
<head>
<script type="text/javascript" language="javascript" src="datetimepicker.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<link href="style.css" rel="stylesheet" type="text/css">
<title><?=WEB_TITLE;?></title>
<script language="JavaScript1.2">
function Confirm(link,text) 
{
  if (confirm(text))
     window.location=link
}
</script>
</head>

<body>
<div align="center">
<table width="800"cellspacing="0" cellpadding="0" >
  <tr >
    <td style="border:1px solid #99FF00;"colspan="2" valign="middle" height="100" background="img/bg.png"><div align="center" class="head"><?=WEB_INDEX;?></div></td>
    </tr>
  <tr>
    <td width="20%" valign="top" style="border:1px solid #99FF00;" background="img/left.png"><table width="100%"   >
      <tr>
        <td valign="top"><div align="center"><a href="index.php">˹����ѡ</a></div></td>
      </tr>
	  <tr>
        <td valign="top"><div align="center"><a href="index.php?p=add">��駡�з��</a></div></td>
      </tr>
	  <? if(!Login()){ // �� Function Login() ���͵�Ǩ�ͺ��� ���������к������ѧ?>
      <tr>
        <td valign="top"><div align="center"><a href="index.php?p=reg">��Ѥ���Ҫԡ</a></div></td>
      </tr>
	  <?}if(!Login()){?>
	  <tr>
        <td valign="top"><div align="center"><a href="index.php?p=log">�������к�</a></div></td>
      </tr>
	  <? }if(Login()){  // �� Function Login() ���͵�Ǩ�ͺ��� ���������к������ѧ?>
      <tr>
        <td valign="top"><div align="center"><a href="?p=mi&action=log">�͡�ҡ�к�</a></div></td>
      </tr>
	  <? }?>
      <tr>
        <td valign="top"><div align="center"><a href="?p=member">��¡����Ҫԡ</a></div></td>
      </tr>
      <tr>
        <td valign="top"><div align="center"></div></td>
      </tr>
    </table></td>
    <td width="80%" valign="top" style="border:1px solid #99FF00;">
	<br>
      
	  <?=Detail(); // Funcrion ���¡�����Ң������ധ?>
	  
	 
	  <br>
	  
	  </td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFF99" style="border:1px solid #99FF00;"><div align="center"><? echo FOOTER ; ?><br>
	

	<script type="text/javascript" language="javascript1.1" src="http://tracker.stats.in.th/tracker.php?uid=12880"></script><noscript><a target="_blank" href="http://www.stats.in.th/">www.Stats.in.th</a></noscript> <a id="mws4655640" href="http://webstats.motigo.com/"><img width="80" height="15" border="0" alt="Free counter and web stats" src="http://m1.webstats.motigo.com/n80x15.gif?id=AEcKGAZvm2uW1zq5qjZBg8AdB95g" /></a><script src="http://m1.webstats.motigo.com/c.js?id=4655640&amp;lang=EN&amp;i=3" type="text/javascript"></script> 
	
	
</div></td>
    </tr>
</table>
</div>
</body>
</html>
<? closedb(); // �Դ���������Ͱҹ������?>