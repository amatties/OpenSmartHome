

#include "EmonLib.h"
#include <EEPROM.h>              
EnergyMonitor emon1;    
unsigned long lastmillis;  
float accpower = 0;  
float accpowerout; 
int eprom_addr = 0;
  

void setup()
{  
 // EEPROM.begin(1);
  Serial.begin(9600);


  accpowerout = EEPROM.read(eprom_addr);
  
  
  emon1.voltage(0, 234.26, 1.7);  
  emon1.current(1, 111.1);  
  lastmillis=millis();      
}

void loop()
{
  emon1.calcVI(20,2000);         
  
  
  float realPower       = emon1.realPower;       
  float apparentPower   = emon1.apparentPower;    
  float powerFActor     = emon1.powerFactor;      
  float supplyVoltage   = emon1.Vrms;            
  float Irms            = emon1.Irms;             
  delay(1000);
 accpower += (((millis()-lastmillis) * emon1.realPower) / 3600000000);
 lastmillis=millis();
 accpowerout = accpowerout + accpower;
 EEPROM.write(eprom_addr, accpowerout);

 if (isnan(supplyVoltage) || isnan(Irms)) {
    
    return;
 }else{
  Serial.print(String(supplyVoltage)+"-Tensao");
  delay(20000);
  Serial.print(String(Irms)+"-Corrente");
  delay(20000);
  Serial.print(String(realPower)+"-Watts");
  delay(20000);
  Serial.print(String(accpowerout)+"-KWh");
  delay(20000);
 }

   
}
