/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Bibliography;
import java.util.ArrayList;
import java.sql.*;
/**
 *
 * @author gruppo6
 */
public class Author {
    private String name;
    
    public Author(String name){
       this.name = name;
    }
    public String getName(){
        return name;
    }
    public void setName(String name){
        this.name = name;
    }
    public static ArrayList<Author> getAllAuthors(Connection conn)throws SQLException{
        ArrayList<Author> authors = new ArrayList<>();
        String queryAuthors = "SELECT * " +
                              "FROM autore";
        PreparedStatement stm = conn.prepareStatement(queryAuthors);
        ResultSet rst = stm.executeQuery();
        while(rst.next()){
            authors.add(new Author(rst.getString("autore")));
        }
        return authors;
    }
    
    public static ArrayList<Author> getAuthorsDocument(Connection conn, int idDetail) throws SQLException{
        ArrayList<Author> authors = new ArrayList<>();
        String query = "SELECT * " +
                       "FROM dettaglio JOIN creazione ON dettaglio.id_doc = creazione.dettaglio " + 
                       "WHERE creazione.dettaglio = " + idDetail;
        PreparedStatement stm = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();
        while(rst.next()){
            authors.add(new Author(rst.getString("autore")));
        }
        return authors;
    } 
    
    /*inserisce un autore in tabella autore*/
    public static void setAuthor(Connection conn, Author author){
       
        
    }
    /*Inserisce tutti gli autori nella tabella creazione e li associa all'id*/
    public static void setAuthorsDetail(Connection conn, int id, ArrayList<Author> authors) throws SQLException{
        
        for (Author a: authors){
            String query_check_author = "SELECT count(*) FROM autore WHERE nome = ? ";
            PreparedStatement stmtCheckAuth = conn.prepareStatement(query_check_author);
            String authorName = a.getName();
            stmtCheckAuth.setString(1, authorName);
            ResultSet rst = stmtCheckAuth.executeQuery();
            int authorIn = 0;
            while(rst.next()){
                authorIn = rst.getInt("count");
            }
            if(authorIn==0){
                String query_insert_author = "INSERT INTO autore (nome) VALUES (?);";
                PreparedStatement stmtAuth = conn.prepareStatement(query_insert_author);
                stmtAuth.setString(1, a.getName());
                stmtAuth.executeUpdate();
            }
        }
        
        
        
        
    }
    
 
}
