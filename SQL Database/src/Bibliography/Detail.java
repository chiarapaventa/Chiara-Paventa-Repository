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
public class Detail {
    private Integer id_doc;
    private String title;
    private String link;
    private Theme theme;
    private Typology typology;
    private ArrayList<Author> authors;
    private ArrayList<KeyWord> keyWords;
    private ArrayList<PersonalTag> personalTags;
    
   
    
    public Detail(Integer id_doc, String title, String link, Theme theme, 
                  Typology typology, ArrayList<Author> authors, ArrayList<KeyWord> keyWords, 
                  ArrayList<PersonalTag> personalTags){ 
        this.id_doc = id_doc;
        this.title = title;
        this.link = link;
        this.theme = theme;
        this.theme = theme;
        this.typology = typology;
        this.keyWords = keyWords;
        this.personalTags = personalTags;   
        this.authors = authors;
    }
      
    public void setId(Integer id_doc){
    this.id_doc = id_doc;
    }
    public void setTitle(String title){
        this.title = title;
    }
    public void setLink(String link){
        this.link = link;
    }
    public void setTheme(Theme theme){
        this.theme = theme;
    }
    public void setTypology(Typology typology){
        this.typology = typology;
    }
    public void setAuthors(ArrayList<Author> authors){
        this.authors = authors;
    }
    public void setKeyWords(ArrayList<KeyWord> keyWords){
        this.keyWords = keyWords;
    }
    
    public void setPersonalTags(ArrayList<PersonalTag> personalTags){
        this.personalTags = personalTags;
    }
   
    
    public Integer getId(){
       return id_doc;
    }
    public String getTitle(){
        return title;
    }
    public String getLink(){
        return link;
    }
    public Theme getTheme(){
        return theme;
    }
    public Typology getTypology(){
        return typology;
    }
    public ArrayList<Author> getAuthors(){
        return authors;
    }
    public ArrayList<KeyWord> getKeyWords(){
        return keyWords;
    }
    
    public ArrayList<PersonalTag> getPersonalTags(){
        return personalTags;
    }
    
    /**
     * Ottiene dal database il dettaglio associato al documento, il cui id è quello passato come parametro.
     * Restituisce, se presente, il dettaglio. Altrimenti null
     * @param conn
     * @param id
     * @return
     * @throws SQLException
     * @throws ClassNotFoundException 
     * @return 
     */
    public static Detail getDetailDocument(Connection conn, int id) throws SQLException, ClassNotFoundException{
        Detail detail;
        Theme theme;
        Typology typology;
        String query = "SELECT * " +
                       "FROM documento JOIN dettaglio ON documento.id = dettaglio.id_doc " + 
                       "WHERE id = " + id;
        PreparedStatement stm = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();

        if(!rst.next()){
            return null;
        }else{
            theme = new Theme(rst.getString("tematica"));
            typology = new Typology(rst.getString("tipologia"));
            detail = new Detail(rst.getInt("id_doc"), rst.getString("titolo"), rst.getString("link"), 
                                theme, typology, Author.getAuthorsDocument(conn, rst.getInt("id_doc")), 
                                KeyWord.getKeyWords(conn, rst.getInt("id_doc")), PersonalTag.getPersonalTags(conn, rst.getInt("id_doc")));
            return detail;
        }
    }
    
    
     public static String getTitleDetail(Integer idDetail,MyConnection myConn) throws SQLException,ClassNotFoundException{
        Connection connection= myConn.getConnection();
        String query = "SELECT titolo FROM dettaglio WHERE id_doc=?";
        PreparedStatement stm = connection.prepareStatement(query);
        stm.setInt(1,idDetail);
        ResultSet rst = stm.executeQuery();
        if(rst.next())       
           return rst.getString("titolo");
        else
           return null; 
          
      }
     
      public static String getLinkDetail(Integer idDetail,MyConnection myConn) throws SQLException,ClassNotFoundException{
        Connection connection= myConn.getConnection();
        String query = "SELECT link FROM dettaglio WHERE id_doc=?";
        PreparedStatement stm = connection.prepareStatement(query);
        stm.setInt(1,idDetail);
        ResultSet rst = stm.executeQuery();
        if(rst.next())       
           return rst.getString("link");
        else
           return null; 
          
      }
      
         public static boolean verifyDetailAssociateDocument(Integer idDocument, MyConnection myConn) throws SQLException,ClassNotFoundException {
        Connection connection= myConn.getConnection();
        String query = "SELECT count(*) FROM dettaglio WHERE id_doc=?";
        PreparedStatement stm = connection.prepareStatement(query);
        stm.setInt(1,idDocument);
        ResultSet rst = stm.executeQuery();
        if(rst.next())       
           return true;
        else
           return false; 
    }
          public static void updateTitleDetail(Detail detail, MyConnection myConn) throws SQLException,ClassNotFoundException{
           Connection connection=myConn.getConnection();
            String query="UPDATE dettaglio SET titolo = ?, WHERE id_doc= ?";      
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1,detail.getTitle());
            preparedStatement.setInt(2,detail.getId());
            preparedStatement.executeUpdate();
    }
    
       public static void updateLinkDetail(Detail detail, MyConnection myConn) throws SQLException,ClassNotFoundException{
            
            Connection connection=myConn.getConnection();
            String query="UPDATE dettaglio SET link = ?, WHERE id_doc= ?";      
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1,detail.getLink());
            preparedStatement.setInt(2,detail.getId());
            preparedStatement.executeUpdate();
            
    }
    @Override
    public String toString(){
        return title;
    }
    
}
