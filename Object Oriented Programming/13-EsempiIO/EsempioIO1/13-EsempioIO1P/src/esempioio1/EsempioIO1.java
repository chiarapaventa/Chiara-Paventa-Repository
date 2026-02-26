/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package esempioio1;
import java.io.*;
/**
 *
 * @author foggia
 */
public class EsempioIO1 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        try {
            scriviByte((byte)42);
            int b=leggiByte();
            System.out.println("Il valore letto è: "+b);        
            scriviStringa("Hello, world");
            String s=leggiStringa();
            System.out.println("La stringa letta è: "+s);
            b=leggiByte();
            System.out.println("Il valore letto è: "+b);
            float v[]=new float[] {1.1f, 2.2f, 3.3f};
            scriviArray(v);
            float a[]=leggiArray();
            for(int i=0; i<a.length; i++)
                System.out.println("a["+i+"]="+a[i]);
            scriviPersona(new Persona("Pinco", 22));
            Persona p=leggiPersona();
            System.out.println("Persona: "+p);
        } catch (IOException e) {
            System.out.println(e);
        }
    }
    
    public static void scriviByte(byte b) throws IOException {
        OutputStream o=new FileOutputStream("pippo.dat");
        OutputStream buffered = new BufferedOutputStream(o);
        
        buffered.write(b);
        buffered.close();
    }
    
    public static int leggiByte() throws IOException {
        InputStream in = new FileInputStream("pippo.dat");
        InputStream buffered = new BufferedInputStream(in);
        int b = buffered.read();
        buffered.close();
        return b;
    }
    
    public static void scriviStringa(String s) throws IOException {
        OutputStream o = new FileOutputStream("pippo.dat");
        DataOutputStream data = new DataOutputStream(o);
        data.writeUTF(s);
        data.close();
    } 
    
    public static String leggiStringa() throws IOException  {
        InputStream in=new FileInputStream("pippo.dat");
        DataInputStream data=
                new DataInputStream(in);
        String s=data.readUTF();
        data.close();
        return s;
    }
    
    public static void scriviArray(float a[]) throws IOException {
        OutputStream o=new FileOutputStream("pippo.dat");
        DataOutputStream data=
                new DataOutputStream(o);
        data.writeInt(a.length);
        int i;
        for(i=0; i<a.length; i++)
            data.writeFloat(a[i]);
        data.close();
    }
    
    public static float[] leggiArray() throws IOException {
        InputStream in=new FileInputStream("pippo.dat");
        DataInputStream data=
                new DataInputStream(in);
        int n=data.readInt();
        float a[]=new float[n];
        for(int i=0; i<n; i++)
            a[i]=data.readFloat();
        data.close();
        return a;
    }
    
    public static void scriviPersona(Persona p) throws IOException {
        FileOutputStream out = new FileOutputStream("pippo.dat");
        p.write(out);
        out.close();
    }
    public static Persona leggiPersona()throws IOException{
        FileInputStream inp = new FileInputStream("pippo.dat");
        Persona p1 = Persona.read(inp);
        inp.close();
        return p1;
    }
}
