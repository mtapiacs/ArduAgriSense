/*
  ArduAgriSense Prototype
  - Action: Reads any data from sensor and sends data to server for processing
  and analysis.
  - Built by: Miguel Tapia
  - Consulted Sources:
    * https://www.elithecomputerguy.com/2019/07/write-post-data-to-server-with-arduino-uno-with-wifi/
    * https://circuits4you.com/2018/03/10/esp8266-nodemcu-post-request-data-to-website/
    * https://www.youtube.com/watch?v=32VcKyI0dio
    * https://techtutorialsx.com/2016/07/21/esp8266-post-requests/
    * https://www.w3schools.com/php/func_string_str_replace.asp
    * https://stackoverflow.com/questions/5335273/how-to-send-an-email-using-php
    * https://www.w3schools.com/php/php_date.asp
    * DHT Example
  - NOTE:
    * There is a server portion to this project. It is at the following: https://github.com/mtapiacs/ArduAgriSense. 
    * This project is limitless. Any sensor could be connected, and its data could be processed by the server!
*/

// Necessary Includes
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include "DHT.h"

// Defining Pins & Type For DHT
#define DHTPIN 5 
#define DHTTYPE DHT11

// DHT Module Init
DHT dht(DHTPIN, DHTTYPE);

// Data For Wifi Connect
const char* ssid = "Cairn-Guest";
const char* password = "";

// Connects To Wifi / Starts DHT
void setup(void) { 
  Serial.begin(115200);
  
  // Connection To Wifi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) 
  {
     delay(500);
     Serial.print("*");
  }
  
  Serial.println("");
  Serial.println("WiFi connection Successful");
  Serial.print("The IP Address of ESP8266 Module is: ");
  Serial.print(WiFi.localIP());

  // Initialize DHT
  dht.begin();
}

// Sends Data To Server Every 5 Seconds
void loop() {
  //==============================================================
  //                          GET DATA
  //==============================================================
  // Read Humidity & Temperatures
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  float f = dht.readTemperature(true);

  // If Any Value Is Undefined...DHT Stop
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    return;
  }

  // Read Heat Indexes
  float hif = dht.computeHeatIndex(f, h);
  float hic = dht.computeHeatIndex(t, h, false);

  //==============================================================
  //                          SEND DATA
  //==============================================================
  // HTTPClient Instance
  HTTPClient http;

  // HTTP Endpoint And Data
  http.begin("http://csinfo.cairn.edu/~mt815/ArduAgriSense/ArduAgriSense.php");
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  // POST Data
  String postData = "tempC=" + String(t) + "&tempF=" + String(f) 
                    + "&humidity=" + String(h) + "&hiC=" + String(hic) 
                    + "&hiF=" + String(hif); 

  int httpCode = http.POST(postData);   // Sends Post
  String payload = http.getString();    // Server Response

  Serial.println("Http Status Code: " + String(httpCode));
  Serial.println("Server Response: " + payload);

  http.end(); // Close Connection

  delay(5000); // Send Data Again After 5 Seconds
}
