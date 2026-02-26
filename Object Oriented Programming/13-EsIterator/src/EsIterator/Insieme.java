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
public class Insieme{
    private String a[];
    private int n;
    public Insieme(){
        a = new String[100];
        n = 0;
    }
    public void aggiungi(String s)throws Exception{
        if(n < 100){
            a[n] = s;
            n++;
        }else
            throw new Exception();
    }
    
    public Iterator<String> iterator(){
        return new Iteratore(a, n);
    }
}
