/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Bibliography;
import java.util.*;
import java.sql.*;
/**
 *
 * @author gruppo6
 */
public class Typology {
    private String name;
    
    public Typology(String name){
        this.name = name;
    }
    
    public void setName(String name){
        this.name = name;
    }
    
    public String getName(){
        return name;
    }
    
    public static ArrayList<Typology> getAllTypologies(Connection conn) throws SQLException,ClassNotFoundException{
        ArrayList<Typology> typologies = new ArrayList<>();
        String query = "SELECT nome FROM tipologia";
        PreparedStatement stm = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();
        
        while(rst.next()){
           typologies.add(new Typology(rst.getString("nome")));
        }
       return typologies;
    }

     public static Typology getTypologyDetail(Integer idDetail,Connection conn) throws SQLException,ClassNotFoundException{
        String query = "SELECT tipologia FROM dettaglio WHERE id_doc=?";
        PreparedStatement stm = conn.prepareStatement(query);
        stm.setInt(1,idDetail);
        ResultSet rst = stm.executeQuery();
        if(rst.next())
           return new Typology(rst.getString("tipologia"));
        else
           return null;      
    }
     
      public static void updateTypologyDetail(Detail detail,MyConnection myConn) throws SQLException,ClassNotFoundException{
        Connection connection=myConn.getConnection();
        String query="UPDATE dettaglio SET tipologia = ?, WHERE id_doc= ?";      
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1,detail.getTypology().getName());
            preparedStatement.setInt(2,detail.getId());
            preparedStatement.executeUpdate();
    }
   
      public static void updateTypology(Typology oldTypology,Typology newTypology,MyConnection myConn) throws SQLException,ClassNotFoundException{
            Connection connection=myConn.getConnection();
            String query="UPDATE tipologia SET nome = ?, WHERE nome= ?";      
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1,oldTypology.getName());
            preparedStatement.setString(2,newTypology.getName());
            preparedStatement.executeUpdate();
    }
    @Override
    public String toString(){
        return name;
    }
}
