package pkg17.classiannidate;
import java.util.*;
/**
 *
 * @author Chiara
 */
public class Elenco {
    private List<Integer> list;
    
    public Elenco(){
        list = new LinkedList<>();
    }
    public void add(int x){
        list.add(x);
    }
    
    /*Metodo per ordinare la lista in ordine decrescente
    Definire una classe comparator che implementa l'interfaccia comparator e nel metodo compare()
    realizzi la nostra logica di ordinamento 
    Al posto di creare una classe a sè stante, possiamo crearne una all'interno di elenco
    In questo caso è più appropriata la static perchè in questo caso non serve che gli oggetti della
    classe interna siano agganciati a quelli della classe interna
    Per cui possiamo usare una static Nested Class
    */
    
    /*Livello di visibilità migliore private, perchè non ci serve che sia accessibile
    dobbiamo definire un metodo compare() che prende in ingresso due Integer
    In generale la classe annidata può vedere le parti private della esterna
    ma non è vero il contrario
    quindi se compare è public può essere chiamato da Elenco
    se è private può essere chiamato solo da altri metodi della classe annidata
    */ 
    
    //se la dichiaro come public avrei potuto chiamare nel main Elenco.IntegerReverseComparator
    //La classe ci serve solo per una piccola parte del programma;
    
      private static class IntegerReverseComparator implements Comparator<Integer>{
         
          @Override
          public int compare(Integer a, Integer b){
              //restituisce -1 se a<b
              //             1 se a>b
              if(a<b)
                  return -1;
              else if(a>b)
                  return 1;
              else return 0;
          }
      }
    
    
    public void sort(){
        IntegerReverseComparator comp = new IntegerReverseComparator();
        list.sort(comp);
    }
    @Override
    public String toString(){
        return list.toString();
    }
}
/*Nella docum. dell'interfaccia Map, ci sta un'interfaccia annidata Map.entry
che è definita di tipo static;
Possiamo dichiarare un'interfaccia di tipo Map.entry e ci sono dei metodi
come entrySet che restituisce un Set di valori 

*/