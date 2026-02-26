/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dispositivi;

/**
 *
 * @author Chiara
 */
public class Stazione {
        //dobbiamo capire quali classi usano il metodo carica, si chiama interface in java
        // e si crea una java interface
        //possiamo dire che 
        public void ricarica(Ricaricabili obj){
            System.out.println("Ora ricarico l'oggetto");
            obj.carica();       
    }
}
