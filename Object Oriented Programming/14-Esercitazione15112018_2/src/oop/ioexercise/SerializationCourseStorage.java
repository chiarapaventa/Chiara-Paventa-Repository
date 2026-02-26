/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package oop.ioexercise;
import java.io.*;
/**
 *
 * @author Chiara
 */
public class SerializationCourseStorage implements CourseStorage{
   public SerializationCourseStorage(){    //quando il costruttore è vuoto possiamo anche non scriverlo
   } 
   public Course load(String fileName)throws IOException{
      InputStream in = new FileInputStream(fileName);
      ObjectInputStream ois = new ObjectInputStream(in);
       try{
           Course course = (Course)ois.readObject();
           return course;          
       }catch(ClassNotFoundException e){
           throw new IOException(e.toString());
       }finally{
           ois.close();
       }
       
   }
   
   public void save(String fileName, Course course){
       
   }
}
