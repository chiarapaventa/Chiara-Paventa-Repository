/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Bibliography;

import java.sql.*;
import java.util.ArrayList;

/**
 *
 * @author gruppo6
 */
public class KeyWord {
   private String word;
   
   public KeyWord(String word){
       this.word = word;
   }
    public String getKeyWord(){
        return word;
    }
    public void setKeyWord(String word){
        this.word = word;
    }

    public static ArrayList<KeyWord> getKeyWords(Connection conn, int id) throws SQLException,ClassNotFoundException{
        ArrayList<KeyWord> keyWords = new ArrayList<>();
        String query = "SELECT * " +
                       "FROM dettaglio JOIN individuazione ON dettaglio.id_doc = individuazione.dettaglio " +
                       "WHERE individuazione.dettaglio = " + id;
        PreparedStatement stm = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();
        while(rst.next()){
            keyWords.add(new KeyWord(rst.getString("parola_chiave")));
        }
        return keyWords;
    }
    
    public static ArrayList<KeyWord> getKeyWordDetail(Integer idDetail,MyConnection myConn) throws SQLException,ClassNotFoundException{
        ArrayList<KeyWord> keyWords= new ArrayList<>();
        Connection connection= myConn.getConnection();
        String query ="select p.parola from dettaglio d ,individuazione i,parolachiave p where p.parola=i.parola_chiave and d.id_doc=i.dettaglio  and d.id_doc=?";
        PreparedStatement stm = connection.prepareStatement(query);
        stm.setInt(1, idDetail);
        ResultSet rst = stm.executeQuery();
        while (rst.next())
        {
            keyWords.add(new KeyWord(rst.getString("parola")));
        }
          
        return keyWords;    
        
    }
}
