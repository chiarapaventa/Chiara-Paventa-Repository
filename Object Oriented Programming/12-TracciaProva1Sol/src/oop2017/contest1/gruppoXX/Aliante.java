package oop2017.contest1.gruppoXX;

import java.util.*;

public class Aliante extends Aeromobile {
    
    private final double efficienza;

    public Aliante(String codice, double efficienza) {
        super(codice);
        this.efficienza = efficienza;
    }


    public double getEfficienza() {
        return efficienza;
    }

    @Override
    public String toString() {
        return super.toString() + " - Tipo = Aliante - Efficienza = " + efficienza;
    }


}
