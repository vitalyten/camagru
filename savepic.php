<?php
	session_start();



	$data = substr($_POST['pic'], strpos($_POST['pic'], ",") + 1);
	$decodedData = base64_decode($data);
	$fd = fopen("canvas.png", 'wb');
	// $_POST each
	// fwrite($fd, $data);
	fwrite($fd, $decodedData);
	fclose();
// echo "/canvas.png";
// echo $_POST;
?>
