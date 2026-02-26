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
    
    
    public static void main(String[] args) throws IOException{
        scriviTesto("Hello world!");
        /*Siccome non abbiamo specificatao l'encoding viene utilizzato 
        quello di default della macchina*/
        System.out.println(leggiTesto());
        scriviIntero(42);
        System.out.println(leggiIntero());
    }
    
    public static void scriviTesto(String s) throws IOException{
        //ci serve un oggetto di tipo writer per scrivere
        //per scrivere i caratteri sul file devo scrivere i singoli caratteri con dei metodi di writer
        Writer writer = new FileWriter(FILE_NAME); 
        writer.write(s);
        writer.close();
    }
    
    /*per la lettura introduciamo la classe Reader. Per leggere una linea di 
    caratteri piuttosto che un solo carattere, utiizzo un bufferedReader*/
    public static String leggiTesto() throws IOException{
        Reader reader = new FileReader(FILE_NAME);
        BufferedReader buffered = new BufferedReader(reader);
        String line = buffered.readLine();
        buffered.close();
        return line;
    }
    
    /*Se voglio scrivere e leggere cose che non sono stringhe, devo usare dei 
    decorator che mi permettono di scrivere in formato testuale numeri e altro*/
    public static void scriviIntero(int x) throws IOException{
        Writer writer = new FileWriter(FILE_NAME);
        //MI COSTRUISCO PRINTwRITER, CHE PUO' SCRIVERE COSE DIVERSE DA CARATTERI
        PrintWriter pw=new PrintWriter(writer);//PrintWriter-->decorator
        pw.print(x);
        pw.close();
    }
    
    /*Per leggere l'intero dal file usiamo Scanner(che usavamo per leggere da tastiera),
    basta che al costruttore anzixhè passare System.in, passiamo un reader. 
    Chiaramente con Scanner posso leggere, con tutti i suoi metodi, stringhe, caratteri, interi...*/
    public static int leggiIntero() throws IOException{
        Reader reader=new FileReader(FILE_NAME);
        Scanner scan = new Scanner(reader);
        int x = scan.nextInt();
        reader.close();
        return x;
    }
           
}
