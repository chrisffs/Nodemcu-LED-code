#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

const char *ssid = "wifi ni lydia";
const char *password = "salvador12345";

const char *host = "192.168.12.111";

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
  String id, getData, Link;
  id = "1";

  getData = "?id=" + id;
  Link = "http://192.168.12.111/led_code/get.php" + getData;
  
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
