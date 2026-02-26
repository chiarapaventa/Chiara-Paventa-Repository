/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package esempiolocalanon;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class EsempioLocal {

    
    public static void main(String[] args) {
        Coda c = new Coda(20);
        c.add(10);
        c.add(42);
        c.add(21);
        c.add(33);
        c.add(28);
        Iterator<Integer> it = c.iterator();
        for(Integer a: c){
            System.out.println(a);
        }
    }
    
}
