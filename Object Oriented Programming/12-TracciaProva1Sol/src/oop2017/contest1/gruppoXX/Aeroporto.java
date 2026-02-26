package oop2017.contest1.gruppoXX;

import java.util.*;

/**
 *
 * @author Gennaro
 */
public class Aeroporto{
    private final List<Aeromobile> l;
    private final CodeChecker checker;

    public Aeroporto(CodeChecker c) {
        this.checker = c;
        l = new LinkedList();
    }
    
    public Aeromobile cerca(String codice){
        for(Aeromobile a: l){
            if(a.getCodice().equals(codice))
                return a;
        }
        return null;
    }
    
    public Aeromobile rimuovi(String codice){
        Aeromobile a = null;
        for(int i =0; i<l.size(); i++){
            a = l.get(i);
            if(a.getCodice().equals(codice)){
                l.remove(i);
                return a;
            }
        }
        return null;
    }
            
    
    public boolean inserisci(Aeromobile a) {
        if ( (checker==null) || ( checker.check(a.getCodice() ) ) ){
            l.add(a);
            return true;
        }else
            return false;
    }
    
    public int elementi(){
        return l.size();
    }

    @Override
    public String toString() {
        String res = "";
        for(Aeromobile a: l)
            res += a.toString() + '\n';
        return res;
    }
    
}
