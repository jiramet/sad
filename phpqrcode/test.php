<?php
//include ('../lib/full/qrlib.php');
include ('qrlib.php');

// outputs image directly into browser, as PNG stream
QRcode::png ( 'PHP QR Code :)' );
?>