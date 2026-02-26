/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package esempiocollezioni1;

import java.util.Objects;

/**
 *
 * @author foggia
 */
public class Persona implements Comparable<Persona>{
    private String nome;
    private String cognome;
    
    public Persona(String nome, String cognome) {
        this.nome=nome;
        this.cognome=cognome;
    }
    
    public String getNome() {
        return nome;
    }
    
    public String getCognome() {
        return cognome;
    }
    
    @Override
    public String toString() {
        return nome+" "+cognome;
    }
    
    @Override
    public boolean equals(Object other) {
        Persona p=(Persona)other;
        return nome.equals(p.nome) &&
               cognome.equals(p.cognome);
    }

    @Override
    public int hashCode() {
        int hash = 7;
        hash = 89 * hash + Objects.hashCode(this.nome);
        hash = 89 * hash + Objects.hashCode(this.cognome);
        return hash;
    }
    
    @Override
    public int compareTo(Persona p) {
        int c=nome.compareTo(p.nome);
        if (c==0)
            c=cognome.compareTo(p.cognome);
        return c;
    }
 
}
