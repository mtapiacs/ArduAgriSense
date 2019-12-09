<?php
	// HTML Document Boilerplate
	$boiler = 
	"
		<html>
			<head>
				<title>ArduAgriSense</title>
				<style>
					body {
						padding: 15px;
						max-width: 900px;
						margin: 0 auto;
						font-family: sans-serif;
					}
					
					h2 {
						text-align: center;
					}
					
					img {
						width: 100%;
						max-width: 300px;
						height: auto;
						display: block;
						margin: 0 auto;
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
				<img src='{{img}}'>
			</body>
		</html>
	";
	
	$plant_image = "./good.jpg";
	
	if (!($_POST["tempF"] > 70 && $_POST["tempF"] < 76)) {
		// Email Client
		$msg = "Your plants are out of range!";
		$headers = 'From: webmaster@example.com' . "\r\n" .
				   'Reply-To: webmaster@example.com' . "\r\n" .
				   'X-Mailer: PHP/' . phpversion();
		mail("mtapiafdez@gmail.com","PLANT CARE", $msg, $headers);
		
		$plant_image = "./bad.jpg";
	}
	
	// Replace Values With Data From Post
	$arr_replace = array("{{time}}", "{{tempC}}", "{{tempF}}", "{{humidity}}", "{{hiC}}", "{{hiF}}", "{{img}}");
	$new_values = array(date("h:i:sa"), $_POST["tempC"], $_POST["tempF"], $_POST["humidity"], $_POST["hiC"], $_POST["hiF"], $plant_image);
	
	$new_dashboard = str_replace($arr_replace, $new_values, $boiler);
	
	// Add Contents To Dashboard.html
	file_put_contents("dashboard.html", $new_dashboard);
	
	echo "Data Sent!";
?>