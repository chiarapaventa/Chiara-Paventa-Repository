/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package EsIterator;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class Iteratore implements Iterator<String>{
    private String b[];
    private int n;
    private int remaining;
    private int i;
    
    public Iteratore(String[] a, int n){
        b = a;
        this.n = n;
        remaining = 0;
        i = 0;
    }
    
    public boolean hasNext(){
        return remaining!=0;
    }
    public String next(){
        if(remaining != 0){
            String s = b[i++];
            remaining--;
            return s;
        }else 
            throw new IndexOutOfBoundsException();       
    }
}
