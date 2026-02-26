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
public class Cellualre extends Dispositivo implements Ricaricabili{
    public void telefona(String numero){
        System.out.println("Sto chiamando"+numero);
    }
    public void carica(){
        System.out.println("Sto caricando");
    }
}
