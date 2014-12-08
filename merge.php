<?php
// $target_dir = "/uploads/";
$target_file = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

// $base = new Imagick('fotousuario.jpg');
$base= new Imagick($target_file);
$mask = new Imagick('mascara.png');
$over = new Imagick('overlay.png');


// Setting same size for all images
$base->resizeImage(621, 1106, Imagick::FILTER_LANCZOS, 1);
$base->writeImage('resize.jpg');
$base->extentImage(1366,1106,-745,0);
$base->writeImage('extented.jpg');
// extentImage ( int $width , int $height , int $x , int $y )
// $mask->resizeImage(800, 648, Imagick::FILTER_LANCZOS, 1);
// $over->resizeImage(800, 648, Imagick::FILTER_LANCZOS, 1);

// Copy opacity mask
$base->compositeImage($mask, Imagick::COMPOSITE_DSTIN, 0, 0, Imagick::CHANNEL_ALPHA);

// Add overlay
$base->compositeImage($over, Imagick::COMPOSITE_DEFAULT, 0, 0);

$base->writeImage('output.jpg');
header("Content-Type: image/jpg");

echo $base;

?>