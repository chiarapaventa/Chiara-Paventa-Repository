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
public class Persona {
    private String nome;
    private int eta;
    
    public Persona(String nome, int eta) {
        this.nome=nome;
        this.eta=eta;
    }
    
    public String getNome() {
        return nome;
    }
    
    public int getEta() {
        return eta;
    }
    
    @Override
    public String toString() {
        return nome + "("+eta+")";
    }
    
    public void write(OutputStream os) throws IOException {
        DataOutputStream data=
                new DataOutputStream(os);
        data.writeUTF(nome);
        data.writeInt(eta);
    }
    
    public static Persona read(InputStream in) throws IOException {
        DataInputStream data=
                new DataInputStream(in);
        String nome=data.readUTF();
        int eta=data.readInt();
        return new Persona(nome, eta);
    }
}
