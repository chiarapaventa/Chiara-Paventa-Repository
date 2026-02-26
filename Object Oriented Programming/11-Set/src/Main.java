/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
        Set<String> set = new HashSet<>();
        set.add("b");
        set.add("c");
        set.add("a");
        set.add("z");
        
        for(String s : set)
            System.out.println(s);
    }
    
}
