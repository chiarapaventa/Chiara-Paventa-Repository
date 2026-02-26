/*
Cameriere implements Runnable
+ Cameriere(String nome, Comande comande)
+ run()
Nel metodo run(), la classe Cameriere svolge le seguenti operazioni:
-Per semplicità di svolgimento non è richiesta l’interazione con l’utente ma la creazione 
automatica di un’Ordinazione generando randomicamente il numero del tavolo (intero compreso tra 1 e 5) 
e la quantità (intero compreso tra 1 e 4) e selezionando un piatto dal menu utilizzando 
il metodo getPiatto della classe Menu allegata alla traccia.
-attesa di un tempo random compreso tra 5 e 10 secondi
-aggiunta dell’ordinazione alla lista
-stampa a video del messaggio “Ordinazione presa da [nome cameriere]: [dettaglio ordinazione attraverso il metodo toString della classe ordinazione]”, ad esempio “Ordinazione presa da Pippo: Piatto: Tiramisu – Tavolo: 1 – Quantità: 2”.
 */
package terzaprova;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class Cameriere implements Runnable{
    private String nome;
    private Comande comande;
    public Cameriere(String nome, Comande comande){
        this.nome = nome;
        this.comande = comande;
    }
    public void run(){
        Menu menu = new Menu();
        Random rand = new Random();
        while(true){
            String piatto = menu.getPiatto();
            int tavolo = rand.nextInt(5)+1;
            int quantita = rand.nextInt(4)+1;
            Ordinazione o = new Ordinazione(piatto, tavolo, quantita);
            try{
                wait(5000);
            }catch(InterruptedException e){
            comande.aggiungiOrdinazione(o);
            System.out.println("Ordinazione presa da: "+nome+o.toString());
            }
        }
    }
}
