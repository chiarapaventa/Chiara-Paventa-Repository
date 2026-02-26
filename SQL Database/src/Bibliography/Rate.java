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
 * @author Chiara
 */
public class Rate {
    private int value;
    private int id;
    
    public Rate(int value, int id){
        this.value = value;        
        this.id = id;
    }
    
    public void setValue(int value){
        this.value = value; 
    }
    public void setId(int id){
        this.id = id;
    }
    public int getValue(){
        return value;
    }
    public int getId(){
        return id;
    }
    
    public static Rate getRateDocument(Connection conn, int id) throws SQLException{
        Rate rate;
        String query = "SELECT valutazione.valore " +
                       "FROM documento JOIN valutazione ON documento.id = valutazione.documento " + 
                       "WHERE valutazione.documento = ?"; 
        PreparedStatement stm = conn.prepareStatement(query);
        stm.setInt(1, id);
        ResultSet rst = stm.executeQuery();
        
        if(!rst.next()){
            return null;
        }else{
            rate = new Rate(rst.getInt("valore"), id);
            return rate;
        }
    } 
    
    public String toString(){
        return id + " " + value; 
    }
}
