
package oop.ioexercise;
import java.io.*;
/**
 *
 * @author Chiara
 */
public interface CourseStorage {
    Course load(String fileName) throws IOException;
    void save(String fileName, Course course) throws IOException;
}
