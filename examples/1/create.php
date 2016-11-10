<?php
// Part 1, creating images

// Create a canvas
$img = imagecreatetruecolor(500, 300);

// Allocate colours
$indian_red = imagecolorallocate($img, 176, 23, 31);
$blue = imagecolorallocate($img, 0, 0, 255);
$crimson = imagecolorallocate($img, 220, 20, 60);
$cadmium = imagecolorallocate($img, 255, 153, 18);
$cobalt = imagecolorallocate($img, 61, 89, 171);

// Fill the canvas
imagefill($img, 0, 0, $cadmium);

// Draw ellipses
imagefilledellipse($img,250,150,100,100,$crimson);
imagefilledellipse($img,100,100,80,80,$cobalt);
imagefilledellipse($img,375,75,50,50,$indian_red);

// Save or stream image
// Save as a jpeg
//imagejpeg($img, 'thumbs/circle.jpg', 90);
// Save as a png
//imagepng($img, 'thumbs/circles.png');
// Tell the browser there is jpeg data coming it's way
header('Content-type: image/jpeg');
// Omit filename argument to stream image
imagejpeg($img, NULL, 90);

?>
