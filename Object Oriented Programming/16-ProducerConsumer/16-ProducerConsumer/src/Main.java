/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author foggia
 */
public class Main {
    public static void main(String args[]) {
        Queue<String> queue = new Queue<>();
        Writer writer = new Writer(queue);
        Thread tw = new Thread(writer);
        tw.start();
        
        Reader reader = new Reader(queue);
        Thread tr=new Thread(reader);
        tr.start();
        
        Reader reader2 = new Reader(queue);
        Thread tr2 = new Thread(reader2);
        tr2.start();
    }
}
