<?php
	$time = time();
	$tempF = $_POST["tempC"];
	$file = 'temp.html';
	$data = $time."  -  ".$tempF;
	file_put_contents($file, $data);
?>