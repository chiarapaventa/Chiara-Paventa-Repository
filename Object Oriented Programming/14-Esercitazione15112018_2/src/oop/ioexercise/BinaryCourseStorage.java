
package oop.ioexercise;
import java.io.*;
import java.util.*;
/**
 *
 * @author Chiara	
  Un'istanza di questa classe è in grado 
* di caricare da/ salvare su file un Course 
* in formato binario SENZA usare la 
* serializzazione
 */

public class BinaryCourseStorage implements CourseStorage{
public BinaryCourseStorage(){//si può anche non scrivere
}
public Course load(String fileName)throws IOException{//legge un corso da un file binario
    Course course = null;

    InputStream in = new FileInputStream (fileName);
    InputStream data= new DataInputStream(in);
    
    String courseName = data.read();//readUTF();
    course = new Course (courseName);
    
    int numStudents = data.read();//readInt();
    /*for(int i=0; i<numStudents; i++){
        int id = 
    }*/
    data.close();    
}
public void save(String fileName, Course course)throws IOException{//Salva un corso su un file in formato binario

    OutputStream out = new FileOutputStream (fileName);
    DataOutputStream data = new DataOutputStream(out);
   
    
    data.writeUTF(course.getName());
    Set<Integer> setIds = course.getIds();
   
    int numStudents = setIds.size();
    data.writeInt(numStudents);
    
    for( Integer i : setIds){
        data.writeInt(i);
        Student st = course.getStudent(i);
        data.writeUTF(st.getName());
        data.writeDouble(st.getAverageGrade());
    }
    data.close();
}





}
