/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package coda;
import java.util.*;

/**
 *
 * @author enza
 */
public class Main {

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        Coda<Integer> coda=new Coda<Integer>(13);//ho dichiarato la coda come un oggetto che può accettare solo tipi integer
        //coda.inserisci("AAA");
        //coda.inserisci("BBB");
        //coda.inserisci("CCC");
        //coda.inserisci(42);
        //coda.inserisci(10);
        //coda.inserisci(22);
        //coda.inserisci(89);
        //Integer i=Integer.valueOf(42);
       // Integer i=42; 
        /*Integer j=Integer.valueOf("10");
        coda.inserisci(i);//possiamo anche mettere direttamente coda.inserisci(42)
        coda.inserisci(j);
        
        //Integer j=new Integer(10);
        while(!coda.isEmpty()){
            int x=coda.preleva();
            //Integerx=(Integer)coda.preleva();//possiamo anche mettere direttamente int x=(int)coda.preleva();            int value=x;//tale meccanismo ci rende inconveniente 
            //System.out.println(x.intValue());
            System.out.println(x);
        }
        /*
        while(!coda.isEmpty()){
            String s=(String)coda.preleva();
            System.out.println(s);
            
        }
*/
  
        //Gestore delle eccezioni nel main 
        try{ //gestore delle eccezioni durante il quale sarà attivo l'handler
            coda.inserisci(42);
        coda.inserisci(10);
        coda.inserisci(22);
        coda.inserisci(89);
        System.out.println("Ho finito");//ltale scritta non compare perchè prima di arrivare a questa istruzione si verifica l'eccezione
        //return;//anche conil return il finall viene eseguito 
        //System.exit(0);//come nel C, termina il processo a livello di sistema operativo, non è una terminazione a livello della libreria Java, per questo non va usata, perchè altrimenti perdiamo file ecc, è come uccidere un processo
        }catch (CodaException e){
            System.out.println("Abbiamo un problema ");
        }finally{//tale istruzione viene eseguita sempre a prescindere
            System.out.println("Ora chiudo tutto");
        }
       //dopo dobbiamo mettere il blocco catch in cui dobbiamo specificare il tipo di eccezioni
       
       
       
       
       Iterator<Integer> it=coda.iterator();
       while(it.hasNext()){
           int elem=it.next();
           System.out.println("Elemento: "+elem);
       }
       //questa è una 
    } 
    
}
