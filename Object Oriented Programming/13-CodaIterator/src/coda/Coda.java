/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package coda;
import java.util.*;
/**
 *
 * @author enza
 */
public class Coda<Elem> implements Iterable {//dice che la classe coda è generica parametrizzata rispetto a un tipo //Tdiventa il parametro della classe
    private Object a[];
    private int front, rear;
    private int n;
    
    public Coda(int max){
        a=new Object[max];
        front=0;
        rear=0;
    }
    //metodi per le code, uno per inserire, l'altro per prelevare
    
    public void inserisci(Elem x) {
        //dobbiamo mettere l'indice che indica l'elemeento della coda e deve essere circolare 
        //dobbiamo controllare che la coda non sia 
        //if(n<a.length){
        if(n >= a.length)
            throw new CodaPienaException();
        a[rear] = x;
        rear = (rear+1)%a.length;
        n++;
        //}
    }
    
    public Elem preleva(){
        if(n==0)
            //return null;
            throw new CodaVuotaException();
        
        Object x=a[front];
        front=(front+1)%a.length;
        n--;
        return (Elem)x;
    }
    public boolean isEmpty(){
        return n==a.length;
    }
    public boolean isFull(){
        return n==a.length;
    }
    //modifica, la classe coda implementa la classe iterator
    //vogliamo iterare tutti gli elementi di una specifica struttura dati, ogni struttura dati può essere iterata anche se ha 
    //informazioni di tipo diverso.
    //Il costrutto for each non può sapere quale è la struttura dati specifica di una collezione e si appoggia a un altro oggetto che 
    //si chiama iteratore il quale include al suo interno i meccanismi che servono per visitare in maniera efficente gli elementi della 
    //collezione, se la collezione è un arraylist, probabilmente l'iteratore di quest'array conterrà al suo interno un indice numerico 
    //se invece è una linked list l'iteratore della linked list conterrà un puntatore al nodo ecc.
    //Quindi un iteratore contiene al suo interno tutte le informazioni che servono per visitare gli elementi della struttura dati
    //Per ogni classe che rappresenta una collezione ci sarà una classe iteratore specifica di quella collezione, tutte queste classi 
    //devono implementare una stessa interfaccia in modo tale che il for each si possa utilizzare. questa è l'interfaccia iterator
    //Iterator implementa di base due metodi, uno che ci dice se ci sono altri elementi da visitare oppure la visita è finita, e il 
    //metodo che ci restituisce il prossimo elemento.
    //Quindi noi se vogliamo implementare iterator dobbiamo fornire questi due metodi 
    //La nostra classe deve costruire un iteratore quando viene richiamato il metodo iterator definito nella interfaccia iterable 
    //quando facciamo il for each richiama il metodo iterator sull'oggetto su cui noi vogliamo fare l'iterazione, tale metodo restituisce
    //un metodo iteratore, il for each richiama il metodo next per vedere se ha finito se non ha finito richiama il metodo next 
    //per prelevare il prosismo elemento. 
    //Dovremmo quindi realizzare un iteratore che implementa i due metodi e dovremo implementare nella nostra classe il metodo iterator 
    //che costruisce il nostro iteratore 
    //come prima cosa andiamo a creare la classe coda iterator 
    @Override
    public Iterator<Elem> iterator(){
    return new CodaIterator(a, front, n);
    
    }
    
    
            }
