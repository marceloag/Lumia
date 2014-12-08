<?php

$base = new Imagick('fotousuario.jpg');
$mask = new Imagick('mascara.png');
$over = new Imagick('overlay.png');


// Setting same size for all images
// $base->resizeImage(274, 275, Imagick::FILTER_LANCZOS, 1);

// Copy opacity mask
$base->compositeImage($mask, Imagick::COMPOSITE_DSTIN, 0, 0, Imagick::CHANNEL_ALPHA);

// Add overlay
$base->compositeImage($over, Imagick::COMPOSITE_DEFAULT, 0, 0);

$base->writeImage('output.jpg');
header("Content-Type: image/jpg");

echo $base;

?>