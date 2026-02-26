/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Bibliography;
import javax.swing.*;
import java.sql.*;
/**
 *
 * @author gruppo6
 */
public class MyListModel {
    private DefaultListModel listModelDocuments;

    public MyListModel(){
        listModelDocuments = new DefaultListModel();
    }
    public void setListModel(DefaultListModel listModelDocuments){
        this.listModelDocuments = listModelDocuments;
    }
    public DefaultListModel getListModel(){
        return listModelDocuments;
    }

    /**
     * Cerca nel database dei documenti che hanno un autore, tag, parola chiave o titolo che corrisponde
     * alla stringa cercata 
     * 
     * @param conn
     * @param search
     * @throws SQLException
     * @throws ClassNotFoundException 
     */
    public void setFilterSearchBar (Connection conn, String search) throws SQLException, ClassNotFoundException{
        String query = "SELECT *\n" +
"                       FROM documento\n" +
"                       WHERE documento.id IN (SELECT id_doc\n" +
"                                              FROM dettaglio \n" +
"					       WHERE titolo = '" + search + "') OR\n" +
"                             documento.id IN (SELECT dettaglio\n" +
"					       FROM creazione\n" +
"					       WHERE autore = '" + search + "') OR\n" +
"                             documento.id IN (SELECT dettaglio\n" +
"					       FROM contrassegno\n" +
"					       WHERE tag_personale = '" + search + "') OR\n" +
"                             documento.id IN (SELECT dettaglio\n" +
"					       FROM individuazione\n" +
"					       WHERE parola_chiave = '" + search + "')";
        
        PreparedStatement stm = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();
        listModelDocuments.removeAllElements();
        while(rst.next()){
            
            listModelDocuments.addElement(new Document(rst.getInt("id"), rst.getString("nome_file"), 
                                                       rst.getString("estensione"), rst.getDate("data_inserimento"), 
                                                       rst.getDate("data_lettura"), rst.getBoolean("stato"), 
                                                       Detail.getDetailDocument(conn, rst.getInt("id")), 
                                                       Rate.getRateDocument(conn, rst.getInt("id")), 
                                                       Comment.getCommentsDocument(conn, rst.getInt("id"))));
        }
    }
    
    /**
     * Rimuove da un listDocuments tutti gli elementi non corrispondenti al filtro selezionato filter
     * 
     * @param themeSelected 
     */
    public void setFilterTheme (String themeSelected){
        int i = 0;
        Document doc;
        Detail det;
        Theme t;
        String s;
        int n = listModelDocuments.getSize();
        
        for(int k = 0; k < n; k++){
            
            doc = (Document) listModelDocuments.get(i);
            det = doc.getDetail();
            if(det != null){
                t = det.getTheme();
                    s = t.getName();
                    if(s == null || s.compareTo(themeSelected) != 0){
                        listModelDocuments.remove(i);
                        i--;
                    }
            }
            i++;
        } 
        
    }
    
    /**
     * 
     * @param typologySelected 
     */
    public void setFilterTypology (String typologySelected){
        int i = 0;
        Document doc;
        Detail det;
        Typology t;
        String s;
        int n = listModelDocuments.getSize();
        
        for(int k = 0; k < n; k++){
            
            doc = (Document) listModelDocuments.get(i);
            det = doc.getDetail();
            if(det != null){
                t = det.getTypology();
                    s = t.getName();
                    if(s == null || s.compareTo(typologySelected) != 0){
                        listModelDocuments.remove(i);
                        i--;
                    }
            }
            i++;
        } 
        
    }
    
    /**
     * 
     * @param extensionSelected 
     */
    public void setFilterExtension (String extensionSelected){
        int i = 0;
        Document doc;
        String s;
        int n = listModelDocuments.getSize();
        
        for(int k = 0; k < n; k++){
            
            doc = (Document) listModelDocuments.get(i);
            s = doc.getExtension();
                if(s == null || s.compareTo(extensionSelected) != 0){
                    listModelDocuments.remove(i);
                    i--;
                }
            i++; 
        }
       
    }
    
    /**
     * 
     * @param stateSelected 
     */
    public void setFilterState (String stateSelected){
        int i = 0;
        Document doc;
        boolean state;
        boolean stateSelectedBool;
        if(stateSelected.compareTo("Documenti letti") == 0){
            stateSelectedBool = true;
        }else{
            stateSelectedBool = false;
        }
        
        int n = listModelDocuments.getSize();
        
        for(int k = 0; k < n; k++){
            
            doc = (Document) listModelDocuments.get(i);
            state = doc.getState();
                if(state != stateSelectedBool){
                   listModelDocuments.remove(i);
                    i--;
                }
            i++; 
        }
       
    } 
    
