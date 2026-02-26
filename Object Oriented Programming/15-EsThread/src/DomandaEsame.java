/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Chiara
 */
public class DomandaEsame {
    private int count;
    public DomandaEsame(){
        count = 0;
    }
    public void attesa(){
        count++;
        if(count == 5){
           count = 0;
            notifyAll();          
        }else{
            try{
                wait();
            }catch(InterruptedException e){}
        }
    }
}
