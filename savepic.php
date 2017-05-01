<?php
	session_start();




	$data = substr($_POST['pic'], strpos($_POST['pic'], ",") + 1);
	$decodedData = base64_decode($data);
	$fd = fopen("canvas.png", 'wb');

	fwrite($fd, $decodedData);
	fclose();




	// Get dimensions for specified images
	$top = imagecreatefrompng('img/sumo.png');
	$pic = imagecreatefrompng('canvas.png');


	// Load images and then copy to destination image

	imagecopy($pic, $top, 50, 50, 0, 0, imagesx($top), imagesy($top));

	// Save the resulting image to disk (as JPEG)

	imagejpeg($pic, 'res.jpeg');

	// Clean up

	imagedestroy($top);
	imagedestroy($pic);

?>
