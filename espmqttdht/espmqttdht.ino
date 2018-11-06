// Libs
#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include "DHT.h"
 
#define DHT_DATA_PIN 2
#define DHTTYPE DHT11
 

// Vars
const char* SSID = "smart"; // rede wifi
const char* PASSWORD = "12345678"; // senha da rede wifi

const char* BROKER_MQTT = "192.168.4.1"; // ip/host do broker
int BROKER_PORT = 1883; // porta do broker
String in;
String t;
String u;

DHT dht(DHT_DATA_PIN, DHTTYPE);


void initSerial();
void initWiFi();
void initMQTT();

WiFiClient espClient;
PubSubClient MQTT(espClient); // instancia o mqtt


void setup() {
  
  dht.begin();
  initSerial();
  initWiFi();
  initMQTT();
}

void loop() {
 delay(2000);

  float umid = dht.readHumidity();
  u = String(umid)+"-Umidade";
  
  float temp = dht.readTemperature();
  t = String(temp)+"-Temperatura";


if (isnan(umid) || isnan(temp)) {
    
    return;
 }else{

   delay(12000);
   MQTT.publish("pub_dht_01_sensor_data", t.c_str()); 
   
   MQTT.publish("pub_dht_01_sensor_data", u.c_str());

}
  recconectWiFi();
  MQTT.loop();


  if (!MQTT.connected()) {
    reconnectMQTT();
  }
 
}

void initSerial() {
  Serial.begin(9600);
}
void initWiFi() {
  delay(8000);
  Serial.println("Conectando-se em: " + String(SSID));
  WiFi.mode(WIFI_STA);
  WiFi.begin(SSID, PASSWORD);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println(".");
  }
  Serial.println();
  Serial.println("Conectado na Rede " + String(SSID) + " | IP => ");
  Serial.println(WiFi.localIP());
}

// Funcão para se conectar ao Broker MQTT
void initMQTT() {
  MQTT.setServer(BROKER_MQTT, BROKER_PORT);
 }




void reconnectMQTT() {
  while (!MQTT.connected()) {
    Serial.println("Conectando.. " + String(BROKER_MQTT));
    if (MQTT.connect("dht_sensor_01")) {
      Serial.println("Conectado");
  
    } else {
      Serial.println("Falha ao Reconectar");
      Serial.println("Tentando se reconectar");
      delay(2000);
    }
  }
}

void recconectWiFi() {
  while (WiFi.status() != WL_CONNECTED) {
    delay(100);
    Serial.print(".");
  }
}
