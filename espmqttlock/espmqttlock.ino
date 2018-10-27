// Libs
#include <ESP8266WiFi.h>
#include <PubSubClient.h>

// Vars
const char* SSID = "smart"; // rede wifi
const char* PASSWORD = "12345678"; // senha da rede wifi

const char* BROKER_MQTT = "192.168.4.1"; // ip/host do broker
int BROKER_PORT = 1883; // porta do broker
String in;
// prototypes


void initPins();
void initSerial();
void initWiFi();
void initMQTT();

WiFiClient espClient;
PubSubClient MQTT(espClient); // instancia o mqtt

// setup
void setup() {
  
  initPins();
  initSerial();
  initWiFi();
  initMQTT();
}

void loop() {

  in = Serial.readString();
  if(in.length()>1){
  //  String teste = in.c_str();
   MQTT.publish("pub_lock_01", in.c_str()); 
  }
  
 
  
  if (!MQTT.connected()) {
    reconnectMQTT();
  }
  recconectWiFi();
  MQTT.loop();
}

// implementacao dos prototypes

void initPins() {
 // pinMode(D5, OUTPUT);
 // digitalWrite(D5, 0);
}

void initSerial() {
  Serial.begin(9600);
}
void initWiFi() {
  delay(9000);
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
  MQTT.setCallback(mqtt_callback);
}

//Função que recebe as mensagens publicadas
void mqtt_callback(char* topic, byte* payload, unsigned int length) {
 
  String message;
  for (int i = 0; i < length; i++) {
    char c = (char)payload[i];
    message += c;
  }

  Serial.println(String(message));

  Serial.flush();
}

void reconnectMQTT() {
  while (!MQTT.connected()) {
    Serial.println("Conectando.. " + String(BROKER_MQTT));
    if (MQTT.connect("lock_01")) {
      Serial.println("Conectado");
      MQTT.subscribe("sub_lock_01");

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
