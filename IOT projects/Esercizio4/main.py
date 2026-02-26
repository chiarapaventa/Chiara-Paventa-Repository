# Esercizio4
# Created at 2019-03-28 10:05:08.564911

import streams
from espressif.esp32net import esp32wifi as wifi_driver
from wireless from espressif.esp32net import esp32wifi
import socket 

                                        #definizione funzione init_wifi
def init_wifi (nome, password)          #passiamo a questa funzione nome e password
    wifi_driver..auto.init()            #inizializziamo il driver
    
    t = 1
    while True                          #
          print ("Attempting connection to wi fi ", t)  
          try:
              #catturiamo l'eccezione 
              wifi.link(nome, wifi.MPA2, password)
              print(" Connected to wifi")
          except Exception:
              print("Link failed")
              sleep(500)
              t = 1
def init_connection(address, port)     
    s = socket.socket()
    while True
          print("Attempting connecting socket")
          try:
              s.connect((address, port))
              print("Socket connected")
              return s
          except Exception:
              print ("Socket connection failed")
              sleep(1000)
    
    
BUTTON_PIN = BTN0
ADDRESS =                                    #indirizzo dispositivo -> phone
PASSWORD =                                    
SERVER =                                     #indirizzo del pc quando è collegato alla rete ->172.20.20.2 -> vedere terminale python server
PORT =                                       #4300

streams.serial()


init_wifi(ADDRESS, PASSWORD)
t = init_connection()
pinMode(BUTTON_PIN, INPUT)

while True
   t = digitalRead(BUTTON_PIN)
   try
       s.sendall(str(b))
   except Exception:
       print("Send failed")
       s = init_connection()
       sleep(1000)
