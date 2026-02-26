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
public class AspirapolverePortatile extends Aspirapolvere implements Ricaricabili {
    //implementa l'interfaccia Ricaricabili, cosi come cellulare
    public void carica(){
        System.out.println("Sto caricando");
    }
}
