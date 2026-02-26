/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package oop2017.contest1.gruppoXX;

/**
 *
 * @author Gennaro
 */
public abstract class Aeromobile {
    private final String codice;
    private final int numeroSequenziale;
    private static int allocati = 0;
    

    
    
    public Aeromobile(String codice) {
        this.codice = codice;
        allocati++;
        numeroSequenziale = allocati;
    }

    public String getCodice() {
        return codice;
    }

    @Override
    public String toString() {
        return "Aeromobile n. " + numeroSequenziale + " - Codice = " + codice;
    }

    public int getNumeroSequenziale() {
        return numeroSequenziale;
    }}
