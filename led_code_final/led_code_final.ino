#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

const char *ssid = ""; // Wifi Name
const char *password = ""; // Wifi Password

const char *host = ""; // IP Address

void setup() {
  pinMode(LED_BUILTIN, OUTPUT); 
  pinMode(D0, OUTPUT); 

  delay(1000);
  Serial.begin(115200);
  WiFi.mode(WIFI_OFF);
  delay(1000);
  WiFi.mode(WIFI_STA);
  
  WiFi.begin(ssid, password);
  Serial.println("");

  Serial.print("Connecting");

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  HTTPClient http;
  WiFiClient client;
  String getData, Link, path;
  path = "/led_code/get.php";  
  getData = "?id=1";
  Link = host + path + getData;
  
  http.begin(client, Link);
  
  int httpCode = http.GET();
  String payload = http.getString();

  Serial.println(httpCode);
  Serial.println(payload);

  if (payload == "1") {
    digitalWrite(LED_BUILTIN, LOW);
    digitalWrite(D0, HIGH);
    Serial.println("LED: ON");
  }
  if (payload == "0") {
    digitalWrite(LED_BUILTIN, HIGH);
    digitalWrite(D0, LOW);
    Serial.println("LED: OFF");
  }

  http.end();
  delay(1000);
}
