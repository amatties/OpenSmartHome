

void setup() {
  
  Serial.begin(9600);
  
  pinMode(9, OUTPUT);
  pinMode(8, OUTPUT);
  pinMode(7, OUTPUT);
  pinMode(6, OUTPUT);
  pinMode(5, OUTPUT);
  pinMode(4, OUTPUT);
  pinMode(3, OUTPUT);
 //digitalWrite(9, HIGH);
  //digitalWrite(8, HIGH);
  //digitalWrite(7, HIGH);
  //digitalWrite(6, HIGH);
  //digitalWrite(5, HIGH);
  //digitalWrite(4, HIGH);
  //digitalWrite(3, HIGH)
    
  
}

void loop() {
  String in;
  int inn;
  int pin;
  int status;

 if (Serial.available()) {

      in = Serial.readString();


    status = in.substring(0,1).toInt();
    pin = in.substring(1).toInt();
    


    
   if(status==2){
   // Serial.println("desligado");
      digitalWrite(pin, LOW);
    }if(status==1){
    digitalWrite(pin, HIGH);
   // Serial.println("ligado");
    }
   // Serial.println(pin);
 }
   
}


