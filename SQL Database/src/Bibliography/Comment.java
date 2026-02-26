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
public class Comment {
    private Integer id;
    private String text;
    
    public Comment (Integer id, String text){
        this.id = id;
        this.text = text;
    }
    public Integer getId(){
        return id;
    }
    
    public String getText(){
        return text;
    }
    public void setText(String text){
        this.text = text;
    }
    
    public String toString(){
        return text;
    }
    public static ArrayList<Comment> getCommentsDocument(Connection conn, int id) throws SQLException, ClassNotFoundException{
        ArrayList<Comment> comments = new ArrayList<>();
        String query = "SELECT *  " +
                       "FROM commento " + 
                       "WHERE documento = " + id;
        PreparedStatement stm = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();
        while(rst.next()){
            comments.add(new Comment(id, rst.getString("testo")));
        }
        return comments;
    }
    
    public static void updateCommentsDocument(Document oldDocument,Document newDocument,MyConnection myConn) throws SQLException,ClassNotFoundException{
            Connection connection=myConn.getConnection();
            
            ArrayList<Comment> oldComment=oldDocument.getComments();
            ArrayList<Comment> newComment=newDocument.getComments();
            Comment currentOldComment;
            Comment currentNewComment;
            
            if(oldComment.size()<=newComment.size())
            {
                
                for(int i=0 ; i< oldComment.size() ; i++){
                    
                    currentOldComment = oldComment.get(i);
                    currentNewComment= newComment.get(i);
                    
                    String query="UPDATE commento SET testo = ?, WHERE id= ?";      
                    PreparedStatement preparedStatement = connection.prepareStatement(query);
                    preparedStatement.setString(1,currentNewComment.getText());
                    preparedStatement.setInt(2,currentOldComment.getId());
                    preparedStatement.executeUpdate();
                    
                }
                
            int diff= newComment.size() - oldComment.size();
            
                for(int j=0 ; j<diff ; j++){
                    
                    currentNewComment= newComment.get(oldComment.size()+j-1);
                    String query="INSERT INTO commento (testo) VALUES (?)";      
                    PreparedStatement preparedStatement = connection.prepareStatement(query);
                    preparedStatement.setString(1,currentNewComment.getText());
                    preparedStatement.executeUpdate();

                }
            
                 
            }else
                {
                    
                    for(int i=0 ; i< newComment.size() ; i++)
                    {
                    
                    currentOldComment = oldComment.get(i);
                    currentNewComment= newComment.get(i);
                    
                    String query="UPDATE commento SET testo = ?, WHERE id= ?";      
                    PreparedStatement preparedStatement = connection.prepareStatement(query);
                    preparedStatement.setString(1,currentNewComment.getText());
                    preparedStatement.setInt(2,currentOldComment.getId());
                    preparedStatement.executeUpdate();
                    
                    }
                
                int diff= oldComment.size() - newComment.size();
                
                    for(int j=0 ; j<diff ; j++)
                    {
                    
                    currentOldComment= oldComment.get(newComment.size()+j-1);
                    
                    String query="DELETE FROM commento WHERE id= ?";      
                    PreparedStatement preparedStatement = connection.prepareStatement(query);
                    preparedStatement.setInt(1,currentOldComment.getId());
                    preparedStatement.executeUpdate();
                    }
                    
            
                    
                }
              
    }

}
