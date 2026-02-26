
package oop.ioexercise;
import java.io.*;
/**
 *
 * @author Chiara
 * Un'istanza di questa classe è in grado di salvare su / caricare 
 * da file un Course in formato testuale, 
 * usando un encoding dei caratteri 
 * specificato al momento della creazione dell'istanza.
 */
public class TextCourseStorage implements CourseStorage{
   
    public Course load (String fileName)throws IOException{
        InputStream in = new FileInputStream (fileName);
        Reader reader = new InputStreamReader(in,encoding);
        BufferedReader bufferedReader = new BufferedReader(reader);
        
        Course course = new Course(bufferedReader.readLine());
        Integer numStudents = Integer.parseInt(bufferedReader.readLine());
        
        for (int i=0; i<numStudents; i++){
            Integer id = Integer.parseInt(bufferedReader.readLine());
            Student s = new Student(bufferedReader.readLine());
            s.setAverageGrade(Double.parseDouble(bufferedReader.readLine()));
            course.putStudent(id, s);
        }
        bufferedReader.close();
        return course;
    }
    public void Save (String fileName, Course course) throws IOException{
        
    }
}
