
package esempiocollezioni3;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class ReverseComparator implements Comparator<String> {
    @Override
    public int compare (String a, String b){
        return b.compareTo(a);
        //oppure - a.compareTo(b);
    }
}
