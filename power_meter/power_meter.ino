

int voltage;
int current;


void setup() {
  Serial.begin(9600);                                          

}


void loop() {


voltage = analogRead(A0);
current = analogRead(A1);


Serial.println(voltage);
delay(50000);
Serial.println(current);
  
 
}

