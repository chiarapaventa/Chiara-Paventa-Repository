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

public class Document { 
    
    private Integer id;
    private String fileName;
    private String extension;
    private Date insertDate;
    private Date readDate;
    private boolean state;
    private Detail detail;
    private Rate rate;
    private ArrayList<Comment> comments;   
   
    public Document(Integer id, String fileName, String extension, Date insertDate, 
                    Date readDate, boolean state, Detail detail, Rate rate, ArrayList<Comment> comments){
        this.id=id;
        this.fileName = fileName;
        this.extension = extension;
        this.insertDate = insertDate;
        this.readDate = readDate;
        this.state = state;
        this.detail = detail;
        this.rate = rate;
        this.comments = comments;
    } 
   
    public void setId(Integer id){
        this.id=id;
    }
    public void setFileName(String fileName){
        this.fileName = fileName;
    }
    public void setExtension(String extension){
        this.extension = extension;
    }
    public void setInsertDate(Date insertDate){
        this.insertDate = insertDate;
    }
    public void setReadDate(Date readDate){
        this.readDate = readDate;
    }
    public void setState(boolean state){
        this.state = state;
    }
    public void setDetail(Detail detail){
        this.detail = detail;
    }
    public void setRate(Rate rate){
        this.rate = rate;
    }
    public void setComments(ArrayList<Comment> comments){
        this.comments = comments;
    }
    public ArrayList<Comment> getComments(){
        return comments;
    }
    public Rate getRate(){
        return rate;
    }
    public Detail getDetail(){
        return detail;
    }
     public Integer getId(){
        return id;
    }
    public String getFileName(){
        return fileName;
    }
    public String getExtension(){
       return extension;
    }
    public Date getInsertDate(){
       return insertDate;
    }
    public Date getReadDate(){
        return readDate;
    }
    public boolean getState(){
        return state;
    }
    
    
    public static ArrayList<Document> getDocuments(Connection conn) throws SQLException,ClassNotFoundException{
        ArrayList<Document> documents = new ArrayList<>();
        Rate rate;
        Detail detail;
        
        String query = "SELECT * " +
                       "FROM documento";
        PreparedStatement stm = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();
        
        while(rst.next()){
            detail = Detail.getDetailDocument(conn, rst.getInt("id"));
            rate = Rate.getRateDocument(conn, rst.getInt("id"));

            documents.add(new Document(rst.getInt("id"), rst.getString("nome_file"), 
                                       rst.getString("estensione"), rst.getDate("data_inserimento"), 
                                       rst.getDate("data_lettura"), rst.getBoolean("stato"), detail, rate,
                                       Comment.getCommentsDocument(conn, rst.getInt("id"))));
        }
        return documents;     
    }
    
    public static Integer getRateDocument(Connection conn, Integer id)throws SQLException,ClassNotFoundException{ 
        String query = "SELECT valore FROM valutazione WHERE documento = ?";
        PreparedStatement stm = conn.prepareStatement(query);
        stm.setInt(1,  id);
        ResultSet rst = stm.executeQuery();
        if(rst.next())
           return rst.getInt("valore");
        else
           return null;   
    }
    
    public static ArrayList<String> getAllExtensions(Connection conn) throws SQLException, ClassNotFoundException{
        ArrayList<String> extensions = new ArrayList<>();
        String query = "SELECT DISTINCT estensione FROM documento";
        PreparedStatement stm  = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();
        while(rst.next()){
            extensions.add(rst.getString("estensione"));
        }
        return extensions;
    }
    
   @Override
    public String toString(){
        return fileName + "." + extension;
    }

}
