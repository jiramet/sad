<?php
// include ('../lib/full/qrlib.php');
// header("Content-type: image/png");
include ('qrlib.php');

include ('config.php');

// how to save PNG codes to server

$tempDir = './image/png';

$codeContents = 'www.google.co.th';

// we need to generate filename somehow,
// with md5 or with database ID used to obtains $codeContents...
$fileName = '005_file_' . md5 ( $codeContents ) . '.png';

$pngAbsoluteFilePath = $tempDir . $fileName;
$urlRelativeFilePath = './image/png' . $fileName;

	QRcode::png ( $codeContents, $pngAbsoluteFilePath );

echo 'Server PNG File: ' . $pngAbsoluteFilePath;
echo '<hr />';

// displaying
echo '<img src="' . $urlRelativeFilePath . '" />';
?>