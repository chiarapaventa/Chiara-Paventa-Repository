/*
La classe Cuoco, che implementa l’interfaccia Runnable, ha accesso all’oggetto
Comande che gli viene passato come argomento del costruttore.
Cuoco implements Runnable
+ Cuoco(Comande comande)
+ run()
Nel metodo run(), la classe Cuoco svolge le seguenti operazioni, ciclicamente:
-	preleva la prossima Ordinazione invocando il metodo consegnaOrdinazioni dell’oggetto Comande
-	attende un tempo random compreso tra 5 e 10 secondi
-	stampa a video del messaggio “Piatto pronto: [dettaglio ordinazione attraverso il metodo
toString della classe ordinazione]”
 */
package terzaprova;

/**
 *
 * @author Chiara
 */
public class Cuoco implements Runnable{
    private Comande comande;
    public Cuoco (Comande comande){
        this.comande = comande;
    }
    public void run (){
        while(true){
        Ordinazione ord = comande.consegnaOrdinazione();
        
        try{
          wait(5000); 
        }catch(InterruptedException e){
            System.out.println("Piatto pronto: "+ord.toString());
        }
        }
    }
}
