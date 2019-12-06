<?php
	// https://www.w3schools.com/php/func_string_str_replace.asp
	// https://www.youtube.com/watch?v=32VcKyI0dio
	// https://www.elithecomputerguy.com/2019/07/write-post-data-to-server-with-arduino-uno-with-wifi/
	// https://techtutorialsx.com/2016/07/21/esp8266-post-requests/
	// https://circuits4you.com/2018/03/10/esp8266-nodemcu-post-request-data-to-website/
	// 
	
	$boiler = 
	"
		<html>
			<head>
				<style>
					body {
						padding: 15px;
						max-width: 900px;
						margin: 0 auto;
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