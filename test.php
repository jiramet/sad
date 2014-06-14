<h1>ระบบนำFile CSV เข้า Databases</h1>
<?php
	echo fpermiss($_GET['f']); // ตรวจสอบสิทธิในการเข้าถึง
	$dbcp = _HARDWARE;
	$uploads_dir = 'csv/'; // Folder ที่จะเก็บ File
	$filename = $_FILES['cvsfile']['name']; //เอาชื่อ File  ออกมา1
	$extension = strrchr($filename, '.'); //เอานามสกุล  ออกมา

	//start------------------กำหนดตัวแปลจาก Databases-----------------------
	$getsumfield = getsumfieldmysql($dbcp); //นับจำนวน Field ของ $dbcp ว่ามีทั้งหมด กี่ Field
	//echo $getsumfield;
	$value = getfieldmysql($dbcp); // get ชื่อ Field มา เพื่อนำไปตั้ง ชื่อ Textfield (ช่องสำหรับกรอกข้อมูลสำหรับส่งค่า)
	//echo $value[9];

	//end----------จำกำหนดตัวแปลจาก Databasess-----------------------

	/*echo $filename;
	 echo "<br /> " . $_FILES['cvsfile']['name']; //แสดงชื่อ File
	 echo "<br /> " . $_FILES['cvsfile']['size']; // แสดงขนาด File เป็น bytes
	 echo "<br /> " . $_FILES['cvsfile']['type']; //ประเภทของไฟล์ที่อัพโหลด (uploaded file)
	 echo "<br /> " . $_FILES['cvsfile']['tmp_name']; //คือ ชื่อไฟล์ชั่วคราวที่คัดลอกไว้ในเซิร์ฟเวอร์
	 echo "<br /> " . $_FILES['cvsfile']['error']; //คือ ข้อผิดพลาดของการอัพโหลดไฟล์ (file upload)
	 echo "<br />";
	 */
	if (empty($filename)) {
		
?>
<table width="95%" border="1" cellspacing="5" cellpadding="5">
    <tr>
        <td><div align="center">
				<label for="1">กรุณาเลือก File ที่จะนำเข้า Databases (File Csv)</label>
            </div></td>
    </tr>
    <tr>
    	<td><div align="center">
    				        <form action="index.php?f=<?php echo $_GET[f]; ?>&action=saveadd" method="post" enctype="multipart/form-data" name="form1">
                     		<input type="file" name="cvsfile" id="1" />
                    		<input type="submit" name="button" id="button" value="Submit" />
               		 	</form>
			</div>
    	</td>
    </tr>
    </table>

<?php
	} elseif ($action == "saveadd") {
		echo finwebper($_GET['f'], $_GET['action']);
		if ($extension == '.csv') {
?>
<table width="750" border="1">
  <tr>
    <th width="91"> <div align="center">Asset </div></th>
    <th width="198"> <div align="center">Username </div></th>
    <th width="50"> <div align="center">Department </div></th>
    <th width="50"> <div align="center">Devicetype </div></th>
    <th width="100"> <div align="center">IPAddress </div></th>
    <th width="100"> <div align="center">Host Name </div></th>
  </tr>
<?php
			if (move_uploaded_file($_FILES["cvsfile"]["tmp_name"], $uploads_dir . $filename)) { //copy File ไปไว้ที่ Flolder ที่ต้องการ
				$objCSV = fopen($uploads_dir . $filename, "r"); // อ่าน File ใน Folder ที่เรา พึ่ง Copy,k
				while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) { // เอา File เข้า Array
					$comsql = $db->query("SELECT * FROM " . $dbcp . " where asset = '$objArr[2]' ");
					$numrow = $db->rows($comsql); //ตรวจสอบ ดูค่าที่จะเพิ่มเข้าไปในระบบ มีซ้ำ หรือเปล่า แล้วเอาค่าออกมาเป็นจำนวนแถ็ว
					//echo $numrow;
					$couobjArr = count($objArr);
					//$couvalue = count($value);
					$couvalue = 45;
					//echo $couobjArr.'&'.$couvalue;
					$i = 1;
					$n = 0;
					while ($i <= $couvalue) {
						$sumarray[$value[$i]] = $objArr[$n];
						$i++;
						$n++;
					}
					echo $sumarray[devicetype].'<br/>';
					if (empty($numrow)) {

?>
<tr>
    <td><div align="center"><?= $objArr[2]; ?></div></td>
    <td><?= $objArr[1]; ?></td>
    <td><?= $objArr[13]; ?></td>
    <td><div align="lift"><?= $objArr[0]; ?></div></td>
    <td align="center"><?= $objArr[3]; ?></td>
    <td align="lift"><?= $objArr[28]; ?></td>
  </tr>
<?php
						$add = $db->add_db($dbcp, $sumarray);
										
					}
				}
			}

		} else {
			getJavaAlert("กรุณาเลือก File CVS เท่านั้น แต่คุณเลือก File $extension ไม่สามารถนำเข้า Database ได้นะครับ", 0);
			_go("index.php");

		}
	}
?>
</table>
</div>
</div>
