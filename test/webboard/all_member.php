<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<div align="right"><a href="#">รายการสมาชิก</a>&nbsp;&nbsp;<br>
<br></div>
<div align="center">
<table width="99%" border="0" cellspacing="0" cellpadding="0"style="border: 1px solid #FFCC33;  ">

  <tr>
    <td width="3%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">ที่</div></td>
	<td width="12%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">รูป</div></td>
    <td width="12%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">ชื่อ Login </div></td>
    <td width="10%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">ยศ</div></td>
    <td width="33%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">ชื่อ - นามสกุล </div></td>
    <td width="22%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">อีเมลล์</div></td>
    <td width="4%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">กระทู้</div></td>
    <td width="4%" valign="top" style="border: 1px solid #FFCC33;  "><div align="center">ตอบ</div></td>
  </tr>
  <? 
$db_member = mysql_query("SELECT   member.img,  member.email,  member.name,  member.user,  member.post,  member.ment,  level.level_name,  level.level_id
FROM  ".TB_MEMBER." 
  INNER JOIN  ".TB_LEVEL."  ON (member.level = level.level_id)
ORDER BY level.level_id DESC"); // คิวรี่ฐานข้อมูลสมาชิกออกมา โดยเรียงจากวันที่ Update ล่าสุดไปยังวันที่ Update ท้ายสุด
$counter = 1; // ตัวแปลนับรายการสมาชิก
while($dbarr[member] = mysql_fetch_array($db_member)){ // วน Loop เพื่อเอารายชื่อของสมาชิกออกมาจากฐานข้อมูล
?>
  <tr>
    <td valign="top" style="border: 1px solid #FFCC33;  "><div align="center"><?=$counter?></div></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><div align="center"><? if ($dbarr[member][img] =="nopic.gif"){ ?> <img src="<?=IMG_MEMBER."/".$dbarr[member][img];?>" width="24" height="24" ><?}else{?><img src="<?=IMG_MEMBER."/".$dbarr[member][img];?>" width="<?=_W/2;?>" height="<?=_H/2;?>" /><?}?></div></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><?=$dbarr[member][user]?></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><div align="center"><?=$dbarr[member][level_name]?><br><? Level($dbarr[member][level_id]); ?></div></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><?=$dbarr[member][name]?><? if(CheckAdmin()){ ?><a href="javascript:Confirm('index.php?p=del&action=member&id=<?=$dbarr[member][user]?>','คุณมั่นใจในการลบหัวข้อนี้ ? ');"><img src="img/trash.gif" border="0" alt="ลบ" ></a><?}?></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><?=$dbarr[member][email]?></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><div align="center">
      <?=$dbarr[member][post]?>
    </div></td>
    <td valign="top" style="border: 1px solid #FFCC33;  "><div align="center">
      <?=$dbarr[member][ment]?>
    </div></td>
  </tr>
<? $counter++; }?>
</table>
</div>
