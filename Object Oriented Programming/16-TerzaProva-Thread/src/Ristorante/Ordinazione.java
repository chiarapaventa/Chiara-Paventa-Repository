//+ Ordinazione(String piatto, int tavolo, int quantita)

package Ristorante;
import java.io.Serializable;
/**
 *
 * @author Chiara
 */
public class Ordinazione implements Serializable{
    private String piatto;
    private int tavolo;
    private int quantita;
    public Ordinazione(String piatto, int tavolo, int quantita){
        this.piatto = piatto;
        this.tavolo = tavolo;
        this.quantita = quantita;
    }
    public void setPiatto(String p){
        this.piatto = p;
    }
    public String getPiatto(){
        return piatto;
    }
    public void setTavolo(int t){
        this.tavolo = t;
    }
    public int getTavolo(){
        return tavolo;
    }
    public void setQuantita(int q){
        this.quantita = q;
    }
    public int getQuantita(){
        return quantita;
    }
    //: “Piatto: [piatto], Tavolo: [tavolo], Quantità: [quantita]”, ad esempio “Piatto: Pasta al pomodoro, Tavolo: 1, Quantità: 3”.
    @Override
    public String toString(){
        return "Piatto: "+getPiatto()+", Tavolo: "+getTavolo()+", Quantità: "+getQuantita();
    }
}
