/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Es;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class EsProducerConsumer {
    private LinkedList<String> list;
    
    public EsProducerConsumer(){
        list = new LinkedList<>();
    }
    
    public synchronized String reader(){
        if(list.isEmpty()){
            try{
              wait();  
            }catch(InterruptedException e){}
        }
        String s = list.remove(0);
        return s;
    }
    public synchronized void writer(String s){
        list.add(s);
        notifyAll();
    }
}
