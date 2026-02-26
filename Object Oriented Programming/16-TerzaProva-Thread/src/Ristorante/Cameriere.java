/*
deve aggiungere periodicamente nuove ordinazioni
Cameriere implements Runnable
+ Cameriere(String nome, Comande comande)
+ run()

 */
package Ristorante;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class Cameriere implements Runnable {
    private String nome;
    private Comande comande;
    
    public Cameriere(String nome, Comande comande){
        this.nome = nome;
        this.comande = comande;
    }
    @Override
    public void run(){                                //deve periodicamente generare delle ordinazioni e aggiungerle alle comande
        Menu menu = new Menu();
        Random rand = new Random();
        while(true){                                  // generiamo l'ordinazione
           String piatto = menu.getPiatto();          //generiamo il piatto
           int tavolo = rand.nextInt(5)+1;
           int quantita = rand.nextInt(4)+1;
           Ordinazione o = new Ordinazione(piatto, tavolo, quantita);
           comande.aggiungiOrdinazione(o);
           try{
               Thread.sleep(5000);
           }catch(InterruptedException e){
               comande.aggiungiOrdinazione(o);
               System.out.println("Ordinazione presa da: "+nome+"Piatto: ");
           }
        }
    }
}
