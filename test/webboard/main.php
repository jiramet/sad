<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<div align="right"><a href="?p=add"><img src="img/icon_add.gif" width="16" height="16" border="0"/> ตั้งกระทู้ใหม่</a>&nbsp;&nbsp;&nbsp;</div>
<br>
	<div align="center">
      <table width="95%"  cellpadding="0" cellspacing="0" style="border: 1px solid #FFCC33;  ">
        <tr>
          <td width="7%" style="border: 1px solid #FFCC33;  "><div align="center">ลำดับที่</div></td>
          <td width="75%" style="border: 1px solid #FFCC33;  "><div align="center">หัวข้อ</div></td>
          <td width="18%" style="border: 1px solid #FFCC33;  "><div align="center">โพสโดย</div></td>
        </tr>
		<?
$db_board = mysql_query("SELECT board.webboard_id,board.member,  board.post,  board.view,  board.update_date,  board.postdate,  board.detail,  board.topic,  category.name
FROM  ".TB_WEBBOARD."
INNER JOIN ".TB_CATEGORY." ON (board.category = category.category)
ORDER BY  board.update_date DESC"); // คิวรี่ฐานข้อมูล Webboard เรียงตามวันที่ update ล่าสุด
$coun = 1; // ให้จำนวนลำดับที่ เริ่มต้นเป็น 1
while ($dbarr[webboard]=mysql_fetch_array($db_board)){ // วน Loop เพื่อแสดงรายการกระทู้ในฐานข้อมูล Webboard
   $webboard_id = $dbarr[webboard][webboard_id]; // เอารหัสเว็บบอร์ดใส่ตัวแปล $webboard_id
	$num_comment = mysql_num_rows(mysql_query("SELECT * FROM ".TB_COMMENT." WHERE webboard_id ='$webboard_id'")); // คิวรี่ฐานข้อมูล Comment ดึงเอารายการที่เป็นของ รหัสเว็บบอร์ด
	if ($dbarr[webboard][member]){ // ตรวจสอบผู้ตั้งกระทู้ เป็นสมาชิกหรือไม่
	$showimg = "<img src=\"img/member.gif\"  width='14' height='14'>"; // ถ้าเป็นสมาชิก
	}else { $showimg = "<img src=\"img/pencil_icon.gif\"  >";} // ถ้าไม่เป็นสมาชิก
?>
        <tr>
          <td style="border: 1px solid #FFCC33;  "><div align="center"><?=$coun;?></div></td>
          <td style="border: 1px solid #FFCC33;  ">&nbsp;<img src="img/comment.gif" border="0" />&nbsp;<a href="?p=red&id=<?=$dbarr[webboard][webboard_id];?>"><?=$dbarr[webboard][topic];?></a> ( กลุ่ม : <?=$dbarr[webboard][name];?>) ( อ่าน : <?=$dbarr[webboard][view]; ?> / ตอบ : <?=$num_comment;?>)<? CheckNew($dbarr[webboard][postdate]);?> <? CheckUpdate($dbarr[webboard][update_date]);?> <? CheckHot($dbarr[webboard][view]);?></td>
          <td style="border: 1px solid #FFCC33;  "><div align="center"><?=$showimg;?> <?=$dbarr[webboard][post];?></div></td>
        </tr>
        
	<? $coun ++ ; // เพิ่มจำนวนหัวข้อทีละ 1 
	 }	 // จบการแสดงผลเว็บบอร์ด?>
	<tr>
          <td >&nbsp;</td>
          <td colspan="2" ><img src="img/new.gif" width="29" height="7" /> = หัวข้อใหม่, <img src="img/update.gif" width="50" height="12" />= อัพเดรตล่าสุด, <img src="img/hot.gif" width="29" height="7" /> = ยอดนิยม, <img src="img/member.gif" width="14" height="14" /> = สมาชิก, <img src="img/pencil_icon.gif" width="10" height="10" /> = บุคคลทั่วไป </td>
        </tr>
      </table>      
	</div>