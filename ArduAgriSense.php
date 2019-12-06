<?php
	// $time = time();
	// $tempF = $_POST["tempC"];
	// $file = 'dashboard.html';
	// $data = $time."  -  ".$tempF;
	// file_put_contents($file, $data);
	
	$boiler = 
	"
		<html>
			<head>
				<style>
					h1 {
						text-align: center;
					}
					
					.container {
						display: flex;
						flex-flow: row wrap;
					}
					
					.container * {
						flex: 0 0 50%;
					}
				</style>
			</head>
			<body>
				<h1>ArduAgriSense</h1>
				<div class='container'>
					<p>Time {{time}}</p>
					<p>Celcius {{tempC}}</p>
					<p>Fahrenheit {{tempF}}</p>
					<p>Humidity {{humidity}}</p>
					<p>Heat Index C {{hiC}}</p>
					<p>Heat Index F {{hiF}}</p>
				</div>
			</body>
		</html>
	";
	
	$arr_replace = array("{{time}}", "{{tempC}}", "{{tempF}}", "{{humidity}}", "{{hiC}}", "{{hiF}}");
	$new_values = array('TIME', $_POST["tempC"], $_POST["tempF"], $_POST["humidity"], $_POST["hiC"], $_POST["hiF"]);
	
	$new_dashboard = str_replace($arr_replace, $new_values, $boiler);
	
	file_put_contents("dashboard.html", $new_dashboard);
	
	echo "Data Sent!";
?>