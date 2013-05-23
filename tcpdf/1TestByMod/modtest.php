<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2012-07-25
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               Manor Coach House, Church Hill
//               Aldershot, Hants, GU12 4RQ
//               UK
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo

		$image_file = K_PATH_IMAGES.'g-tec.jpg';   //ไปโหลดรูปมา
		$this->Image($image_file, 10, 10, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		//$image_file, 10, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// 10
		// Set font
		
		//$this->SetFont('verdana', 'BI', 20);
		// Title
		//$this->Cell(0, 15, 'G-TEC', 0, false, 'L', 0, '', 0, false, 'M', 'M');
		$this->SetFont('angsanaupc', 'BI', 22);
		$this->Cell(0, 0, 'แบบฟอร์มการแจ้งดำเนินการด้าน iT', 0, 1, 'L', 0, '', 1);
		$this->SetFont('angsanaupc', 'BI', 18);
		$this->Cell(0, 0, '                                 IT Repair inform and IT Request Form', 0, 1, 'L', 0, '', 1);


		$style = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		
		$this->Line(5, 28, 203, 28, $style);
		

	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 7);
		$this->Cell(0, 0, 'Form No. : TE-FM-IT-006 Rev.0                                                                                                                                                                                                                                                                                                                                                      Effective Date : 7 Dec 12', 0, 1, 'C', 0, '', 1);
		// Page number
		//$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}


// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Mr.Thirachai Sueapo');
$pdf->SetTitle('Test Create PDF by Mod');
$pdf->SetSubject('Test');
$pdf->SetKeywords('Test Keywords');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setFooterData($tc=array(0,64,0), $lc=array(0,64,128));


// remove default header/footer   เอาส่วนหัวกระดาษออก  แต่ต้องใส่ Comment ในส่วน set default header data ด้วยนะ
//$pdf->setPrintHeader(false);    
//$pdf->setPrintFooter(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('angsanaupc', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();


// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<h1><b>Welcome to TCPDF!</b></h1>
<i>This is the first example of TCPDF libraryน้ำ.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
