<?php
	$time = time();
	$tempF = $_POST["tempC"];
	$file = 'dashboard.html';
	$data = $time."  -  ".$tempF;
	file_put_contents($file, $data);
	
	echo "Data Sent!";
?>