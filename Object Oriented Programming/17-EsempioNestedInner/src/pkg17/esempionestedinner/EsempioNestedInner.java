/*
Supponiamo di voler realizzare una coda circolare con un iteratore
*/
package pkg17.esempionestedinner;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class EsempioNestedInner {

    
    public static void main(String[] args) {
        Coda c = new Coda(20);
        c.add(10);
        c.add(42);
        c.add(21);
        c.add(33);
        c.add(28);
        
        //Anzichè usare un forEach usare direttamente un iteratore
        Iterator<Integer> it = c.iterator();
        c.remove();
        c.remove();
        c.remove();
        while (it.hasNext()){
            System.out.println(it.hasNext());
            /*stampa anche gli elementi che abbiamo eliminato dalla coda
            anche s eli abbiamo eliminati, ma l'iteratore non è stato aggiornato 
            immaginimao l'iteratore in una lista concatenata, potrebbero sorgere problemi di
            REGOLA: NON SI PUO' MODIFICARE UNA STRUTTURA DATI QUANDO SI STA ITERANDO SU DI ESSA*/
            
            /*for ( int x : c){  
            System.out.println(x);
            }*/
         }
        
        
        /*Gli iteratori possono lanciare 
        Fail fast iterator: è un iteratore che cerca dil accorgersi se il proggrammatore da fatto l'errore
        di modificare la struttura dati mentre si stava iterando, con 
        */
        
        
    }
}
