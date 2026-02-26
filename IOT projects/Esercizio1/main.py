# Esercizio1
# Created at 2019-03-19 08:17:53.566177

import streams
streams.serial()
led = D23
pinMode(led, OUTPUT)
button = BTN0
pinMode(button, INPUT)

while True
   value = 1 - digitalRead(button)
   digitalWrite(led, value)
   sleep(10)
   

