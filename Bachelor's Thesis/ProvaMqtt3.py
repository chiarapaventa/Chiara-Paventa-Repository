import paho.mqtt.client as mqttClient
import time
 
def on_connect(client, userdata, flags, rc):
 
    if rc == 0:
 
        print("Connected to broker")
 
        global Connected                #Use global variable
        Connected = True                #Signal connection 
 
    else:
 
        print("Connection failed")

Connected = False   #global variable for the state of the connection

broker_address= "broker.hivemq.com"
port = 1883
user = "cjbfwcny"
password = "AdTklIBLfDz8"

client = mqttClient.Client("Chiara")               #create new instance
#client.username_pw_set(user, password=password)    #set username and password
client.on_connect= on_connect                      #attach function to callback
client.connect(broker_address, port=port)          #connect to broker

client.loop_start()        #start the loop
 
while Connected != True:    #Wait for connection
    time.sleep(0.1)


try:
    while True:
 
        value = input('RSSI signal:')
        client.publish("it/Chiara/smartkeyring/blesignal",value)
 
except KeyboardInterrupt:
 
    client.disconnect()
    client.loop_stop()
