# SmartKeyring1
# Created at 2019-12-18 12:59:26.374544

import streams
from wireless import wifi
from espressif.esp32net import esp32wifi as wifi_driver
from espressif.esp32ble import esp32ble as bledrv
from mqtt import mqtt
from wireless import ble
import math

streams.serial()

name = 'iPhone'
password_wifi = 'zerynthiot'

TOPIC='it/Chiara/smartkeyring/blesignal'
clientID = 'Chiara'
broker = "broker.hivemq.com"
port = 1883

notifications_enabled = True
connected = False
scan_time = 1000

RSSI_1M = -52
i = 0
array = [-70, -70, -70, -70, -70, -70, -70, -70, -80, -80, -90, -100, -100, -100, -100, -90,
         -80, -70, -60, -50, -40, -30, -25, -23, -21, -20, -18, -15, -12, -10, -9, -8, -7, -5,
         -20, -30, -40, -50, -60, -70, -80]

sleep(3000)
   

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
 
def scan_start_cb(data):
    print("Scan started")
 
def scan_stop_cb(data):
    #print("Scan stopped")
    #let's start it up again
    ble.start_scanning(scan_time)
    
def query_distance_status(*args):
    #print('Query status, returning:', distance_status)
    return distance_status
    
wifi_status=False    
    






   
    
print('Start')
try:
    
    wifi_driver.auto_init()
    sleep(3000)
    
    for retry in range(20): 
        print('Connecting...')
        try:
            wifi.link(name, wifi.WIFI_WPA2, password_wifi)
            print('Connected to wifi')
            break
        except IOError:
            sleep(1000)
    sleep(1000)
    
    print("Sto generando il client")
    my_client = mqtt.Client(clientID,True)
    print("Connesso al client")
    my_client.set_will(TOPIC, 'Disconnected!', 0, False)
    for retry in range(10):
        print("Sto connettendo al broker")
        my_client.connect(broker, port)
        print("Connesso al broker")
    my_client.loop()
    
    
    sleep(2000)
    print("CONNESSO A INTERNET E AL BROKER: Adesso lancio il thread")
    sleep(10000)
    
    thread(initialize_ble)

    while True:
        #message = str(initialize_ble)
        message = str(array[i])
        if i < 40: 
            i = i + 1
        else:
            i = 0
        my_client.publish(TOPIC, message)
        sleep(1000)
    
except Exception as e:
    print('Exception:', e)
    sleep(10000)
    
    
    
    
# loop forever
while True:
    print(".")
     
    sleep(5000)