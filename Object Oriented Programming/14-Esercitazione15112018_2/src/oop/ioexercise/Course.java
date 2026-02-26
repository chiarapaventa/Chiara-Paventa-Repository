/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package oop.ioexercise;
import java.util.*;
import java.io.*;

/**
 *
 * @author Chiara
 */
public class Course implements Serializable{
    private String name;
    private Map<Integer, Student> students;
   
    public Course(String name){
        this.name = name;
        students = new HashMap<>();
    } 
    
    public Set<Integer> getIds(){
        return students.keySet();
    }
    
    public String getName(){
        return name;
    }
   
    public Student getStudent(int id){
     return students.get(id);
    }
   
    public void putStudent(int id, Student st){
        students.put(id, st);
    }
}
