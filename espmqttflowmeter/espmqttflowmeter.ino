// Libs
#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <EEPROM.h>
 
// Vars
const char* SSID = "smart"; // rede wifi
const char* PASSWORD = "12345678"; // senha da rede wifi

const char* BROKER_MQTT = "192.168.4.1"; // ip/host do broker
int BROKER_PORT = 1883; // porta do broker

int stored;
int rate;
int eprom_addr = 0;
String f;
String s;

void initSerial();
void initWiFi();
void initMQTT();

WiFiClient espClient;
PubSubClient MQTT(espClient); // instancia o mqtt


void cPulse()
  {   
      rate++;
  }

void setup() {
  EEPROM.begin(1);
  stored = EEPROM.read(eprom_addr);
  attachInterrupt(digitalPinToInterrupt(14), cPulse, RISING);
 
  initSerial();
  initWiFi();
  initMQTT();
}

void loop() {

   delay(2000);
   f = String(rate)+"-Fluxo";
      MQTT.publish("pub_flow_01_sensor_data", String(f).c_str());// valor do fluxo de agua
    delay(2000);
   s = String(stored)+"-Acumulado";
      MQTT.publish("pub_flow_01_sensor_data", String(s).c_str());// valor em armazenado de litros

 if(rate > 440 )// 440 pulsos = 1 litro
  {
      stored++;
   
      EEPROM.write(eprom_addr, stored);
      EEPROM.commit();
      rate = 0;
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
    if (MQTT.connect("flow_1")) {
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
