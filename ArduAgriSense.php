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
					body {
						padding: 15px;
					}
					
					h2 {
						text-align: center;
					}
					
					.container {
						display: flex;
						flex-flow: row wrap;
						text-align: center;
					}
					
					.container * {
						flex: 0 0 50%;
					}
					
					@media screen and (max-width: 330px) {
						.container * {
							flex: 0 0 100%;
						}
					}
				</style>
			</head>
			<body>
				<h2>ArduAgriSense</h2>
				<div class='container'>
					<p><strong>Time:</strong><br> {{time}}</p>
					<p><strong>Celcius:</strong><br> {{tempC}}</p>
					<p><strong>Fahrenheit:</strong><br> {{tempF}}</p>
					<p><strong>Humidity:</strong><br> {{humidity}}</p>
					<p><strong>Heat Index C:</strong><br> {{hiC}}</p>
					<p><strong>Heat Index F:</strong><br> {{hiF}}</p>
				</div>
			</body>
		</html>
	";
	
	$arr_replace = array("{{time}}", "{{tempC}}", "{{tempF}}", "{{humidity}}", "{{hiC}}", "{{hiF}}");
	$new_values = array(time(), $_POST["tempC"], $_POST["tempF"], $_POST["humidity"], $_POST["hiC"], $_POST["hiF"]);
	
	$new_dashboard = str_replace($arr_replace, $new_values, $boiler);
	
	file_put_contents("dashboard.html", $new_dashboard);
	
	echo "Data Sent!";
?>