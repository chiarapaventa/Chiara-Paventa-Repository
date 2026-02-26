/*
Supponiamo di avere una lista di interi
E bisogna ordinarli in ordine decrescente;
 */
package pkg17.classiannidate;

/**
 *
 * @author Chiara
 */
public class ClassiAnnidate {

    public static void main(String[] args) {
        Elenco e = new Elenco();
        e.add(20);
        e.add(42);
        e.add(21);
        System.out.println(e);
        e.sort();
        System.out.println(e);
    }
    
}
