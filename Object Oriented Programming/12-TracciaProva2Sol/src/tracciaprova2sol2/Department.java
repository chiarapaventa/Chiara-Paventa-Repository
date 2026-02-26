
package tracciaprova2sol2;
import java.util.Comparator;
import java.util.LinkedList;
/**
 *
 * @author Chiara
 */
public class Department extends LinkedList<Person> implements Sortable,Filterable{

    public void sort(){
        sort(Comparator.reverseOrder());
    }
    
    @Override
    public Department filter(PersonFilter f) {
        Department department = new Department();
        for (Person p : this) {
            if (f.checkPerson(p))
                department.add(p);
        }
        return department;
    }

    @Override
    public String toString() {
        String ret = "";
        for (Person a : this) {
            ret += a + "\n";
        }
        return ret;
    }
}
