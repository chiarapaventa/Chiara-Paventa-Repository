# Esercizio5
# Created at 2019-03-28 10:42:28.344041
#THREAD: SONO SUPPORTATI DA PYTHON, SONO UTILI QUANDO L'APPLICAZIONE DEVE FARE QUALCOSA MENTRE ASPETTA UN MESSAGGIO DALLA RETE
#-> Modifichiamo l'esercizio4     ->introduciamo le classi in python
#Implementare un programma che legge periodicamente lo stato di un bottone e lo invia al from servo import servo

import streams
from espressif.esp32net import esp32wifi as wifi_driver
from wireless from espressif.esp32net import esp32wifi
import socket 
import threading

#Creiamo una classe e ci mettiamo init_wifi e init_connection
class Connection
   

    def __init__(self)
        self.buffer = []
        self.lock[]#manca qualcosa
        
        
        
        
        
    def init_wifi (self, nome, password)    #definizione funzione init_wifi , passiamo a questa funzione nome e password
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
    def init_connection(self, address, port)     
        s = socket.socket()
        while True
            print("Attempting connecting socket")
          try:
              s.connect((address, port))
              print("Socket connected")
              self.s = s
              return s
          except Exception:
              print ("Socket connection failed")
              sleep(1000)
              
    def add(self, value)
        self.lock.acquire()
        self.buffer.append(value)
        self.lock.release()
        
        
        
    #ora ci serve un metodo per prendere il valore dal buffer
    def take(self)
        self.lock.acquire()
        if len(self.buffer == 0)#se il bufffer è vuoto
           value = None
        else
           value 0 self.buffer[0]
           del self.buffer[0]
        self.lock.release()
        return value
        
        
    def run(self)
        self.init_wifi(ADDRESS, PASSWORD)
        self.init_connection(SERVER, PORT)
        while True
           value = self.take()
           if value = None
            try  
                 self.s.serial(srt(value))
            except Exception
                print("Connection lost. Reconnecting... ")
                self.init_connection(SERVER, PORT)
        sleep(500)        
        
        
        
        
        
        
        
        
        

BUTTON_PIN = BTN0

streams.serial()

sleep(4000)

pinMode(BUTTON_PIN, INPUT)

connection = Connection()
thread(connection.run)


while True
    t = digitalRead(BUTTON_PIN)
    connection.add(b)
    sleep(1000)
       
       
       
       
       
       
       
       