<?php
// Part 1, creating images
$width = 600;
$heigth = 400;
$img = imagecreatetruecolor($weigth, $heigth);
// Create a canvas

// Allocate colours
$colour1 = imagecolorallocate($img, 255, 20, 255);
$cadmium = imagecolorallocate($img, 255, 153, 18);
$cobalt = imagecolorallocate($img, 61, 89, 171);
// Fill the canvas
imagefill($img, 120, 20, $cobalt);

// Draw an ellipse
imagefilledellipse($img, 200, 100, 100, 50, $cadmium);
imagefilledellipse($img, 110,10, 10, 10, $colour1);
// Save or stream image
header('Content-type: image/jpeg');
imagejpeg($img, NULL, 90);
// If streaming, send Content-type header BEFORE calling imagejpeg

?>