/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package coda;

/**
 *
 * @author enza
 */
public class Coda<T> {//dice che la classe coda è generica parametrizzata rispetto a un tipo //Tdiventa il parametro della classe
    private Object a[];//array di oggetti
    private int front, rear;//per la coda servono due indici 
    private int n;
    
    public Coda(int max){
        a=new Object[max];
        front=0;
        rear=0;
    }
    //metodi per le code, uno per inserire, l'altro per prelevare
    
    public void inserisci(T x) {
        //dobbiamo mettere l'indice che indica l'elemeento della coda e deve essere circolare 
        //dobbiamo controllare che la coda non sia piena
        //if(n<a.length){
        if(n>=a.length)
            throw new CodaPienaException();
        a[rear]=x;
        rear=(rear+1)%a.length;
        n++;
        //}
    }
    
    public T preleva(){
        if(n==0)
            //return null;
            throw new CodaVuotaException();
        
        Object x=a[front];
        front=(front+1)%a.length;
        n--;
        return (T)x;
    }
    public boolean isEmpty(){
        return n==a.length;
    }
    public boolean isFull(){
        return n==a.length;
    }
}
