package esempioGUI;
import java.awt.Color;
import javax.swing.*;
import java.awt.event.*;
/**
 *
 * @author Chiara
 */
public class Main {

   
    public static void main(String[] args) {
        JFrame frame = new JFrame("Hello");//Titolo finestra
        frame.setSize(400,300);//Un oggetto di tipo frame è diviso in più aree
        //Dobbiamo aggiungere un Listener al frame , per inserire controlli prima di poter eseguire eventi associati al bottone
        
        
        
        //JLabel label = new JLabel("Hello, world!");//aggiungiamo l'etichetta nell'area centrale, dobbiamo accedere all'oggetto Pane
        JButton button = new JButton("Hello, world");
        button.addActionListener(         //parametro->cosa deve fare quando si preme il bottone
                    new ActionListener(){  //rappresenta l'evento 'il bottone è stato premuto'
                        public void actionPerformed(ActionEvent e){
                            button.setBackground(Color.magenta);
                            button.setOpaque(true);
                            System.out.println("Click");
                        }
                    });
        
        
        //Proviamo a fare in modo che quando viene premuto il bottone la prima volta non si chiude la finestra, ma chiede di salvare i dati, la seconda chiude e basta, mettiamo una var che indica se è stata o meno già richiamata
        frame.addWindowListener(
                     new WindowAdapter(){
                         private int count=0;
                         public void windowClosing(WindowEvent event){
                             if( count == 0 ){
                             System.out.println("Salva i dati");
                             }else{ 
                             System.exit(0);
                             }
                             count++;
                         }
                     });
        
        
        //frame.getContentPane().add(label);
        frame.getContentPane().add(button);
        frame.setDefaultCloseOperation(JFrame.DO_NOTHING_ON_CLOSE);
        //label.setLocation(100, 100);
        
        frame.setVisible(true);//La finestra deve essere visibile
        /*il metodo ActionListener, definita per ogni evento, 
        definisce l'evento che riceve qualcosa di tipo event che può essere usato per gestire qualcosa
        l'oggetto ActionEvent indica l'istante di tempo in cui è stato premuto il bottone
        
        Però il programma è ancora in esecuzione-> c'è un altro thread attivo
        Quando creiamo un'interfaccia utente si crea un altro thread, poichè 
        stiamo ragionando in modo di aspettare ciò che inserisce l'utente
        Questo nuovo thread si mette in attesa che il SO comunichi, e poi richiami il metodo opportuno
        Non possiamo bloccare il pgm con la chiusura della finestra perchè ce ne potrebbero essere altre aperte
        Nel caso in cui ci sta solo una finestra terminiamo il pgm nel momento in cui si chiude la finestra
        Non mettere riga 18 dopo la 19 , perchè potremmo inserire un possibile bug, perchè NON POSSIAMO USARE 
        GLI OGGETTI GRAFICI DA PARTE DI PIU THREAD, PERCHE' PIU THREAD ACCEDONO A PIU OGGETTI CHE NON SONO SINCRONIZZATI*/
        
        SwingUtilities.invokeLater(
                new Runnable(){
                    public void run (){//definiamo una classe anonima interna, solo le variabili dichiarate final possono essere viste dalle classi anonime, ma dopo Java 8 vengono viste come varibili final di fatto
                        //frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE); //frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);//quanto chiudo la finestra esegue exit on close, in generale non bisogna usarla quasi mai
                    }
                });
        /* invokeLater ->esegue il metodo run dell oggetto passato, che implementa Runnable,
        ma lo fa eseguire dal thread dell'interfaccia utente che tiene blocato il nostro pgm
        se faccio eseguire l'operazione setDefaultCloseOperation da invokeLater
        PER L'UTILIZZO CHE FAREMO DELLE INTERF. GRAFICHE E' UTILE USARE LE CLASSI ANONIME
        
        Inseriamo in oggetto che metta nella finestra la scritta Hello World
        Classe jlabel implementa etichette
        */
        
        
    }
    
}
