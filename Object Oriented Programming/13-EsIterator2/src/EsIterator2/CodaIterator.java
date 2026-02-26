/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package EsIterator2;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class CodaIterator implements Iterator<Integer>{
    private int coda[];
    private int n;
    private int remaining;
    private int i;
    public CodaIterator(int[] a, int n){
        coda = a;
        remaining = n;
        i = 0;
    }
    public Integer next(){
        if(remaining == 0)
            throw new ArrayIndexOutOfBoundsException();
        else
            remaining--;
            return coda[i++];      
    }
    public boolean hasNext(){
        return remaining != 0;
    }
}
