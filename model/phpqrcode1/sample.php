<?php

//load the ar library
include 'qrlib.php';

//data to be stored in qr
$text = "gwapo c tikboy tdsadasdasdsaasalaga;";
  
//file path
$file = "files/qr14.png";
  
//other parameters
$ecc = 'H';
$pixel_size = 8;
$frame_size = 5;
  
// Generates QR Code and Save as PNG
QRcode::png($text, $file, $ecc, $pixel_size, $frame_size);
  
// Displaying the stored QR code if you want
echo "<div><img src='".$file."'></div>";

?>