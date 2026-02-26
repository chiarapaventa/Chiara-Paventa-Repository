/*
Comande(String filename, Boolean leggiBackup)
+ <<synchronized>> aggiungiOrdinazione(Ordinazione ordinazione) : void
+ <<synchronized>> consegnaOrdinazione() : Ordinazione
+ <<synchronized>> salvaOrdinazioni() : void

 */
package Ristorante;
import java.io.*;
import java.util.*;
/**
 *
 * @author Chiara
 */
//Contiene una coda FIFO di ordinazioni (coda)
public class Comande {
    private String fileName;
    private Queue<Ordinazione> o;
    
    //in questo caso il costruttore non deve lanciare una IOException 
    public Comande(String fileName, Boolean leggiBackup){
        this.fileName = fileName;
        if(leggiBackup)
            caricaOrdinazioni();
        else
            o = new LinkedList<>();
    }
    
    //effettuiamo operazioni di io, che possono lanciare eccezioni
    private void caricaOrdinazioni(){
        try{
           //dobbiamo salvare un oggetto salvato da serializzazione
           InputStream in = new FileInputStream(fileName);
           ObjectInputStream ois = new ObjectInputStream(in);
           //la lista è un oggetto, è serializzabile, quindi carichiamo la lista
           o = (Queue<Ordinazione>)ois.readObject();
           ois.close();
        }catch(IOException e){
           o = new LinkedList<>();
        }catch (ClassNotFoundException e){//la lancio readObject()
            //errore più serio, poichè stiamo caricando dove stanno dati di altri programmi
           throw new RuntimeException(e);        
        }
    }
     
    //aggiunge ordinazione alla coda
    //possono esserci altri thread che aspettano, per cui
    public synchronized void aggiungiOrdinazione(Ordinazione ordinazione){
        o.add(ordinazione);
        notifyAll();
    }
    
    //lofacciamo synchronized
    //dobbiamo aspettare che la coda sia vuota, con un while
    public synchronized Ordinazione consegnaOrdinazione(){
    while(o.isEmpty()){
        try{
            wait();
        }catch(InterruptedException e){         
        }}
    //estraiamo un elemento dalla coda e lo resttituiamo
    return o.remove();
    } 
   
    
public synchronized void salvaOrdinazioni(){
    while(o.isEmpty()){
        try{
            wait();
        }catch(InterruptedException e){         
        }
    }
    
    try{
        OutputStream out= new FileOutputStream(fileName);
        ObjectOutputStream oos = new ObjectOutputStream(out);
        oos.writeObject(o); 
        oos.close();
    }catch(IOException e){
        throw new RuntimeException(e);
    }
            
}
}







