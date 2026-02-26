package ClasseIO;
import java.util.*;
import java.io.*;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Chiara
 */
public class ClasseIO {
    private Map<Integer, Integer> map;
    private String filename;
    private int k;
    private int x;
    private int y;
    public ClasseIO(String filename){
        this.filename = filename;
        map = new HashMap<>();
        k = 0;
    }
    public Map<Integer, Integer> getMap(){
        return map;
    }
    public void leggiDoppioni()throws IOException{
        InputStream in = new FileInputStream(filename);
        DataInputStream data = new DataInputStream(in);
        Scanner scan = new Scanner(data);
        
        while(scan.hasNextInt()){
            x = scan.nextInt();
            y = scan.nextInt();
            if(x == y){
                map.put(k++, x);
            }
        }
    }
}
