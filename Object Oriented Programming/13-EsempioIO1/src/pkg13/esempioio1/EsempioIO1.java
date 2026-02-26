
package pkg13.esempioio1;
import java.io.*;
/**
 *
 * @author Chiara
 */
public class EsempioIO1 {

    
    public static void main(String[] args) {
        try {
            scriviByte((byte)42);
            int b = leggiByte();
            System.out.println("Il valore letto è : "+b);
            
            scriviStringa("Hello, world");
            String s = leggiStringa();
            System.out.println("La stringa letta è : "+s);
            b = leggiByte();
            System.out.println("Il valore letto è : "+b);

            float v[] = new float[] {1.1f, 2.2f, 3.3f};
            scriviArray(v);
            float a[] = leggiArray();
            for(int i=0; i<a.length; i++)
            System.out.println("a["+i+"]: "+a[i]);
            
            scriviPersona(new Persona("Pinco", 22));
            Persona p=leggiPersona();
            System.out.println("Persona: "+p);
            
        }
        catch (Exception e ){
            System.out.println(e);
        }
    }
    //scrive il byte dal file
    //se il valore boolean è false il file viene aperto 
    public static void scriviByte (byte b) throws IOException{
        //la creazione di un file output Stream solleva un'eccezione per cui scrivere throw
        OutputStream o = new FileOutputStream("Pippo.dat");
        //creiamo il decorator che ci consente di scrivere in maniera bufferizzata
        OutputStream buffered = new BufferedOutputStream (o);
        
        buffered.write(b);
        buffered.close();
    }
    
    // legge il byte sul file
    //il file di ritorno   , potrebbe fallire la lettura->non genera un'eccezione ma restituisce un valore = -1;
    public static int leggiByte () throws IOException{
        InputStream in = new FileInputStream("Pippo.dat");
        InputStream buffered = new BufferedInputStream(in);
        
        int b = buffered.read(); //leggiamo il byte
        buffered.close();
        return b;
    
    }
    
    public static void scriviStringa(String s) throws IOException{
        OutputStream o = new FileOutputStream("Pippo.dat");
        DataOutputStream data = new DataOutputStream(o);
        //non possiamo dichiare data come var output stream
        data.writeUTF(s);
        data.close();
        
    }
    
    
    public static String leggiStringa() throws IOException{
        InputStream in = new FileInputStream("pippo.dat");
        DataInputStream data = new DataInputStream(in);
        String s = data.readUTF();
        data.close();
        return s;
    }
    
    //scrivere array
    public static void scriviArray(float a[]) throws Exception{
        //creo file OutputStrem
        OutputStream o = new FileOutputStream("pippo.dat");
        DataOutputStream data = new DataOutputStream(o);
        data.writeInt(a.length);
        
        for(int i=0; i<a.length; i++)
            data.writeFloat(a[i]);
    }
    
    public static float[] leggiArray()throws Exception{
        InputStream in = new FileInputStream("pippo.dat");
        DataInputStream data = new DataInputStream(in);
        
        int n = data.readInt();
        float a[]= new float[n];
        
        for(int i=0; i<n; i++)
        a[i] = data.readFloat();
        data.close();
        return a;
    }
    
    public static void scriviPersona(Persona p) throws Exception{
        FileOutputStream out = new FileOutputStream("pippo.dat");
        p.write(out);
        out.close();
    }
    //abbiamo chiamato static proprio per non dover istanziare Persona
    public static Persona leggiPersona() throws Exception{
        FileInputStream in = new FileInputStream("pippo.dat");
        scriviPersona(new Persona("Pinco", 22));
        Persona p1 = in.read();
        in.close();
        return p1;
    }
    
}
//la versione buffered su una quantita molto grande di byte da notevoli vantaggi
//serializzazione, ci evita di scrivere metodi leggi/scrivi per ogni oggetto, fa in maniera automatica
//la lettura il binario
