<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<div align="center"><table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%">&nbsp;</td>
    <td width="96%" style="border: 1px solid #0066FF; "> <div align="center"><table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
	  <? 
		$id = $_GET[id];
		$db_update = mysql_query("UPDATE ".TB_WEBBOARD." SET view=view+1 WHERE webboard_id ='$id' "); // ทำการเพิ่มจำนวนการเข้าชม +1
		
		$db_readwebboard = mysql_query("SELECT   board.member,  board.post,  board.view,  board.update_date,  board.postdate,  board.detail,  board.topic,  board.webboard_id,  category.name
       FROM  ".TB_WEBBOARD."
		INNER JOIN  ".TB_CATEGORY." ON (board.category = category.category)
		WHERE webboard_id ='$id' "); // คิวรี่ฐานข้อมูลเว็บบอร์ด ดึงเอารายการที่โดนเลือกมาจากหน้าแรก
		$dbarr[read] = mysql_fetch_array($db_readwebboard); //ดึงข้อมูลเว็บบอร์ดออกมาเป็น array
		
		?>
      <tr> <td> [ <span class="topic">หัวข้อ</span>] <?=$dbarr[read][topic];?>&nbsp; [ <span class="topic">กลุ่ม </span>] <?=$dbarr[read][name];?> &nbsp; [ <span class="topic">เข้าชม </span>] <?=$dbarr[read][view];?><? if(CheckAdmin()){ ?><a href="javascript:Confirm('index.php?p=del&action=topic&id=<?=$dbarr[read][webboard_id]?>','คุณมั่นใจในการลบหัวข้อนี้ ? ');"><img src="img/trash.gif" border="0" alt="ลบ" ></a><?}?></td></tr>
	<?=DOT;?>
	<tr><td>[ <span class="topic">โพสโดย </span> ]  <?=$dbarr[read][post];?> [<span class="topic"> สถาณะ </span>]	<? if ($dbarr[read][member]){ echo "สมาชิก";}else{ echo "บุคคลทั่วไป";}?></td></tr>
	  <?=DOT; if ($dbarr[read][member]){ // ถ้าสมาชิกเป็นคนตั้งกระทู้
	  $user_post = $dbarr[read][post]; // เอาค่าคนโพสใส่ในตัวแปล  $user_post
	  $member_post = mysql_query("SELECT   level.level_name,  member.user,  member.img, member.ment,  member.post
	  FROM ".TB_MEMBER." 
      INNER JOIN ".TB_LEVEL." ON (member.level = level.level_id)
      WHERE user='$user_post' "); // ติดต่อฐานข้อมูล TB_MEMBER เลือก User ให้ตรงกับชื่อของคนโพส
	  $dbarr[member_post] = mysql_fetch_array($member_post); //ดึงข้อมูลของสมาชิกออกมาเป้น Array
	  ?>
	  <tr><td><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100" valign="top"><div align="center"><? if ($dbarr[member_post][img]=="nopic.gif") { // ตรวจสอบว่ามีรูปภาพหรือไม่?>
			<img src="<?=IMG_MEMBER?>/nopic.gif" width="48" height="48"><? } else { ?>
			<img src="<?=IMG_MEMBER."/".$dbarr[member_post][img];?>" width='<?=_W;?>' height="<?=_H;?>" /><? } ?></div></td>
            <td width="150" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>ชื่อ :
                  <?=$dbarr[member_post][user];?></td>
              </tr>
			  <?=DOT;?>
              <tr>
                <td>ระดับ :
                  <?=$dbarr[member_post][level_name];?>
                  <? Level($dbarr[member_post][level_id]); ?></td>
              </tr>
			  <?=DOT;?>
              <tr>
                <td>กระทู้&nbsp;:&nbsp;<?=$dbarr[member_post][post];?>&nbsp;ตอบ&nbsp;:&nbsp;<?=$dbarr[member_post][ment];?></td>
              </tr>
			  <?=DOT;?>
            </table></td>
          </tr>
        </table></td></tr>
	  <?=DOT;}?>
	  <tr>
        <td valign="top"><p><br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?=$dbarr[read][detail];?>
          <br />
    
          </td>
	  </tr>
	  <?=DOT;?>
      <tr>
        <td>
		<br>
		<div align="center">
		<? 
		$comment = mysql_query("SELECT * FROM ".TB_COMMENT." WHERE webboard_id ='$id' "); // คิวรี่ฐานข้อมูล ตาราง Comment เพื่อดึงรายการแสดงความคิดเห้นของรายการเว้บบอร์ดนี้
		$sum_comment = mysql_num_rows($comment); // นำจำนวนฟิวในตารางคอมเม้น ว่ามีการคอมเม้นหัวข้อเว็บบอร์ดนี้กี่คอมเม้น
		?>
		
          <table width="95%" border="0" cellspacing="8" cellpadding="2">
		  <? if($sum_comment){   // ตรวสสอบว่า มีคอมเม้นหรือไม่?> 
            <tr>
              <td style="border: 1px solid #00FF66;border-collapse:collapse; border-style:dotted;"><div align="center"> <span class="comment">รายการความคิดเห็นทั้งหมด </span><?=$sum_comment;?> <span class="comment">รายการ</span></div></td>
            </tr>
			<? 
			$coun_ment = 1;  // ตัวเลขนับจำนวนหัวข้อคอมเม้น
			while($dbarr[comment]=mysql_fetch_array($comment)){ // แสดงคอมเม้น
			$user_comment = $dbarr[comment][post];
			
			
			 ?>
			<!--  วนเอาคอมเม้นออกตรงนี้-->
            <tr>
              <td style="border: 1px solid #00FF66;border-collapse:collapse; border-style:dotted;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="24%" valign="top" nowrap="nowrap" style=" border-right:: 1px solid #00FF66;"><div align="center">
				  <? if ($dbarr[comment][member] ){ // ตรวสสอบว่าเป็นสมาชิกหรือไม่
			$member_comment = mysql_query("SELECT   level.level_name,  member.user,  member.img, member.ment,  member.post
	  		FROM ".TB_MEMBER." 
     		 INNER JOIN ".TB_LEVEL." ON (member.level = level.level_id)
     		 WHERE user='$user_comment'"); // ติดต่อฐานข้อมูล TB_MEMBER เลือก User ให้ตรงกับชื่อของคนโพส
			$dbarr[member] = mysql_fetch_array($member_comment); //ดึงข้อมูลของสมาชิกออกมาเป้น Array
			 ?>
				    <? if ($dbarr[member][img]=="nopic.gif") { // ตรวจสอบว่ามีรูปภาพหรือไม่?>
			<img src="<?=IMG_MEMBER?>/nopic.gif" width="48" height="48"><? } else { ?>
			<img src="<?=IMG_MEMBER."/".$dbarr[member][img];?>" width='<?=_W;?>' height="<?=_H;?>" /><? } ?>
				    <table width="95%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>ชื่อ : <?=$dbarr[member][user];?></td>
                      </tr>
					  <?=DOT;?>
					   <tr>
                        <td>ระดับ : <?=$dbarr[member][level_name];?><? Level($dbarr[member][level_id]); ?></td>
                      </tr>			
					  <?=DOT;?>		  
                     
                      <tr>
                        <td>กระทู้ : <?=$dbarr[member][post];?> ตอบ : <?=$dbarr[member][ment];?></td>
                      </tr>
					  <?=DOT;?>
                    </table>
					
					<?}else{?> <?=$dbarr[comment][post];?> <br /> [ บุคคลทั่วไป ] <?}?>
                  </div>				  </td>
                  <td width="76%" valign="top" style="border-left: 1px solid #00FF66;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td style="border-bottom: 1px solid #00FF66; border-collapse:collapse; border-style:dotted; border-left: 0px; border-right: 0px; border-top: 0px"><div align="center">รายการความคิดเห็นที่ <?=$coun_ment;?> &nbsp;<? if(CheckAdmin()){ ?><a href="javascript:Confirm('index.php?p=del&action=comment&topic=<?=$dbarr[read][webboard_id]?>&id=<?=$dbarr[comment][comment]?>','คุณมั่นใจในการลบหัวข้อนี้ ? ');"><img src="img/trash.gif" border="0" alt="ลบ" ></a><?}?></div></td>
                    </tr>
                  </table>
                    <br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$dbarr[comment][detail];?></td>
                </tr>
              </table>			  </td>
            </tr>
			<? $coun_ment++; }?>
			<!--  จบวนเอาคอมเม้นออก-->
			
			<?}else{?>
			<tr>
              <td style="border: 1px solid #00FF66; border-collapse:collapse; border-style:dotted;"><div align="center"> <span class="comment">ไม่พบรายการความคิดเห็น</span></div></td>
            </tr>
			<?}?>
          </table>
		  <br>
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><form name="comment" method="post" action="index.php?p=ment" onSubmit="return check();">
		<script language="JavaScript">
function check() {
if(document.comment.name.value=="") {
alert("กรุณาใส่หัวข้อกระทุ้ด้วยครับ") ;
document.comment.name.focus() ;
return false ;
}
else if(document.comment.detail.value=="") {
alert("กรุณาเลือกหมวดหมู่ด้วยครับ") ;
document.comment.detail.focus() ;
return false ;
} else
return true ;

}
</script>
		
          <table width="75%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"><div align="center"><img src="img/ment.gif" width="234" height="31" /></div></td>
              </tr>
			  <tr>
              <td colspan="2">&nbsp;</td>
              </tr>
            <tr>
              <td width="25%" style="border:1px solid #FF6600; border-collapse:collapse; border-style:dotted;"><div align="right">ชื่อ : </div></td>
              <td width="75%" style="border:1px solid #FF6600; border-collapse:collapse; border-style:dotted;"><div align="left"><input name="name" type="text" id="name"  style="background-color: #CCFFFF;"  size="15" <? if(Login()){?> value="<?=$_SESSION[login];?>"  readonly <? }?>> 
              </div></td>
            </tr>
            <tr>
              <td style="border:1px solid #FF6600; border-collapse:collapse; border-style:dotted;"><div align="right">ข้อความ : </div></td>
              <td style="border:1px solid #FF6600; border-collapse:collapse; border-style:dotted;"><div align="left"><textarea name="detail" cols="50" rows="7" id="detail" style="background-color: #CCFFFF"></textarea></div></td>
            </tr>
            <tr>
              <td colspan="2" style="border:1px solid #FF6600; border-collapse:collapse; border-style:dotted;"><div align="right">
                <input type="submit" name="Submit" value="คอมเม้น" />
                <input type="reset" name="Submit2" value="เคลีย์" />
				<input type="hidden" name = "member" value="<? if (isset($_SESSION[login])) { echo 1 ;}else{ echo 0 ;} ?>"  />
				<input type="hidden" name = "post" value="OK"  />
				<input type="hidden" name = "id" value="<?=$_GET[id];?>"  />
              </div></td>
              </tr>
          </table>
        </form>
        </div></td>
      </tr>
    </table>
     </div></td>
    <td width="2%">&nbsp;</td>
  </tr>
</table></div>
