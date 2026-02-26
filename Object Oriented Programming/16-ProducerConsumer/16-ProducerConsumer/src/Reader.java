/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author foggia
 */
public class Reader implements Runnable {
    private Queue<String> queue;
    public Reader(Queue<String> queue) {
        this.queue = queue;
    }
    
    @Override
    public void run() {
        while (true) {
            String s = queue.remove();
            System.out.println("Ho letto: "+s);
        }
    }
}
