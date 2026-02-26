
package oop.ioexercise;
import java.io.*;
/**
 *
 * @author Chiara
 */
public class Student implements Serializable{
    private String name;
    private double averageGrade;
    public Student(String name){
        this.name = name;
        averageGrade=-1.0;
    }
    public String getName(){
        return name;
    }
    public double getAverageGrade(){
        return averageGrade;
    }
    public void setAverageGrade(double avgGrade){
        this.averageGrade = avgGrade;
    }
    
}
