/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Ristorante;

/**
 *
 * @author Chiara
 */
public class BackupAutomatico implements Runnable {
    private Comande comande;
    
    public BackupAutomatico(Comande comande){
        this.comande = comande;
    }
    
    @Override
    public void run(){
        while(true){
            comande.salvaOrdinazioni();
            System.out.println("BACKUP EFFETTUATO");
            //aspetta 20 sec
            try{
                Thread.sleep(20000);       
            }  catch(InterruptedException e){
            }          
        }
    }
}
