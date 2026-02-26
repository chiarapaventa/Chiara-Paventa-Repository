/*
 *Scrivo in un file i caratteri della stringa Hello world
 */
package iochar_esempio1;
import java.io.*;
import java.util.*;

/**
 *
 * @author Donatella Malta
 */
public class Main {
private static final String FILE_NAME="pippo.dat";
   
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException{
        scriviTesto("àèìòù");
        System.out.println(leggiTesto());
        scriviIntero(42);
        System.out.println(leggiIntero());
    }
    
    public static void scriviTesto(String s) throws IOException{
        OutputStream out = new FileOutputStream(FILE_NAME);
        Writer writer = new OutputStreamWriter(out, "ASCII"); 
        //gli passo l'outputstream dove voglio scrivere e poi l'encoding che voglio usare
        writer.write(s);
        writer.close();
    }
    
    public static String leggiTesto() throws IOException{
        InputStream in = new FileInputStream(FILE_NAME);
        Reader reader = new InputStreamReader(in, "UTF-16");
        BufferedReader buffered = new BufferedReader(reader);
        String line = buffered.readLine();
        buffered.close();
        return line;
    }
  
    public static void scriviIntero(int x) throws IOException{
        Writer writer = new FileWriter(FILE_NAME);
        //MI COSTRUISCO PRINTWRITER, CHE PUO' SCRIVERE COSE DIVERSE DA CARATTERI
        PrintWriter pw=new PrintWriter(writer); 
        pw.print(x);
        pw.close();
    }
   
    public static int leggiIntero() throws IOException{
        Reader reader=new FileReader(FILE_NAME);
        Scanner scan = new Scanner(reader);
        int x = scan.nextInt();
        reader.close();
        return x;
    }
    
}
