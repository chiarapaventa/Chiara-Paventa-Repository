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
public class ListComparator implements Comparator<String>{
    @Override
    public int compare(String a, String b){
        return a.compareTo(b);
    }
}
