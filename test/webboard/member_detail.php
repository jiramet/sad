<? 
CheckUser(); // ตรวสอบว่าได้ Login หรือไม่
$val_user =  $_SESSION[login]; // เอาชื่อคนล็อคอินใส่ตัวแปล $val_user 

if($_POST[post]=="OK"){ // ตรวสสอบ ว่าได้แก้ข้อมูลหรือไม่
$imgfile = $_FILES['FILE']; // เอาค่าไฟล์ที่ upload มาใส่ในตัวแปล
		if ( $imgfile['size'] > LIMIT_IMG && $imgfile != "" ) { // ตรวจสอบขนาดของไฟลฺรูป
	echo "<br><br><center><font size='3' face='MS Sans Serif'><b>ขนาดรูปที่แนบมามีขนาดเกิน ".(LIMIT_IMG/1024)." kB กรุณาตรวจสอบรูปภาพของท่าน</b></font><br><br><input type='button' value='กลับไปลองใหม่' onclick='history.back();'></center>" ;
	} else{
				if ($_FILES['FILE']){ // ตรวจสอบว่ามีไฟล์ที่ upload มาหรือไม่
				$db_member = mysql_query("SELECT img FROM ".TB_MEMBER." WHERE user='$val_user' "); // คิวรี่ฐานข้อมูล MEMBER เพื่อดึงข้อมูลของสมาชิกที่ login ออกมา
				$dbarr[member] = mysql_fetch_array($db_member ); // ดึงข้อมูลออกมาเป็น Array
				if ($dbarr[member][img]!="nopic.gif"){ @unlink(IMG_MEMBER.$dbarr[member][img]); } // ตรวสสอบว่ามีรูปหรือไม่ ถ้ามีให้ลบรูปเดิมทิ้ง
								if ( $imgfile['type'] == "image/gif" ) // ตรวจสอบนามสกุลรูป
										{$img = FILENAME.".gif";} // เปลี่ยนชื่อรูป
								else if (($imgfile['type']=="image/jpg")||($imgfile['type']=="image/jpeg")||($imgfile['type']=="image/pjpeg"))// ตรวจสอบนามสกุลรูป
										{$img = FILENAME.".jpg";}// เปลี่ยนชื่อรูป
								@copy ($imgfile['tmp_name'] , IMG_MEMBER.$img );// ตรวจสอบนามสกุลรูป
								if($img==''){ $img="nopic.gif";}// เปลี่ยนชื่อรูป
								$db_up_img = mysql_query("UPDATE ".TB_MEMBER." SET img='$img' WHERE user='$val_user' "); // แก้ไขรูปในฐานข้อมูล
								if(!$db_up_img){ echo "Error Up Img";} // ถ้าแก้ไขรูปในฐานข้อมูลไม่ได้
					}

				$up = $_SESSION[login]; // รับค่าจากการโพส
				$name = $_POST[name]; // รับค่าจากการโพส
				$date_member = $_POST[date_member]; // รับค่าจากการโพส
				$address = $_POST[address]; // รับค่าจากการโพส
				$email = $_POST[email]; // รับค่าจากการโพส
				$tel = $_POST[tel]; // รับค่าจากการโพส

					$ms[0] = "UPDATE ".TB_MEMBER." SET name='$name' WHERE user='$up' "; // คำสั่ง Update ฐานข้อมูล
					$ms[1] = "UPDATE ".TB_MEMBER." SET date_member='$date_member' WHERE user='$up' ";// คำสั่ง Update ฐานข้อมูล
					$ms[2] = "UPDATE ".TB_MEMBER." SET address='$address' WHERE user='$up' ";// คำสั่ง Update ฐานข้อมูล
					$ms[3] = "UPDATE ".TB_MEMBER." SET email='$email' WHERE user='$up' ";// คำสั่ง Update ฐานข้อมูล
					$ms[4] = "UPDATE ".TB_MEMBER." SET tel='$tel' WHERE user='$up' ";// คำสั่ง Update ฐานข้อมูล
					
									for ($i = 0; $i < 5; $i++){ // วน Loop เพื่อ Update ฐานข้อมูล
												$db_update = mysql_query($ms[$i]); // Update ฐานข้อมูล
												if (!$db_update) { echo "<center> การ update Error ที่".$i."</center><br>"; exit();} // ถ้ามีปัญหาผิดพลาดในฐานข้อมูล
									}
									echo "<center> การ update สำเร็จ </center><br>";
					}
} 
if ( $_POST[PASS]=="newpass" ){  // ตรวจสอบว่าได้แก้ Password หรือไม่
	$pass = $_POST[p1]; // รับค่าจากการโพส
		$db_update_pass = mysql_query("UPDATE ".TB_MEMBER." SET pass='$pass' WHERE user='$val_user' "); // Update Pass ลงฐานข้อมูล
		if($db_update_pass) { echo "<center>Update Password สำเร็จ<br>กำลังออกจากละรบ เพื่อ Login ใหม่</center><br>"; // ถ้า Update สำเร็จ
		session_unset(); // ลบค่า Sission เพื่อให้ทำการ Logon ใหม่
		session_destroy();// ลบค่า Sission เพื่อให้ทำการ Logon ใหม่
		echo "<meta http-equiv=refresh content=2;URL=?p=log>"; // ฑีเฟรสหน้าเว็บให้กลับไปยังหน้าหลัก
		}else{echo "<br><center>ไม่สามารถ Update ข้อมูลได้</center><br>";}
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<div align="center">
<table width="45%" cellspacing="1" cellpadding="0" >
  <tr>
    <td style="border:1px solid #00FF00; border-collapse:collapse; border-style:dotted;"><div align="center"><a href="?p=mi&amp;action=detail">ดูข้อมูลสมาชิก</a></div></td>
    <td style="border:1px solid #00FF00; border-collapse:collapse; border-style:dotted;"><div align="center"><a href="?p=mi&amp;action=edit">แก้ไขข้อมูลสมาชิก</a></div></td>
  </tr>
  <tr>
    <td style="border:1px solid #00FF00; border-collapse:collapse; border-style:dotted;"><div align="center"><a href="?p=mi&amp;action=pass">เปลี้ยนรหัสผ่าน</a></div></td>
    <td style="border:1px solid #00FF00; border-collapse:collapse; border-style:dotted;"><div align="center"><a href="?p=mi&amp;action=log">ออกจากระบบ</a></div></td>
  </tr>
</table><br>
<? if ($_GET[action]=="detail"){ 
$db_memner = mysql_query("SELECT   member.img,  member.email,  member.name, member.post,  member.date_member,  member.ment,  level.level_name,  level.level_id,  member.tel
FROM  ".TB_MEMBER." 
INNER JOIN ".TB_LEVEL."  ON (member.level = level.level_id)
WHERE user='$val_user' 
ORDER BY  level.level_id DESC"); // คิวรี่ข้อมูลจากตาราง Member โดยดึงเอาค่าของคนบ Login ออกมา
$dbarr[member] = mysql_fetch_array($db_memner); // ดึงค่าออกมาเป็น Array ?>
 <table width="95%"  cellpadding="0" cellspacing="0" style="border: 1px solid #0066FF; border-style:dotted">
 <tr><td><div align="center">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="17%" align="center" valign="top"><BR /><BR /><img src="<?=IMG_MEMBER.$dbarr[member][img];?>" width="<?=_W;?>" height="<?=_H;?>"></td>
       <td width="83%" valign="top"><div align="center">
         <table width="85%" >
           <tr>
             <td width="33%" >&nbsp;</td>
             <td width="67%" >&nbsp;</td>
           </tr>
           <tr>
             <td colspan="2" ><div align="right"><a href="#">ข้อมูลของท่าน</a> &nbsp;</div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">ชื่อ - นามสกุล : </div></td>
             <td ><div align="left">&nbsp;
                   <?=$dbarr[member][name];?>
             </div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">วัน เดือน ปีเกิด :</div></td>
             <td ><div align="left">&nbsp;
                   <?=$dbarr[member][date_member];?>
             </div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">ที่อยู่ : </div></td>
             <td ><div align="left">&nbsp;
                   <? if($dbarr[member][address]){ echo $dbarr[member][address] ;} else { echo "ไม่พบข้อมูล";}?>
             </div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">อีเมลล์ : </div></td>
             <td ><div align="left">&nbsp;
                   <?=$dbarr[member][email];?>
             </div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">เบอร์โทร : </div></td>
             <td ><div align="left">&nbsp;
                   <? if ($dbarr[member][tel]){ echo $dbarr[member][tel] ;} else { echo "ไม่พบข้อมูล";}?>
             </div></td>
           </tr>
           <?=DOT2;?>
           <tr>
             <td ><div align="right">กระทู้ : </div></td>
             <td ><div align="left">&nbsp;
                   <?=$dbarr[member][post];?>
               &nbsp;ตอบ : &nbsp;
               <?=$dbarr[member][ment];?>
             </div></td>
           </tr>
           <?=DOT2;?>
		      <tr>
             <td ><div align="right">กระทู้ : </div></td>
             <td ><div align="left">&nbsp;<?=$dbarr[member][level_name]?><? Level($dbarr[member][level_id]); ?>
               <br></div></td>
           </tr>
           <?=DOT2;?>
		   
		  
           <tr>
             <td >&nbsp;</td>
             <td >&nbsp;</td>
           </tr>
         </table>
       </div></td>
     </tr>
   </table>
 </div></td></tr>
 </table>
<? } else if ($_GET[action]=="edit"){ 
$db_memner = mysql_query("SELECT * FROM ".TB_MEMBER." WHERE user='$val_user' ");// คิวรี่ข้อมูลจากตาราง Member โดยดึงเอาค่าของคนบ Login ออกมา
$dbarr[member] = mysql_fetch_array($db_memner);// ดึงค่าออกมาเป็น Array?>
<table width="95%"  cellpadding="0" cellspacing="0" style="border: 1px solid #0066FF; border-style:dotted">
 <tr><td><div align="center">
   <form id="form1" name="form1" method="post" action="?p=mi" enctype="multipart/form-data"  >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="22%" align="center" valign="top"><br /><br /><img src="<?=IMG_MEMBER.$dbarr[member][img];?>" width="<?=_W;?>" height="<?=_H;?>"></td>
         <td width="78%" valign="top"><div align="center">
           <table width="90%" >
             <tr>
               <td width="31%" >&nbsp;</td>
               <td width="69%" >&nbsp;</td>
             </tr>
             <tr>
               <td colspan="2" ><div align="right"><a href="#">แก้ข้อมูลของท่าน</a> &nbsp;</div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right">ชื่อ - นามสกุล : </div></td>
               <td ><div align="left">&nbsp;
                     <input name="name" type="text" id="name" value="<?=$dbarr[member][name];?>" />
               </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right">วัน เดือน ปีเกิด :</div></td>
               <td ><div align="left">&nbsp;
                     <input name="date_member" type="text" id="date_member" value="<?=$dbarr[member][date_member];?>" size="13" readonly="readonly" />
                 &nbsp;<a href="javascript:NewCal('date_member','yyyymmdd',false,12,'arrow')" border="0"><img src="img/cal.gif" width="16" height="16" border="0"  alt="เลือกวันที่" /> </a> </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right">ที่อยู่ : </div></td>
               <td ><div align="left">&nbsp;
                     <input name="address" type="text" id="address" value="<?=$dbarr[member][address];?>" size="35" />
               </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right">อีเมลล์ : </div></td>
               <td ><div align="left">&nbsp;
                     <input name="email" type="text" id="email" value="<?=$dbarr[member][email];?>" size="25" />
               </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right">เบอร์โทร : </div></td>
               <td ><div align="left">&nbsp;<input name="tel" type="text" id="tel" value="<?=$dbarr[member][tel];?>" size="15" />
               </div></td>
             </tr>
             <?=DOT2;?>
			 <tr>
               <td ><div align="right">รูปภาพ : </div></td>
               <td ><div align="left">&nbsp;<input type="file" name="FILE" style="width:250" class="inputform" ><BR />
                   ( jpg, jpeg, gif ) limit<?= LIMIT_IMG / 1024 ; ?> kb 
               </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td ><div align="right"></div></td>
               <td ><div align="left">&nbsp;
                     <input type="submit" name="Submit" value="แก้ไขข้อมูล" />
                       <input type="reset" name="Submit2" value="เคีลย" />
               </div></td>
             </tr>
             <?=DOT2;?>
             <tr>
               <td >&nbsp;</td>
               <td >&nbsp;</td>
             </tr>
           </table>
         </div></td>
       </tr>
     </table>
     <input type="hidden" name="post" value="OK" />
     </form> </div></td></tr>
 </table>
<? }else if ($_GET[action]=="pass"){ ?>
      <form  name="pass" method="post" action="?p=mi" onSubmit="return check();">
	  <script language="JavaScript">
function check() {
if(document.pass.p1.value=="") {
alert("กรุณา กรอกรหัสผ่านใหม่ในช่องแรกด้วยครับ") ;
document.pass.p1.focus() ;
return false ;
}
else if(document.pass.p2.value=="") {
alert("กรุณากรอกรหัสผ่านในช่อง 2 ด้วยครับ") ;
document.pass.p2.focus() ;
return false ;
}else if(document.pass.p2.value!=document.pass.p1.value) {
alert("รหัสผ่านทั้งสองช่องไม่ตรงกันครับ") ;
document.pass.p2.focus() ;
return false ;
}else 
return true ;

}
</script>
<table width="50%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><div align="right">เปลี่ยน Password </div></td>
    </tr><?=DOT2;?>
  <tr>
    <td width="43%"><div align="right">New Pass 1 : </div></td>
    <td width="57%"><div align="left">&nbsp;<input name="p1" type="password" id="p1" />
    </div></td>
  </tr><?=DOT2;?>
  <tr>
    <td><div align="right">New Pass 2 : </div></td>
    <td><div align="left">&nbsp;<input name="p2" type="password" id="p2" />
    </div></td>
  </tr> <?=DOT2;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;<input type="submit" name="Submit3" value="เปลี่ยน Pass" /></td>
  </tr>
  <?=DOT2;?>
</table>
<input type="hidden" name="PASS" value="newpass"  />
     </form>
<? }else if ($_GET[action]=="log"){
echo "กำลังออกจากระบบ";
session_unset();
session_destroy();
echo "<meta http-equiv=refresh content=3;URL=index.php>";
} else { echo "เลือกรายการเมนู ระบบสมาชิก" ;  }

?>
</div>
