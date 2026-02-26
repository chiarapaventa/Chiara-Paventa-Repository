
package esempiocollezioni1;
import java.util.*;
/**
 *
 * @author foggia
 */
public class Main {

    
    public static void main(String[] args) {
        List<String> lista1=new ArrayList<>();
        lista1.add("Primo");
        lista1.add("Secondo");
        lista1.add("Terzo");
        
        System.out.println(lista1.get(0));
        System.out.println(lista1.get(1));
        System.out.println(lista1.get(2));
        
        lista1.add(1, "Primo bis");
        lista1.remove("Secondo");
        
        if (lista1.contains("Primo"))
            System.out.println("Primo c'è");
        if (lista1.contains("Secondo"))
            System.out.println("Secondo c'è");
        for(String s : lista1)
            System.out.println(s);
        
        System.out.println("La lista contiene "+
                lista1.size()+" elementi.");
    }
    
}
