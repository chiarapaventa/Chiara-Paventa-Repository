/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dispositivi;

/**
 *
 * @author Chiara
 */
public class Main {
    public static void main(String args[]){
        Cellualre c=new Cellualre();
        AspirapolverePortatile a=new AspirapolverePortatile();
        Aspirapolvere b=new Aspirapolvere();
        Stazione s=new Stazione();
        
        c.telefona("mamma");
        s.ricarica(c);
        
        a.aspira();
        s.ricarica(a);
        
       // s.ricarica(b);  ERRORE, perchè a non è un oggetto ricaricabile
    }
}
