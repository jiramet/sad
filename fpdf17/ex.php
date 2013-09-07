<?php
defined ( 'FPDF_FONTPATH', 'fonts/' );
require ('PDF_Label.php');
require '../phpqrcode/qrlib.php';

$tempDir = '../images/png/';
$text = 'AC-PC-001';
$codeContents = 'www.g-tec.co.th/~it/index.php?f=iphoneche&id='.$text;
//$codeContents = 'AC-PC-001';
$fileName = 'QR_IT_file_' . $text . '.png';

$pngAbsoluteFilePath = $tempDir . $fileName;
$urlRelativeFilePath = $tempDir . $fileName;

QRcode::png ( $codeContents, $pngAbsoluteFilePath, 'QR_ECLEVEL_L', '4' );

/*
 * ------------------------------------------------ To create the object, 2 possibilities: either pass a custom format via an array or use a built-in AVERY name ------------------------------------------------
 */

// Example of custom format
// $pdf = new PDF_Label(array('paper-size'=>'A4', 'metric'=>'mm', 'marginLeft'=>1, 'marginTop'=>1, 'NX'=>2, 'NY'=>7, 'SpaceX'=>0, 'SpaceY'=>0, 'width'=>99, 'height'=>38, 'font-size'=>14));

// Standard format

$pdf = new PDF_Label ( 'L7163' );

$pdf->AddFont ( 'angsana', '', 'angsa.php' );
$pdf->AddFont ( 'angsana', 'B', 'angsab.php' );
$pdf->AddFont ( 'angsana', 'I', 'angsai.php' );
$pdf->AddFont ( 'angsana', 'BI', 'angsaz.php' );

$pdf->AddPage ();

// Print labels
for($i = 1; $i <= 20; $i ++) {
	// $text = sprintf("%s\n%s\n%s\n%s %s, %s", "Asset : AC-PC-001", 'Serial PC : SGH015SJ67', 'Serial Monitor : ', '06000', 'NICE', 'FRANCE');
	// $text = sprintf("%s\n%s\n%s\n", "Asset : AC-PC-001", 'Serial PC : SGH015SJ67', 'Serial Monitor : ');
	// $text = sprintf("%s\n", "Asset : AC-PC-001");
	// $text = 'AC-PC-001';
	$pdf->Add_Label ( $text );
}

$pdf->Output ();
?>
