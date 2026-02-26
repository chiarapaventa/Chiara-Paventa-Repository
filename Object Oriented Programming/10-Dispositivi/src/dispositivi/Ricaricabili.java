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
public interface Ricaricabili {
    //dichiariamo quali sono i metodi comuni che riteniamo ricaricabili
    void carica();
    //public ci serve per individuare quali classi usano carica, nelle interface--> public è sottinteso
    //una classe fornisce questa interfaccia se fornisce questa firma
    //in qeusto caso protected non ha senso, perchè il metodo quando è protetto non abbiamo bisogno di un interface


}


