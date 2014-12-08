<?php

//  SUBIDA DE ARCHIVO

$target_file = basename($_FILES["fileToUpload"]["name"]); // Imagen de destino, conservo el nombre y lo subo al raiz de donde esta el archivo

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

// SUBIDA DE ARCHIVO

// $base = new Imagick('fotousuario.jpg');

$base= new Imagick($target_file); // Tomo el archivo subido
$mask = new Imagick('mascara.png'); // tomo la mascara de opacidad
$over = new Imagick('overlay.png'); // tomo la capa que va encima


// Aseguro el tamaño del archivo de entrada
$base->resizeImage(621, 1106, Imagick::FILTER_LANCZOS, 1); 

// Agrando el canvas, para alinear la imagen a la derecha
$base->extentImage(1366,1106,-745,0); 

// Aplico Mascara de Opacidad
$base->compositeImage($mask, Imagick::COMPOSITE_DSTIN, 0, 0, Imagick::CHANNEL_ALPHA);

// Aplico la capa superior
$base->compositeImage($over, Imagick::COMPOSITE_DEFAULT, 0, 0);

// Guardo el archivo compuesto
$base->writeImage('output.jpg');

// Muestro el archivo
header("Content-Type: image/jpg");

echo $base;

?>