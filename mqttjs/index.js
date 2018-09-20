const mqtt = require('mqtt') 

const client = mqtt.connect('mqtt://127.0.0.1') 

client.on('connect', () => {    
     client.subscribe('#',{qos:1}) 
})
client.on('message',function(topic,message){    

console.log('Mensagem :',message.toString());        

console.log('Topico :',topic.toString());



var sendDATA=message.toString()+","+topic.toString();
var http=require('http');
var querystring = require('querystring');    
const options = {  
      hostname: '127.0.0.1',  
      port: 80,  
      path: '/api/mqttsub',  
      method: 'POST',  
      headers: { 
         'Content-Type': 'application/x-www-form-urlencoded',       'Content-Length': Buffer.byteLength(sendDATA)
      }
}; 

const req = http.request(options, (res) => {  
    console.log(`STATUS: ${res.statusCode}`);  
    console.log(`HEADERS: ${JSON.stringify(res.headers)}`);
    res.setEncoding('utf8');  
    res.on('data', (chunk) => {    
       console.log(`BODY: ${chunk}`);  
    });  
    res.on('end', () => {    
    console.log('Sem mais dados');  
    });
}); 
req.on('error', (e) => {  
console.error(`erro: ${e.message}`);
}); 
req.write(sendDATA);
req.end();    

});