    public void setFilterRate (String rateSelected){
        int i = 0;
        Document doc;
        int rateSelectedInt = Integer.parseInt(rateSelected);
        Rate rate;
        int rateDocument;
        int n = listModelDocuments.getSize();
        
        for(int k = 0; k < n; k++){
            
            doc = (Document) listModelDocuments.get(i);
            rate = doc.getRate();
            if(rate != null){
                rateDocument = rate.getValue();
                if(rateDocument != rateSelectedInt){
                    listModelDocuments.remove(i);
                    i--;
                }
            }else{
                listModelDocuments.remove(i);
                i--;
            }
            i++; 
        }
    } 
     
        
    
    /**
     * Rimuove da un MyListModel il filtro specificato nel parametro filter
     * 
     * @param conn
     * @param filter
     * @param themeSelected
     * @param typologySelected
     * @param extensionSelected
     * @param stateSelected
     * @param rateSelected
     * @throws SQLException
     * @throws ClassNotFoundException 
     */
    public void removeFilter (Connection conn, String filter, String themeSelected, String typologySelected, String extensionSelected, 
                              String stateSelected, String rateSelected ) throws SQLException, ClassNotFoundException{              
        boolean state;
        if(stateSelected.compareTo("Documenti letti") == 0){
            state = true;
        }else{
            state = false;
        }
       
        
        
        String query = " SELECT *\n " +
                       " FROM documento \n " ;
       
        if(themeSelected.compareTo("") != 0 || typologySelected.compareTo("") != 0 || extensionSelected.compareTo("") != 0 ||
           stateSelected.compareTo("") != 0 || rateSelected.compareTo("") != 0){
            query = query + " WHERE \n ";
        
            if(themeSelected.compareTo("") != 0 && filter.compareTo("theme") != 0){
                query = query + " documento.id IN \n " +
                                "   (SELECT id_doc  \n " +
                                "    FROM dettaglio \n " +
                                "    WHERE tematica = '" + themeSelected + "' ) ";
                if(typologySelected.compareTo("") != 0 || extensionSelected.compareTo("") != 0 ||
                   stateSelected.compareTo("") != 0 || rateSelected.compareTo("") != 0){
                    query = query + " AND \n ";
                }
            }
            
            if(typologySelected.compareTo("") != 0 && filter.compareTo("typology") != 0){
                query = query + " documento.id IN \n " +
                                "   (SELECT id_doc  \n " +
                                "    FROM dettaglio \n " +
                                "    WHERE tipologia = '" + typologySelected + "' ) "; 
                if(extensionSelected.compareTo("") != 0 || stateSelected.compareTo("") != 0 || 
                   rateSelected.compareTo("") != 0){
                    query = query + " AND \n ";
                }
            }
            
            if(extensionSelected.compareTo("") != 0 && filter.compareTo("extension") != 0){
                query = query + " documento.id IN \n " +
                                "   (SELECT id  \n " +
                                "    FROM documento \n " +
                                "    WHERE estensione = '" + extensionSelected + "' ) ";
                if(stateSelected.compareTo("") != 0 || rateSelected.compareTo("") != 0){
                    query = query + " AND \n ";
                }
            }
            
            if(stateSelected.compareTo("") != 0 && filter.compareTo("state") != 0){
                query = query + " documento.id IN  \n " +
                                "   (SELECT id \n " +
                                "    FROM documento \n " +
                                "    WHERE stato = " + state + " ) ";
                if(rateSelected.compareTo("") != 0){
                    query = query + " AND \n ";
                }
            }
            
            if(rateSelected.compareTo("") != 0 && filter.compareTo("val") != 0){
                int rate = 0;
                if(rateSelected.compareTo("1") == 0)
                    rate = 1;
                if(rateSelected.compareTo("2") == 0)
                    rate = 2;
                if(rateSelected.compareTo("3") == 0)
                    rate = 3;
                if(rateSelected.compareTo("4") == 0)
                    rate = 4;
                if(rateSelected.compareTo("5") == 0)
                    rate = 5;
                
                query = query + " documento.id IN  \n " +
                                "   (SELECT documento  \n " +
                                "    FROM valutazione \n " +
                                "    WHERE valore = " + rate + " ) ";
            }
        }
        
        System.out.println("Questa è la query: \n"+query);
           
        PreparedStatement stm = conn.prepareStatement(query);
        ResultSet rst = stm.executeQuery();
        listModelDocuments.removeAllElements();
        while(rst.next()){
            listModelDocuments.addElement(new Document(rst.getInt("id"), rst.getString("nome_file"), 
                                       rst.getString("estensione"), rst.getDate("data_inserimento"), 
                                       rst.getDate("data_lettura"), rst.getBoolean("stato"), 
                                       Detail.getDetailDocument(conn, rst.getInt("id")), Rate.getRateDocument(conn, rst.getInt("id")),
                                       Comment.getCommentsDocument(conn, rst.getInt("id"))));
        }
    }
}

