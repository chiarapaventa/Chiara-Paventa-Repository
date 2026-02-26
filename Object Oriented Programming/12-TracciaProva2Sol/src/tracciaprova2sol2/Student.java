/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tracciaprova2sol2;

/**
 *
 * @author Chiara
 */
public class Student extends Person{
    private String matricola;
    
    public Student (String name, String surname, String matricola, int year, int month, int dayOfMonth){
        super(name,surname,year,month,dayOfMonth);
        this.matricola = matricola;
    }
    public String getMatricola(){
        return matricola;
    }
    @Override
    public String toString(){
        return super.toString()+" - Matricola: "+getMatricola();
    }
}
