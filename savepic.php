<?php
	session_start();




	$data = substr($_POST['pic'], strpos($_POST['pic'], ",") + 1);
	$decodedData = base64_decode($data);
	$fd = fopen("canvas.png", 'wb');

	fwrite($fd, $decodedData);
	fclose();




	// Get dimensions for specified images
	$top = imagecreatefrompng($_POST['top']);
	$pic = imagecreatefrompng('canvas.png');


	// Load images and then copy to destination image
	$sx = imagesx($top);
	$sy = imagesy($top);
	// $sx = $sx > 640 ? 640 : $sx;
	// $sy = $sy > 480 ? 480 : $sy;
	imagecopy($pic, $top, $_POST['x'] - 58, $_POST['y'] - 108, 0, 0, $sx, $sy);

	// Save the resulting image to disk (as JPEG)

	imagejpeg($pic, 'res.jpeg');

	// Clean up

	imagedestroy($top);
	imagedestroy($pic);

?>
