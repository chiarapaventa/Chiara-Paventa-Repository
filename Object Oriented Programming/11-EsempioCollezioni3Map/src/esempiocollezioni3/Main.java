
package esempiocollezioni3;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class Main {

    public static void main(String[] args) {
       //facciamo una mappa con chiave una stringa che punta alla parola
       //realizziamo un programma che legga delle parole, finchè non legge fine
       //il programma deve contare quante volte abbiamo incontrato la parola prima di leggere fine 
       //tipo chiave string, valore associato integer
       //possiamo usare sia la hash map che tree map(mantiene le chiavi ordinate)
       Map<String, Integer> parole=new TreeMap<>(new ReverseComparator());
       
       //ci serve un oggetto di tipo Scanner
       Scanner scan=new Scanner(System.in);
      
       //ora deve leggere parole finchè non leggiamo fine
       //e convertiamo la stringa in maiuscolo
       String p=scan.next().toUpperCase();
      
       while (! p.equals ("fine")){
           //cercare la parola all'interno della tabella
           if (!parole.containsKey(p)){
               parole.put(p, 1);
           }
           else{
               //get restituisce un valore di tipo integer, che è NULL se la chiave non è stata strovata
               //se get non restituisce NULL possiamo inserire la parola nella tabella
               int count=parole.get(p);
               parole.put(p, count+1);
               p=scan.next().toUpperCase();
           }
       }
        /*possiamo anche fare così
            while (! p.equals ("fine")){
            Integer count=parole.get(p);
                if (count==1)
                       parole.put(p, 1);
                else 
                       parole.put(p, count+1);*/
   
        //adesso la mia mappa parole, contiene le parole associate alle volte in cui le ho incontrate
    for (String k : parole.keySet()){
        //per ogni chiave stampo il numero di volte in cui ho incontrato la parola
        System.out.println(k+" --> "+parole.get(k));
    }
   
   
    }
    
}

/* PROVIAMO CON TREE MAP
    RIGA 16     Map<String, Integer> parole=new TreeMap<>();
    AVREMO LE PAROLE IN ORDINE ALFABETICO
*/

/* SE VOLESSI LE PAROLE IN ORDINE ALFABETICO INVERSO
   devo creare un comparator
*/
