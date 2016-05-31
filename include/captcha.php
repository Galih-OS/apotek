<?php


$string = '';

for ($i = 0; $i < 5; $i++) {
	// this numbers refer to numbers of the ascii table (lower case)
	$string .= chr(rand(97, 122));
}

session_start();
$_SESSION['rand_code'] = $string;

$dir = '../fonts/';

$image = imagecreatetruecolor(170, 60);
$black = imagecolorallocate($image, 0, 0, 0);
$color = imagecolorallocate($image, 0, 100, 150); // red
$white = imagecolorallocate($image, 255, 255, 255);

imagefilledrectangle($image,0,0,399,99,$white);
imagettftext ($image, 50, 5, 15, 50, $color, $dir."monofont.ttf", $_SESSION['rand_code']);

header("Content-type: image/png");
imagepng($image);

?>