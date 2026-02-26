
package pkg13.esempioio1;
import java.io.*;
/**
 *
 * @author Chiara
 */
public class Persona {
  protected int eta;
  protected String nome;

  
public Persona (String nome, int età){
      this.nome=nome;
      this.eta=eta;
  }
  
public String getNome() {
return nome;
}
  


public int getEta (){
   return eta; 
}



public String toString(){
    return nome+" ("+eta+")";
}

//metoo per scrivere in formato binario una persona
//come parametri passiamo un dataOutputSTream o un semplice OutputStream
//non chiudiamo il file, nel caso in cui si vogliano scrivere altri elementi
public void write(OutputStream os) throws Exception{
    DataOutputStream data = new DataOutputStream (os);
    data.writeUTF(nome);
    data.writeInt(eta);
}

public static Persona read(InputStream in) throws Exception{
    DataInputStream data = new DataInputStream(in);
    String nome = data.readUTF();
    int eta = data.readInt();
    return new Persona(nome, eta);
}
}

