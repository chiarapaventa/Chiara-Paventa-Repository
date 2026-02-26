
package esempiocollezioni1;
import java.util.*;
/**
 *
 * @author foggia
 */
public class Main {

    
    public static void main(String[] args) {
        Set<String> set1=new HashSet<>();
        set1.add("Primo");
        set1.add("Altro secondo");
        set1.add("Terzo");
        set1.add("Primo");
        
        if (set1.contains("Primo"))
            System.out.println("Primo c'è");
        
        for(String s : set1)
            System.out.println(s);
        
        System.out.println("Il set contiene "+
                set1.size()+" elementi.");
        
        Set<Persona> s2=new TreeSet<>();
        s2.add(new Persona("Pinco", "Pallino"));
        s2.add(new Persona("Mario", "Rossi"));
        s2.add(new Persona("Mario", "Bianchi"));
        s2.add(new Persona("Paolino", "Paperino"));
        s2.add(new Persona("Mario", "Rossi"));
        for(Persona p : s2) 
            System.out.println(p);
        
    }   
    
}
