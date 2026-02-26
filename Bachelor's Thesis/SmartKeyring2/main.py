# App
import streams
from wireless import wifi
from espressif.esp32net import esp32wifi as wifi_driver
from espressif.esp32ble import esp32ble as bledrv
from zerynthapp import zerynthapp
from servo import servo
from wireless import ble
import math
import pwm

streams.serial()


uid='9K98NgtmSfOE6RHYAVfrLQ'
token='EP9Uh4K9TLSe-qOnwa9Bag'


MyServo = servo.Servo(D23.PWM)
#servo_pwm=D23.PWM
#PERIOD=20000
#angle=0
prev_button=HIGH
buzzer_pin=D22
#ledBlu_pin=D1
#ledVerde_pin=D3
#ledGiallo_pin=D21
RSSI_1M=-52


name='iPhone'
password='zerynthiot'


notifications_enabled = True
connected = False
scan_time=1000


#***************************************************FUNZIONI PER SERVO E BUZZER***********************************************
def angle2pulse(angle):
    return 1000+int(angle*1000/180)
    
# This function will be called either when the
# physical button on the board is clicked or
# when the user of the app clicks the html button
# (triggering the "toggle" Zerynth app method)
def toggle_servo(*args):
    global servo_status, zapp, MyServo
    servo_status = not servo_status
    if servo_status:
        degree=90
    else:
        degree=0
    MyServo.moveToDegree(degree)
    
    #pulse=angle2pulse(angle)
    #pwm.write(servo_pwm, PERIOD, pulse, MICROS)
    
    # Send a Zerynth App event to the app to
    # notify the new light status
    print('Send new servo_status:', servo_status)
    zapp.event({'servo_status': servo_status})
    print('Status sent.')

def sound_buzzer():
    while True:
        if buzzer_status == True:
            digitalWrite(buzzer_pin,HIGH)
            sleep(100)
            digitalWrite(buzzer_pin,LOW)
            sleep(100)
            
            #digitalWrite(ledBlu_pin,HIGH)
            #sleep(100)
            #digitalWrite(ledBlu_pin,LOW)
            #sleep(100)
            
            digitalWrite(buzzer_pin,HIGH)
            sleep(100)
            digitalWrite(buzzer_pin,LOW)
            sleep(100)
            
            #digitalWrite(ledVerde_pin,HIGH)
            #sleep(100)
            #digitalWrite(ledVerde_pin,LOW)
            #sleep(100)
            
            digitalWrite(buzzer_pin,HIGH)
            sleep(100)
            digitalWrite(buzzer_pin,LOW)
            sleep(100)
            
            #digitalWrite(ledGiallo_pin,HIGH)
            #sleep(100)
            #digitalWrite(ledGiallo_pin,LOW)
            #sleep(100)
            
            digitalWrite(buzzer_pin,HIGH)
            sleep(100)
            digitalWrite(buzzer_pin,LOW)
            sleep(1000)
        else:
            sleep(1000)

def toggle_buzzer(*args):
    global buzzer_status, zapp, buzzer_pin
    buzzer_status = not buzzer_status
    print('Send new buzzer_status:', buzzer_status)
    zapp.event({'buzzer_status': buzzer_status})
    print('Status sent.')
    
def query_buzzer_status(*args):
    global buzzer_status
    print('Query_status,returning: ', buzzer_status)
    return buzzer_status
    
def query_servo_status(*args):
    global servo_status
    print('Query status, returning:', servo_status)
    return servo_status
  
    
    
#******************************************************FUNZIONI PER BLE*************************************************
global distance_status
#Initialize BLE
def initialize_ble():
   
    # initialize BLE driver
    bledrv.init()
    # Set GAP name and no security#set the name that is displayed on the smartphone
    ble.gap("ZNotifier",security=(ble.SECURITY_MODE_1,ble.SECURITY_LEVEL_1))
    # add some GAP callbacks
    ble.add_callback(ble.EVT_CONNECTED,connection_cb)
    print("Callback connessione")
    ble.add_callback(ble.EVT_DISCONNECTED,disconnection_cb)
     
    # Create a GATT Service: let's try an Alert Notification Service
    # (here are the specs: https://www.bluetooth.com/specifications/gatt/viewer?attributeXmlFile=org.bluetooth.service.alert_notification.xml)
    s = ble.Service(0x1811)
 
    # The Alert Notification service has multiple characteristics. Let's add them one by one
     
    # Create a GATT Characteristic for counting new alerts.
    # specs: https://www.bluetooth.com/specifications/gatt/viewer?attributeXmlFile=org.bluetooth.characteristic.supported_new_alert_category.xml
    cn = ble.Characteristic(0x2A47, ble.NOTIFY | ble.READ,16,"New Alerts",ble.BYTES)
    # Add the GATT Characteristic to the Service
    s.add_characteristic(cn)
     
 
    # Create anothr GATT Characteristic for enabling/disabling alerts
    # specs: https://www.bluetooth.com/specifications/gatt/viewer?attributeXmlFile=org.bluetooth.characteristic.alert_notification_control_point.xml
    cc = ble.Characteristic(0x2A44, ble.WRITE ,2,"Alerts control",ble.BYTES)
    # Add the GATT Characteristic to the Service
    s.add_characteristic(cc)
    # Add a callback to be notified of changes
    cc.set_callback(value_cb)
     
    # Add the Service. You can create additional services and add them one by one
    ble.add_service(s)
 
    # Setup advertising to 50ms
    ble.advertising(50)
 
    # Start the BLE stack
     
    ble.start()
       
    # Now start advertising
    ble.start_advertising()
    
    



