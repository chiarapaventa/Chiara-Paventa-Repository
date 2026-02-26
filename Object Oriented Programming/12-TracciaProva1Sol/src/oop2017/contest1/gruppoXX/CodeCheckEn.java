package oop2017.contest1.gruppoXX;

/**
 *
 * @author Gennaro
 */
public class CodeCheckEn implements CodeChecker{

    @Override
    public boolean check(String codice) {
       return codice.matches("EN[0-9]{2}[a-zA-Z]{2}");
    }
    
}
