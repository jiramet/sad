<h1>ระบบนำFile CSV เข้า Databases</h1>
<?php
	echo fpermiss($_GET['f']); // ตรวจสอบสิทธิในการเข้าถึง
	$dbcp = _HARDWARE;
	$uploads_dir = 'csv/'; // Folder ที่จะเก็บ File
	$filename = $_FILES['cvsfile']['name']; //เอาชื่อ File  ออกมา
	$extension = strrchr($filename, '.'); //เอานามสกุล  ออกมา

	//start------------------กำหนดตัวแปลจาก Databases-----------------------
	$getsumfield = getsumfieldmysql($dbcp); //นับจำนวน Field ของ $dbcp ว่ามีทั้งหมด กี่ Field
	//echo $getsumfield;
	$value = getfieldmysql($dbcp); // get ชื่อ Field มา เพื่อนำไปตั้ง ชื่อ Textfield (ช่องสำหรับกรอกข้อมูลสำหรับส่งค่า)
	//echo $value[9];

	//end----------จำกำหนดตัวแปลจาก Databases-----------------------

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
  <form action="index.php?f=<?php echo $_GET[f]; ?>&action=saveadd" method="post" enctype="multipart/form-data" name="form1">
  <table width="95%" border="1" cellspacing="5" cellpadding="5">
    <tr>
        <td colspan="2"><div align="center">
				<label for="1">กรุณาเลือก File ที่จะนำเข้า Databases (File CSV)</label>
            </div></td>
    </tr>
    <tr>
      <td><div align="right">การกระทำ</div></td>
      <td><div align="left">
        <input name="dataadd" type="radio" id="12" value="1" checked="checked"/><label>Add New Data</label>&nbsp;&nbsp;&nbsp;
        <input type="radio" name="dataadd" id="2" value="2" /><label>Update Data</label></div></td>
    </tr>
    <tr>
    	<td><div align="right">กรุณาเลือกFile CSV</div></td>
    	<td width="50%"><div align="center"><input type="file" name="cvsfile" id="1" /></div></td>	
    </tr>
    <tr>
    	<td colspan="2"><div align="right"><input type="submit" name="button" id="button" value="Submit" /></div></td>
    </tr>
    </table>
</form>
<?php
	} elseif ($action == "saveadd") {
		if ($_POST[dataadd] == 1) {
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
						$couvalue = (count($value) - 1);
						$sumarray = array();
						$i = 1;
						$n = 0;
						while ($i <= $couvalue) { //  ทำการ Merge Data  เข้าด้วยกัน  ชื่อ Field กับ Data  ดูคำอธิบายด้านล่าง
							$sumarray[$value[$i]] = $objArr[$n]; //  $value จะเริ่มDataที่ 1 ส่วน  $objArr จะเริ่มDataที่  0
							$i++;
							$n++;
							//echo $sumarray[asset]   				  //  ทำการ  แสดง  Data  ของ Aseet ออกมา  ซึ่งจะเก็บ เป็น Array
						}
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
							if ($add) {
								//getJavaAlert("เพิ่มข้อมูลสำเร็จ", 0);
							} else {
								getJavaAlert("เพิ่มข้อมูลล้มเหลวกรุณาตรวจสอบด้วยครับ.....!!!!", 0);
							}
						}
					}
				}

			} else {
				getJavaAlert("กรุณาเลือก File CVS เท่านั้น แต่คุณเลือก File $extension ไม่สามารถนำDatabase เข้า Database ได้นะครับ", 0);
				_go("index.php");

			}
		} elseif ($_POST[dataadd] == 2) {
			//echo '22222222';
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
						$couvalue = (count($value) - 1);
						$sumarray = array();
						$i = 1;
						$n = 0;
						while ($i <= $couvalue) { //  ทำการ Merge Data  เข้าด้วยกัน  ชื่อ Field กับ Data  ดูคำอธิบายด้านล่าง
							$sumarray[$value[$i]] = $objArr[$n]; //  $value จะเริ่มDataที่ 1 ส่วน  $objArr จะเริ่มDataที่  0
							$i++;
							$n++;
							//echo $sumarray[asset]   				  //  ทำการ  แสดง  Data  ของ Aseet ออกมา  ซึ่งจะเก็บ เป็น Array
						}


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
							
							$save = $db->update_db($dbcp, $sumarray, "$value[3] = '" . $objArr[2] . "'");
							if ($save) {
								//getJavaAlert("เพิ่มข้อมูลสำเร็จ", 0);
							} else {
								getJavaAlert("Update ข้อมูลล้มเหลวกรุณาตรวจสอบด้วยครับ.....!!!!", 0);
							}
					}
				}

			} else {
				getJavaAlert("กรุณาเลือก File CVS เท่านั้น แต่คุณเลือก File $extension ไม่สามารถนำDatabase เข้า Database ได้นะครับ", 0);
				_go("index.php");

			}
		}
	}
?>
</table>
</div>
</div>
