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
public class Theme {
    private String nome;
 
    public Theme(String nome){
        this.nome=nome;
 }
    public void setName(String nome){
        this.nome=nome;
    }
    public String getName(){
        return nome;
    }
    
    public static ArrayList<Theme> getAllThemes(Connection conn) throws SQLException,ClassNotFoundException{
        ArrayList<Theme> theme = new ArrayList<>();
        String query = "SELECT nome FROM tematica";
        PreparedStatement stm = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();
        while(rst.next()){
           theme.add(new Theme(rst.getString("nome")));
        }
       return theme;
    }
        public static Theme getThemeDetail(Integer idDetail, Connection conn) throws SQLException,ClassNotFoundException{
        String query = "SELECT tematica FROM dettaglio WHERE id_doc=?";
        PreparedStatement stm = conn.prepareStatement(query);
        stm.setInt(1,idDetail);
        ResultSet rst = stm.executeQuery();
        if(rst.next())
           return new Theme(rst.getString("tematica"));
        else
           return null;      
    }
        
    public static void updateThemeDetail(Detail detail,Connection conn) throws SQLException,ClassNotFoundException{
        String query="UPDATE dettaglio SET tematica = ?, WHERE id_doc= ?";      
            PreparedStatement preparedStatement = conn.prepareStatement(query);
            preparedStatement.setString(1,detail.getTheme().getName());
            preparedStatement.setInt(2,detail.getId());
            preparedStatement.executeUpdate();
    }
    public static void updateTheme(Theme oldTheme,Theme newTheme,MyConnection myConn) throws SQLException,ClassNotFoundException{
            Connection connection=myConn.getConnection();
            String query="UPDATE tematica SET nome = ?, WHERE nome= ?";      
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1,oldTheme.getName());
            preparedStatement.setString(2,newTheme.getName());
            preparedStatement.executeUpdate();

    }
     
    @Override
    public boolean equals(Object obj){
        if (obj instanceof Theme) {
            Theme tem = (Theme)obj;
            return nome == tem.nome;
        }else{
            return false;    
        }
    }
    
 @Override
    public String toString(){
        return nome;
    }
}
