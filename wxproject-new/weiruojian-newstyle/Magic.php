<?php
$name = "localhost";
$width = 200;
$height = 200;
$image = imagecreatetruecolor($width, $height);
$color = imagecolorallocate($image, 255, 255, 255);
for ($i = 0; $i < $width / 10; $i++) {
	for ($j = 0; $j < $width / 10; $j++) {
		mt_rand(0, 100) >= 61 && imagefilledrectangle($image, $i * 10, $j * 10, $i * 10 + 10, $j * 10 + 10, $color);
	}
}
$mcp1 = substr(sha1($name, false), 0, 16);
$mcp2 = substr(sha1($name, false), 20, 36);
$mc = strtoupper(md5($mcp1 . $mcp2));
imagepng($image, "./$mc");