# Let's define some callbacks
def value_cb(status,val):
    # check incoming commands and enable/disable notifications
    global notifications_enabled
    print("Value changed to",val[0],val[1])
    if val[0]==0:
        print("Notifications enabled")
        notifications_enabled = True
    elif val[0]==2:
        notifications_enabled = False
        print("Notifications disabled")
    else:
        print("Notifications unchanged")
         
def connection_cb(address):
    print("Connessione")
    global connected
    print("Connected to",ble.btos(address))
    global ADDR
    ADDR=ble.btos(address)
    connected = True
    ble.add_callback(ble.EVT_SCAN_REPORT,scan_report_cb)
    ble.add_callback(ble.EVT_SCAN_STARTED,scan_start_cb)
    ble.add_callback(ble.EVT_SCAN_STOPPED,scan_stop_cb)
     
     
       #set scanning parameters: every 100ms for 50ms and no duplicates
    ble.scanning(100,50,duplicates=0)
        
       # Now start scanning for 30 seconds
    ble.start_scanning(scan_time)
 
def disconnection_cb(address):
    global connected
    print("Disconnected from",ble.btos(address))
    # let's start advertising again
    ble.start_advertising()
    connected = False
 
def scan_report_cb(data):
    addr=data[4]
    string=ble.btos(addr)
    if string!=ADDR :
        return
    rssi=data[2]
    distance_status=rssi
    
    print("Packet from",ble.btos(addr),"RSSI",rssi)
    print('Send new destance_status:', distance_status)
    zapp.event({'distance_status': distance_status})
    print('Status sent.')
 
def scan_start_cb(data):
    print("Scan started")
 
def scan_stop_cb(data):
    #print("Scan stopped")
    #let's start it up again
    ble.start_scanning(scan_time)
    
def query_distance_status(*args):
    print('Query status, returning:', distance_status)
    return distance_status


#*******************************************************CONNESSIONE WIFI E CONNESSIONE APP************************************
def query_wifi_status(*args):
    global wifi_status
    print("Ora invio wifi_status: " + wifi_status)
    return wifi_status
    

#********************************************************INIZIALIZZO GLI ELEMENTI++++++++++***********************************
# A 9 seconds delay for easing the connection
# of the console during debugging
for i in range(3):
    sleep(3000)
    print('...', 3-i)
    
# Initialize elements
servo_status=False
buzzer_status=False
wifi_status=False

pinMode(buzzer_pin, OUTPUT)
#pinMode(ledBlu_pin, OUTPUT)
#pinMode(ledVerde_pin, OUTPUT)
#pinMode(ledGiallo_pin, OUTPUT)
#pinMode(D23, OUTPUT)



#******************************************************INIZIO****************************************************************
print('Start')
try:
    
    thread(initialize_ble)
    thread(sound_buzzer)
    #**************************************************CONNESSIONE WIFI E CONNESSIONE APP************************************
    wifi_driver.auto_init()
    sleep(3000)
    
    for retry in range(20): 
        print('Connecting...')
        try:
            wifi.link(name, wifi.WIFI_WPA2, password)
            print('Connected to wifi')
            break
        except IOError:
            sleep(1000)
    sleep(1000)
    print('Connecting to Zerynth App...')
    zapp = zerynthapp.ZerynthApp(uid, token)
    print('zapp object created!')
    wifi_status=True
    print('Send new wifi_status:', wifi_status)
    
    # Associate the 'toggle' app method to the toggle_light function 
    zapp.on('toggle', toggle_servo)
    zapp.on('query', query_servo_status)
    
    zapp.on('query2', query_distance_status)
    zapp.on('initBle', initialize_ble)
    
    zapp.on('ring',toggle_buzzer)
    zapp.on('query3',query_buzzer_status)
    
    zapp.on('query4', query_wifi_status)
    
    print('Start the app instance...')
    zapp.run()
    print('Instance started.')
    

except Exception as e:
    print(e)
    
    
# loop forever
while True:
    print("Finito .")
     
    sleep(5000)

