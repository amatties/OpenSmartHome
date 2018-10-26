// Libs
#include <ESP8266WiFi.h>
#include <PubSubClient.h>

// Vars
const char* SSID = "smart"; // rede wifi
const char* PASSWORD = "12345678"; // senha da rede wifi

const char* BROKER_MQTT = "192.168.4.1"; // ip/host do broker
int BROKER_PORT = 1883; // porta do broker
String in;
int out;
int status;
int mode;



void initPins();
void initSerial();
void initWiFi();
void initMQTT();

WiFiClient espClient;
PubSubClient MQTT(espClient); // instancia o mqtt


void setup() {
  
  initPins();
  initSerial();
  initWiFi();
  initMQTT();
}

void loop() {

  if (!MQTT.connected()) {
    reconnectMQTT();
  }
  recconectWiFi();
  MQTT.loop();
}

// implementacao dos prototypes

void initPins() {
  pinMode(16, OUTPUT);
  pinMode(5, OUTPUT);
  pinMode(4, OUTPUT);
  pinMode(14, OUTPUT);
  digitalWrite(16, 1);
  digitalWrite(5, 1);
  digitalWrite(4, 1);
  digitalWrite(14, 1);
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
  Serial.println("Topico => " + String(topic) + " | Valor => " + String(message));
 
  Serial.println(String(message));
   out = message.substring(0,1).toInt();
    status = message.substring(1).toInt();
 
    if(status == 1){
     mode = 0;
    }else if(status ==0){
     mode = 1;
    }
 
    if(out == 1){
     digitalWrite(16, mode); 
    }else if(out==2){
      digitalWrite(5, mode);
    }else if(out==3){
      digitalWrite(14, mode);
    }else if(out==4){
      digitalWrite(4, mode);
    }

  Serial.flush();
}

void reconnectMQTT() {
  while (!MQTT.connected()) {
    Serial.println("Conectando.. " + String(BROKER_MQTT));
    if (MQTT.connect("light_1")) {
      Serial.println("Conectado");
      MQTT.subscribe("light_1");

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
