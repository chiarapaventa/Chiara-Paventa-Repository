/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tracciaprova2sol2;
import java.time.*;
/**
 *
 * @author Chiara
 */
public class Person implements Comparable<Person>{
    private LocalDate birthDate;
    private String name;
    private String surname;
    
    public Person(String name, String surname, int year, int month, int dayOfMonth){
        this.birthDate = LocalDate.of(year, month, dayOfMonth);
        this.name = name;
        this.surname = surname;
    }
     
    public LocalDate getBirthDate(){
        return birthDate;
    }
    public String getName(){
        return name;
    }
    public String getSurname(){
        return surname;
    }
    public int compareTo(Person o){
        return -1 * this.birthDate.compareTo(o.getBirthDate());
    }
    public String toString(){
        return "Nome: "+getName()+"\n - Cognome: "+getSurname();
    }
    
}
