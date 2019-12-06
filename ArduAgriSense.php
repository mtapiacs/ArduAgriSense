<?php
	$boiler = 
	"
		<html>
			<body>
				<h1>Temp {{tempC}}</h1>
			</body>
		</html>
	";
	
	$tempC = $_POST["tempC"];
	$new_dashboard = str_replace("{{tempC}}", $tempC, $boiler);
	
	file_put_contents("dashboard.html", $new_dashboard);
	
	echo "Data Sent!";
?>



<!--
	// $time = time();
	// $tempF = $_POST["tempC"];
	// $file = 'dashboard.html';
	// $data = $time."  -  ".$tempF;
	// file_put_contents($file, $data);
-->