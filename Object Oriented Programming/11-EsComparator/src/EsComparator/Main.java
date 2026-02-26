/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package EsComparator;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class Main {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        List<String> list = new LinkedList<>();
        list.add("ghi");
        list.add("def");
        list.add("abc");
        
        list.sort(new ListComparator());
        for(String s : list)
            System.out.println(s);
    }
    
}
