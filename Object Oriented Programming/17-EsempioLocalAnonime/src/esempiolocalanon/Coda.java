/*Un iteratore che ci permette di iterare ogni k elementi*/
package esempiolocalanon;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class Coda implements Iterable<Integer>{
    private int a[];
    private int n;
    private int front, rear;
    private int version;
    
    public Coda(int size){
        a = new int[size];
        n = 0;
        front = 0;
        rear = 0;
        version=0;//+
    }
    
    public void add(int x){
        if(n>=a.length)
            throw new RuntimeException("Coda piena");
        a[rear] = x;
        rear = (rear+1)%a.length;
        n++;//+
        version++;//
    }
    public int remove(){
        if(n==0)
            throw new RuntimeException("Coda vuota");
        int x = a[front];
        front = (front+1)%a.length;
        n--;
        version++;
        return x;
    }

    //possiamo usare k all'interno della classe CodaIterator contenuta nel metodo skippingIterator se lo dichiariamo final
    public Iterator<Integer> iterator(){

        return new Iterator<Integer>(){
        private int k=2;
        private int i=front;
        private int remaining=n;
        private int initialVersion = version;
        
//        public CodaIterator(){
//            i = front; //se l'avessi dichiarato come static , non potrei accedere a front
//            remaining = n;
//        }
        @Override
        public boolean hasNext(){
            if(version!=initialVersion)
                throw new ConcurrentModificationException();
            return remaining>0;
            
        }
        @Override
        public Integer next(){
                if(version!=initialVersion)
                throw new ConcurrentModificationException();
            int x = a[i];//accediamo a k perchè l'abbiamo dichiarata final
            i = (i+k)%a.length;
            remaining-=k;
            return x;
        }
        
      };
        
   
    }

}
