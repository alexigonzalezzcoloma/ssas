<?php
/*
$im = new Imagick();
$im->setResolution(300,300);
$im->readimage('Kenssel_impresora.pdf[0]'); 
$im->setImageFormat('jpeg');    
$im->writeImage('thumb.jpg'); 
$im->clear(); 
$im->destroy();
*/
$imagick = new Imagick();
$imagick->readImage('Kenssel_impresora.pdf');
$imagick->writeImages('converted.png', false);

$source="myFile.pdf";
?>