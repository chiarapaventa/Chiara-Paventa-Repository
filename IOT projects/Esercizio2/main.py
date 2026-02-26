# Esercizio2
# Created at 2019-03-19 08:50:30.673570
#Modify the previous program so that when the button is pressed, the led changes its state , and reamins in its state until
#the button is pressed again 
#HINT: to decide what to do, you need to know both the current state of the button and the previous state



import streams
streams.serial()
led = D23
pinMode(led, OUTPUT)
button = BTN0
pinMode(button, INPUT)


previous_value = LOW
while True
   value = 1 - digitalRead(button)
   if value == HIGH and previous_value == LOW
      pinToggle (led)
   previous_value = value 
   sleep(10)
   
