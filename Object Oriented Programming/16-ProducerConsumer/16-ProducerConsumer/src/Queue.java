
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
import java.util.*;
/**
 *
 * @author foggia
 */
public class Queue<T> {
    private LinkedList<T> list;
    
    public Queue() {
        list=new LinkedList<>();
    }
    
    public synchronized void add(T elem) {
        list.add(elem);
        notifyAll();
    }
    
    public synchronized T remove() {
        while (list.isEmpty())
            try {
                wait();
            } catch (InterruptedException e) { }
        
        return list.remove(0);
    }
            
        
            
        
        
    
}
