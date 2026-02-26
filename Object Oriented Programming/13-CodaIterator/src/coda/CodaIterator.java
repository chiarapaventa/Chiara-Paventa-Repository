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
public class CodaIterator <E> implements Iterator{//deve implementare l'interfaccia iterator, siccome la classe coda era generica,
    //anche questa classe deve essere generica 
    
    //siccome abbiamo una coda circolare ci serve un indice per il prossimo elemento 
    //non possiamo prendere il prossimo elemento se non abbiamo un vettore
    private E array[];
    private int i;
    private int remaining;
    //dobbiamo inizializzare tali variabili quindi abbiamo bisogno di un costruttore 
    //noi vogliamo che sia la classe coda a fornire l'iterator, allora dobbiamo fare un costruttore privato 
    CodaIterator(E array[], int first, int n ){
        this.array=array;
        i=first;
        remaining=n;
    }
    
    @Override
    public boolean hasNext(){//dice se ci sono altri nodi da iterare 
        //se remaing è zero restituiamo false, se diverso da zero dobbiamo restituire  true
        return remaining!=0;
    }
    
    @Override
    public E next(){ //ci da il prossimo elemento da iterare
        //l'elemento da restituire è 
        if(remaining==0)
            throw new IndexOutOfBoundsException();
                    E result=array[i];
                    i=(i+1)%array.length;
                    remaining--;
                    return result;               
    }
    //questi sono i due metodi del nostro iteratore 
}
