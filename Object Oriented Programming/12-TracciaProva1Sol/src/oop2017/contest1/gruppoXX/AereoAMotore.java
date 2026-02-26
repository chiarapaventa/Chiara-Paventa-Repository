
package oop2017.contest1.gruppoXX;

/**
 *
 * @author Gennaro
 */
public class AereoAMotore extends Aeromobile{

    private final int numRotori;

    public int getNumRotori() {
        return numRotori;
    }
    public AereoAMotore(String codice, int numRotori) {
        super(codice);
        this.numRotori = numRotori;
    }

 
    @Override
    public String toString() {
        return super.toString() + " - Tipo = Aereo a motore - Numero rotori = " + numRotori;
    }

    
}
