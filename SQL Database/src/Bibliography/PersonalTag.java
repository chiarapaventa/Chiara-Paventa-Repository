/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Bibliography;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

/**
 *
 * @author gruppo6
 */
public class PersonalTag {
    private String word;
    
    public PersonalTag(String word){
          this.word = word;
    }
    public String getPersonalTag(){
        return word;
    }
    public void setPersonalTag(String word){
        this.word = word;
    }
 
    public static ArrayList<PersonalTag> getPersonalTags(Connection conn, int id) throws SQLException, ClassNotFoundException{
        ArrayList<PersonalTag> personalTags = new ArrayList<>();
        String query = "SELECT * " +
                       "FROM dettaglio JOIN contrassegno ON dettaglio.id_doc = contrassegno.dettaglio " +
                       "WHERE contrassegno.dettaglio = " + id;
        PreparedStatement stm = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();
        while(rst.next()){
            personalTags.add(new PersonalTag(rst.getString("tag_personale")));
        }
        return personalTags;
    }
    
       public static ArrayList<PersonalTag> getPersonalTagDetail(Integer idDetail,MyConnection myConn) throws SQLException,ClassNotFoundException{
        ArrayList<PersonalTag> personalTag= new ArrayList<>();
        Connection connection= myConn.getConnection();
        String query ="select t.parola from dettaglio d ,contrassegno c,tagpersonale t where t.parola=c.tag_personale and d.id_doc=c.dettaglio  and d.id_doc=?";
        PreparedStatement stm = connection.prepareStatement(query);
        stm.setInt(1, idDetail);
        ResultSet rst = stm.executeQuery();
        while (rst.next())
        {
            personalTag.add(new PersonalTag(rst.getString("parola")));
        }
          
        return personalTag;    
        
    }
}
