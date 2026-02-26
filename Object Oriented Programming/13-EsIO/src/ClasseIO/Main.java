package ClasseIO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
import java.util.*;
import java.io.*;
/**
 *
 * @author Chiara
 */
public class Main {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        try{
        save("mattina");
        save("pomeriggio");
        save("sera");
        System.out.println(contaRighe()); 
        }catch(IOException e){}
        
        ClasseIO c = new ClasseIO("prova2.txt");
        Map<Integer, Integer> mappaDoppioni = new HashMap();
        try{
        c.leggiDoppioni();
        }catch(IOException e){}
        mappaDoppioni = c.getMap();
        Set<Integer> keys = mappaDoppioni.keySet();
        for(Integer i : keys)
            System.out.println(mappaDoppioni.get(i));
    }
    
    public static void save(String s)throws IOException{
        Writer writer = new FileWriter("prova.txt");
        BufferedWriter buffered = new BufferedWriter(writer);
        buffered.write(s);
        buffered.close();
    }   
    public static String load()throws IOException{
        Reader reader = new FileReader("prova.txt");
        BufferedReader buffered = new BufferedReader(reader);
        String s = buffered.readLine();
        buffered.close();
        return s;
    }
    public static int contaRighe()throws IOException{
        Reader reader = new FileReader("prova.txt");
        BufferedReader buffered = new BufferedReader(reader);
        int i = 0;
        while(buffered.readLine() != null)
            i++;
        return i;
    }
}
