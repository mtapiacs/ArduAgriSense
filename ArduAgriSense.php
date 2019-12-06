<?php
	// $time = time();
	// $tempF = $_POST["tempC"];
	// $file = 'dashboard.html';
	// $data = $time."  -  ".$tempF;
	// file_put_contents($file, $data);
	
	$tempC = $_POST["tempC"];
	$dashboardContents = file_get_contents("dashboard.html");
	$new_dashboard = str_replace("{{tempC}}", $tempC, $dashboardContents);
	
	file_put_contents("dashboard.html", $new_dashboard);
	
	echo "Data Sent!";
?>