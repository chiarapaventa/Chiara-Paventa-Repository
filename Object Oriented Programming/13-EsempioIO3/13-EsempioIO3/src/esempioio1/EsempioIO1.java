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
            OutputStream os=new 
                FileOutputStream("pippo.dat");
            ObjectOutputStream oos=
                    new ObjectOutputStream(os);
            Persona p=new Persona("Pinco", 22);
            oos.writeObject(p);
            p.setNome("Pallino");
            p.setEta(19);
            oos.writeObject(p);
            oos.close();
            
            InputStream in=new 
                FileInputStream("pippo.dat");
            ObjectInputStream ois=
                    new ObjectInputStream(in);
            Persona p1=(Persona)ois.readObject();
            Persona p2=(Persona)ois.readObject();
            ois.close();
            System.out.println("P1="+p1);
            System.out.println("P2="+p2);
            System.out.println(p1==p2);
        } catch (Exception e) {
            System.out.println(e);
        }
    }
    
    
}
