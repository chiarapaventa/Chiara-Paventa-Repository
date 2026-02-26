/*
Una singola ordinazione è gestita con un oggetto di tipo Ordinazione. 
La classe Ordinazione dovrà avere la seguente interfaccia:

Ordinazione 
+ Ordinazione(String piatto, int tavolo, int quantita)
+ setPiatto(String piatto) : void
+ getPiatto() : String
+ setTavolo(int tavolo) : void
+ getTavolo () : int
+ setQuantita(int quantita) : void
+ getQuantita() : int
+ toString() : String
Il metodo toString() dovrà restituire una stringa nel seguente formato: 
“Piatto: [piatto], Tavolo: [tavolo], Quantità: [quantita]”, ad esempio “Piatto: Pasta al pomodoro, Tavolo: 1, Quantità: 3”.
 */
package terzaprova;

/**
 *
 * @author Chiara
 */
public class Ordinazione {
    private String piatto;
    private int tavolo;
    private int quantita;
    
    public Ordinazione(String piatto, int tavolo, int quantita){
        this.piatto = piatto;
        this.tavolo = tavolo;
        this.quantita = quantita;
    }
    public void setPiatto(String piatto){
        this.piatto = piatto;
    }
    public String getPiatto(){
        return piatto;
    }
    public void setTavolo(){
        this.tavolo = tavolo;
    }
    public int tavolo(){
        return tavolo;
    }
    public void setQuantita(){
        this.quantita = quantita;
    }
    public int quantita(){
        return quantita;
    }
    public String toString(){
        return "Piatto: "+piatto+"Tavolo: "+tavolo+"Quantità: "+quantita;
    }   
}
