/*
mettiamo un informazione che indica quale versione della struttura dati è contenuta in quel momento
e quindi verifichiamo se ci sono modifiche e lanciare un'eccezione
*/
package pkg17.esempionestedinner;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class Coda2 implements Iterable<Integer>{
    private int a[];
    private int n;
    private int front, rear;
    private int version;
    
    public Coda2(int size){
        a = new int[size];
        n = 0;
        front = 0;
        rear = 0;
    }
    public void add(int x){
        if(n>=a.length)
            throw new RuntimeException("Coda piena");
        a[rear] = x;
        rear = (rear+1)%a.length;
    }
    public int remove(){
        if(n==0)
            throw new RuntimeException("Coda vuota");
        int x = a[front];
        front = (front+1)%a.length;
        n--;
        
        return x;
    }
    
    /*classe che imlementa l'interfaccia iterator
      si solito avremmo definito la classe iterator a parte, ma ora la definiamo annidata
      come Inner Class
      La classe interna va agganciata alla classe esterna(iterator) perchè ogn
    */
    
    
        public Iterator<Integer> iterator(){
            
            //non possiamo creare un oggetto di tipo CodaIterator, senza agganciarlo a un oggetto di Coda
           
            
        class CodaIterator implements Iterator<Integer>{
        //definisco le strutture dati per scorrere la coda circolare (ho bisogno di un indice, siccome è circolare diventa complicato capire quando ho scorso tutti gli elementi, wuindi aggiundo un int che definisce quanti ne mancano)
        private int i;
        private int remaining;
        private int initialVersion;
        public CodaIterator(){
            i = front; //se l'avessi dichiarato come static , non potrei accedere a front
            remaining = n;
            initialVersion = version;
        }
        @Override
        public boolean hasNext(){
            if(version != initialVersion){
                throw new ConcurrentModificationException();
            }
            return remaining>0;
        }
        @Override
        public Integer next(){
            if ( version != initialVersion)
                throw new ConcurrentModificationException();
            int x = a[i];
            i = (i+1%a.length);
            remaining--;
            return x;
        }
        
    }return new CodaIterator();
    }
   
    
}
