 
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package esempiotextio;
import java.io.*;
import java.util.*;
/**
 *
 * @author foggia
 */
public class EsempioTextIO {
    private static final String FILE_NAME="prova.txt";
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException {
        scriviTesto("àèìòù");
        System.out.println(leggiTesto());
        //scriviIntero(42);
        //System.out.println("Intero="+leggiIntero());
    }
    
    
    public static void scriviTesto(String s) throws IOException {
        OutputStream out=new FileOutputStream(FILE_NAME);
        Writer writer=new OutputStreamWriter(out, "UTF-16");                           
        writer.write(s);
        writer.close();
    }
    
    public static String leggiTesto() throws IOException {
        InputStream in=new FileInputStream(FILE_NAME);
        Reader reader=new InputStreamReader(in, "UTF-16");                     
        BufferedReader buffered=new
            BufferedReader(reader);
        String line = buffered.readLine();
        buffered.close();
        return line;
    }
    
    public static void scriviIntero(int x) throws IOException {
        Writer writer = new FileWriter(FILE_NAME);
        PrintWriter pw = new PrintWriter(writer);               
        pw.print(x);
        pw.close();
    }
    
    
    public static int leggiIntero() throws IOException {
        Reader reader=new FileReader(FILE_NAME);
        Scanner scan=new Scanner(reader);
        int x = scan.nextInt();
        reader.close();
        return x;
    }
    
    
}
