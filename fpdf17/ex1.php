<?php
defined ( 'FPDF_FONTPATH', 'fonts/' );
require ('PDF_Label.php');
$pdf = new PDF_Label ( 'L7163' ); // PDF_Label($format, $unit='mm', $posX=1, $posY=1)
$pdf->AddFont ( 'angsana', '', 'angsa.php' );
$pdf->AddFont ( 'angsana', 'B', 'angsab.php' );
$pdf->AddFont ( 'angsana', 'I', 'angsai.php' );
$pdf->AddFont ( 'angsana', 'BI', 'angsaz.php' );
$pdf->SetMargins ( 10, 5 );
$pdf->AddPage ();
$pdf->SetFont ( 'angsana', '', 12 );
// $pdf->SetXY(10, 10);
// $pdf->MultiCell(0, 0, iconv('UTF-8', 'cp874', 'อังสนา ตัวธรรมดา ขนาด 12'));

$a = '';
$b = "";
$c = "";
//$text = $pdf->MultiCell ( 60, 10, " " . $a . "\n" . $b . "\n" . $c, 0, 'L' );
// $text = $pdf->MultiCell(70, 35, $txt)
//$pdf->Add_Label ( $text );

for($i = 1; $i <= 10; $i ++) {
	$text = sprintf("%s\n%s\n%s\n%s %s, %s", "Laurent $i", 'Immeuble Toto', 'av. Fragonard', '06000', 'NICE', 'FRANCE');
	// $text = $pdf->MultiCell(20, 30, $txt)
	$a = 'Asset : AC-PC-001';
	$b = "Department : $i ";
	$c = "Serial : SGH015sJ67 ";
	$f = "<table><tr><td>1</td><td>2</td></tr></table>";
	//$text = $pdf->MultiCell ( 60, 5, " " . $a . "\n" . $b . "\n" . $c, 1, 'L' );
	//$text = $pdf->MultiCell ( 60, 5,"$i", 1, 'L' );
	//$text = sprintf($pdf->MultiCell ( 60, 5, " " . $a . "\n" . $b . "\n" . $c, 1, 'L' ));
	// $text = $pdf->MultiCell(70, 35, $txt)
	$pdf->Add_Label ( "$a\n$b\n$c\n$i");
}

$pdf->Output ();
?>