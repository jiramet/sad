<?php
include ('qrlib.php');

// how to save PNG codes to server

$tempDir = './image/';

$codeContents = 'www.google.co.th';

// we need to generate filename somehow,
// with md5 or with database ID used to obtains $codeContents...
// $fileName = '005_file_' . md5 ( $codeContents ) . '.png';
$fileName = 'QR_IT_file_' . $codeContents . '.png';

$pngAbsoluteFilePath = $tempDir . $fileName;
$urlRelativeFilePath = $tempDir . $fileName;

QRcode::png ( $codeContents, $pngAbsoluteFilePath );

echo 'Server PNG File: ' . $pngAbsoluteFilePath;
echo '<hr />';

// displaying
echo '<img src="' . $urlRelativeFilePath . '" />';
?>