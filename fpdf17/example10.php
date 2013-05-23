<?php
define('FPDF_FONTPATH','font/');

require('fpdf.php');

$pdf=new FPDF();

// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวธรรมดา กำหนด ชื่อ เป็น angsana
$pdf->AddFont('angsana','','angsa.php');



//สร้างหน้าเอกสาร
$pdf->AddPage();

// กำหนดฟอนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 12
$pdf->SetFont('angsana','',12);
// พิมพ์ข้อความลงเอกสาร
$pdf->setXY( 10, 10  );
$pdf->MultiCell( 0  , 0 , iconv( 'UTF-8','cp874' , 'อังสนา ตัวธรรมดา ขนาด 12' ) );


$pdf->Output();
?>