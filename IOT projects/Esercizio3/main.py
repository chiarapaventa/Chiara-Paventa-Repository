# Esercizio3
# Created at 2019-03-19 09:04:20.778193
#NON E' COMPLETO!!

import streams
streams.serial()
led = D23
pinMode(led, OUTPUT)
button = BTN0
pinMode(button, INPUT)
last_change = 0
previous_value = LOW
while True
   value = 1 - digitalRead(button)
   if value == HIGH and previous_value == LOW
      pinToggle (led)
   previous_value = value 
   last_change = 0
   sleep(10)
   