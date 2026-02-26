/*
Nel metodo run(), la classe BackupAutomatico svolge le seguenti operazioni, ciclicamente:
-Richiedere il salvataggio della coda di ordinazioni su file attraverso il metodo salvaOrdinazioni  della classe Comande.
-Visualizzare a video il messaggio “BACKUP EFFETTUATO”
-Attendere 20 secondi prima di effettuare un nuovo salvataggio.

 */
package terzaprova;

/**
 *
 * @author Chiara
 */
public class BackupAutomatico implements Runnable{
    private Comande comande;
    public BackupAutomatico(Comande comande){
        this.comande = comande;
    }
    public void run(){
        while(true){
            salvaOrdinazioni();
            try{
                wait(20000);
            }catch(InterruptedException e){
                System.out.println("BACKUP EFFETTUATO");
            }
        }
    }    
}
