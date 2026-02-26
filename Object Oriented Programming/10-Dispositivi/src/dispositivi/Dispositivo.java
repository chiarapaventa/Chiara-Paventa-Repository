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
public abstract class Dispositivo {
    private boolean on;
    public void accendi (boolean on){
        this.on=on;
        if(on)
            System.out.println("Acceso");
        else
            System.out.println("Spento");
        
    }
    boolean isAcceso(){
        return on;
    }
}
