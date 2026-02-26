# SmartKeyring3
# Created at 2019-12-21 09:07:44.655581

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
scan_time=1000

RSSI_1M=-52
i = 0
array = [100, 20, 60, 80, 90, 500, 90, 30, 80, 10, 60]
#btn_pin=BTN0
#pinMode(btn_pin, INPUT)

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
    #print('Send new destance_status:', distance_status)
    #zapp.event({'distance_status': distance_status})
    #print('Status sent.')
 
def scan_start_cb(data):
    print("Scan started")
 
def scan_stop_cb(data):
    #print("Scan stopped")
    #let's start it up again
    ble.start_scanning(scan_time)
    
def query_distance_status(*args):
    #print('Query status, returning:', distance_status)
    return distance_status
    
#wifi_status=False    
    






print('Start')
try:
    thread(initialize_ble)
    
except Exception as e:
    print('Exception:', e)
    sleep(10000)
    
    
    
    
# loop forever
while True:
    print("Ciao ho finito .")
     
    sleep(5000)