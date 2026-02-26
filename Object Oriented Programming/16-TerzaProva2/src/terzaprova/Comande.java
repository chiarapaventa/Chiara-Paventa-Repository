/*
Le ordinazioni sono gestite secondo una politica First In First Out (FIFO), 
quindi verranno servite dal cuoco del ristorante nello stesso ordine in cui vengono create. 
Il costruttore della classe Comande riceve due parametri. Il primo (String) 
indica il nome del file da utilizzare per salvare e/o caricare il backup. Il 
secondo (boolean), se true, indica che l’insieme iniziale di ordinazioni deve 
essere letto da file, altrimenti deve essere creata una lista vuota.
Il metodo aggiungiOrdinazione dovrà gestire l’aggiunta dell’ordinazione alla coda delle ordinazioni. 
Il metodo consegnaOrdinazione dovrà gestire l’accesso alla coda di ordinazioni e 
restituire la prossima Ordinazione da servire, se c’è almeno una Ordinazione in coda. 
Se non ci sono ordinazioni in coda, il metodo deve rilasciare il mutex e restare in attesa che venga aggiunta un’ordinazione alla coda.
Il metodo salvaOrdinazioni  si occupa di salvare l’attuale insieme di ordinazioni su 
file attraverso il sistema di serializzazione degli oggetti di Java. Dovranno essere
implementate opportunamente le interfacce per la gestione del meccanismo di serializzazione.
Il salvataggio avviene solo se ci sono ordinazioni in coda altrimenti si deve restare 
in attesa che venga aggiunta un’ordinazione alla coda.
<<synchronized>> aggiungiOrdinazione(Ordinazione ordinazione) : void
+ <<synchronized>> consegnaOrdinazione() : Ordinazione
+ <<synchronized>> salvaOrdinazioni() : void
 */
package terzaprova;
import java.util.*;
import java.io.*;
/**
 *
 * @author Chiara
 */
public class Comande {
    private Queue<Ordinazione> o;
    private String filename;
    private boolean leggiBackup;
    public Comande (String filename, Boolean leggiBackup){
        this.filename = filename;
        if(leggiBackup)
           caricaOrdinazioni();
        else 
           o = new LinkedList<>();           
    }
    public void caricaOrdinazioni(){
        try{
           InputStream in = new FileInputStream(filename);
           ObjectInputStream ois = new ObjectInputStream(in);
           o = (Queue<Ordinazione>)ois.readObject();
           ois.close();
        }catch(IOException e){
           o = new LinkedList<>();
        }catch(ClassNotFoundException e){
           throw new RuntimeException(e);}
    }



    public synchronized void aggiungiOrdinazione(Ordinazione ord){
        o.add(ord);
        notifyAll();
    }
    public synchronized Ordinazione consegnaOrdinazione(){
        while(o.isEmpty())
            try{
            wait();
            }catch(InterruptedException e){
            }
        return o.remove();
    }
    public synchronized void salvaOrdinazioni(){
        
    }
}
