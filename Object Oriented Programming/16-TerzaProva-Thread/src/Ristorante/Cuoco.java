/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Ristorante;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class Cuoco implements Runnable{
    private Comande comande;
    public Cuoco (Comande comande){
        this.comande = comande;
    }
    @Override
    public void run(){
        Random rand=new Random();
        while(true){
            Ordinazione ord = comande.consegnaOrdinazione();
            try{
                Thread.sleep(rand.nextInt(5000)+5000);
            }catch(InterruptedException e){
                System.out.println("Piatto pronto: "+ord.toString());
            }
        }
        
    }
}
