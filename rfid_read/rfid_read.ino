

#include <SPI.h>
#include <MFRC522.h>
#include "U8glib.h"

U8GLIB_ST7920_128X64_1X u8g(8, 7, 6);  

constexpr uint8_t RST_PIN = 9;     
constexpr uint8_t SS_PIN = 10;     

MFRC522 mfrc522(SS_PIN, RST_PIN);   

String in;
int pin;
int status;
String lcdout;
String tt;



void draw(String msg) {
u8g.firstPage();  
  do {
  u8g.setFont(u8g_font_6x13);
  
  u8g.drawStr( 0, 22, msg.c_str());
   } while( u8g.nextPage() );
}


void setup() {
  Serial.begin(9600);                                          
  SPI.begin();                                                  
  mfrc522.PCD_Init();                                              
 

lcdout = ("Aproxime seu cartao");

pinMode(5, OUTPUT);
pinMode(4, OUTPUT);
digitalWrite(5, HIGH);
digitalWrite(4, HIGH);
}


void loop() {


in = Serial.readString();

tt = in.c_str();

in.trim();

if(in == "open"){
   
    draw("Abrindo tranca");
    digitalWrite(5, LOW);
    delay(3000);
    digitalWrite(5, HIGH);
    
    delay(2000);
     }else if(in == "cad"){
      draw("Cadastrado");
      delay(3000);
    }else if(in == "block"){
      draw("Acesso Negado");
      delay(3000);
    }
   
 
  MFRC522::MIFARE_Key key;
  for (byte i = 0; i < 6; i++) key.keyByte[i] = 0xFF;

  //some variables we need
  byte block;
  byte len;
  MFRC522::StatusCode status;

  //-------------------------------------------


    draw(lcdout);


  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return;
  }

  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    return;
  }



  //-------------------------------------------
draw("Detectado");

  

 // mfrc522.PICC_DumpDetailsToSerial(&(mfrc522.uid)); //dump some details about the card

  String conteudo = "";
  //byte letra;
  int tam;
  for (byte i = 0; i < mfrc522.uid.size; i++)
  {
    //Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
   // Serial.print(mfrc522.uid.uidByte[i], HEX);
    conteudo.concat(String(mfrc522.uid.uidByte[i]<0x10 ? " 0" : ""));
    conteudo.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  tam = conteudo.length();
  //Serial.println(tam);
  Serial.println(conteudo);
 // lcdout = conteudo;
 //draw(conteudo);


  


  byte buffer1[18];

  block = 4;
  len = 18;

  //------------------------------------------- GET FIRST NAME
  status = mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, 4, &key, &(mfrc522.uid)); //line 834 of MFRC522.cpp file
  if (status != MFRC522::STATUS_OK) {
   // Serial.print(F("Authentication failed: "));
   // Serial.println(mfrc522.GetStatusCodeName(status));
    return;
  }

  status = mfrc522.MIFARE_Read(block, buffer1, &len);
  if (status != MFRC522::STATUS_OK) {
  //  Serial.print(F("Reading failed: "));
  // Serial.println(mfrc522.GetStatusCodeName(status));
    return;
  }

  //PRINT FIRST NAME
 // for (uint8_t i = 0; i < 16; i++)
 // {
  //  if (buffer1[i] != 32)
  //  {
  //    Serial.write(buffer1[i]);
  //  }
 // }
 // Serial.print(" ");

  //---------------------------------------- GET LAST NAME

  byte buffer2[18];
  block = 1;

  status = mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, 1, &key, &(mfrc522.uid)); //line 834
  if (status != MFRC522::STATUS_OK) {
   // Serial.print(F("Authentication failed: "));
   // Serial.println(mfrc522.GetStatusCodeName(status));
    return;
  }

  status = mfrc522.MIFARE_Read(block, buffer2, &len);
  if (status != MFRC522::STATUS_OK) {
   // Serial.print(F("Reading failed: "));
    //Serial.println(mfrc522.GetStatusCodeName(status));
    return;
  }

  //PRINT LAST NAME
 // for (uint8_t i = 0; i < 16; i++) {
   // Serial.write(buffer2[i] );
//  }


  //----------------------------------------

  //Serial.println(F("\n**End Reading**\n"));

  delay(1000); //change value if you want to read cards faster
 



  mfrc522.PICC_HaltA();
  mfrc522.PCD_StopCrypto1();
}
//*****************************************************************************************//
