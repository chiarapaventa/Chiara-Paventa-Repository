/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author foggia
 */
public class Writer implements Runnable {
    private Queue<String> queue;
    public Writer(Queue<String> queue) {
        this.queue=queue;
    }
    
    @Override
    public void run() {
        while (true) {
            try {
                Thread.sleep(1000);
            } catch (InterruptedException e) {
                
            }
            queue.add("Hello");
        }
    }
}
