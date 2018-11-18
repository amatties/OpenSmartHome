

#include "EmonLib.h"            
EnergyMonitor emon1;             

void setup()
{  
  Serial.begin(9600);
  
  emon1.voltage(0, 234.26, 1.7);  
  emon1.current(1, 111.1);       
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
 if (isnan(supplyVoltage) || isnan(Irms)) {
    
    return;
 }else{
  Serial.print(String(supplyVoltage)+"-Tensao");
  delay(2000);
  Serial.print(String(Irms)+"-Corrente");
  delay(2000);
 }

   
}
