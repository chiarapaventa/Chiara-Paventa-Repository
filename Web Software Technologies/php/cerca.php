<?php session_start(); ?>

<html lang="it">

<head>
    <meta charset="utf-8"/>
    <meta name="author" content="GECE"/>
    <meta name="description" content="Cerca Parole"/>
    <title>Cerca Parole</title>
</head>

<body>
		
	<link rel="stylesheet"
		  type="text/css"
		  href="../css/cssCerca.css"
	>


    <a href = "home.php"><img src = "../src/home.png" align = "left"></a> 
	<h1 id="titolo" align = "center">
    Effettua una traduzione!
    </h1>
    
	
	<fieldset>
		<legend><h1><code><font face=”Times New Roman, Times, serif”><b>Inserisci il testo da tradurre</b></font></code></h1></legend>
			<form  action ="<?php $_SERVER['PHP_SELF']; ?>" method = "post" autocomplete="on"> 
				<center><table bgcolor = "#f5f5f5" height=100 width=800>				
     			    <tr>
					    <td><br><br><center><input id="traduci" name="traduci" type="text" placeholder="Inserisci qui il testo" style="width: 600px; height:50px" required><td>
				    </tr>
				    <tr>
					    <td><br><br><center><input name = "cerca" type="submit" value="Traduci"><br><br></td>
				    </tr>            					
				</table>    
			</form><br>			
    </fieldset><br>
	
	
	
	<?php
	require_once("conn.inc");


    function disegna_ris_parole ($riga, $lingua_base, $lingua_trad){	
	    echo "<br>";	
        echo "<table border=0 bgcolor = \"#f5f5f5\" order = 0 align=\"center\" width = 800 height = 200 >";
	        echo "<tr><td width=50% align = \"center\"><font size=\"4\" color=\"black\"><b>&nbsp;".$lingua_base."<b/></font></td><td width=50% align = \"center\">".$riga['parola_chiave']."</td></tr>
			      <tr><td width=50% align = \"center\"><font size=\"4\" color=\"black\"><b>&nbsp;".$lingua_trad."</b></font></td><td width=50% align = \"center\">".$riga['traduzione']."</td></tr>
			      <tr><td width=50% align = \"center\"><font size=\"4\" color=\"black\"><b>&nbsp;Categoria</b></font></td><td width=50% align = \"center\">".$riga['categoria']."</td></tr>
				  <tr><td width=50% align = \"center\"><font size=\"4\" color=\"black\"><b>&nbsp;Riproduci</b></font></td><td width=50% align = \"center\"><audio controls><source src=\"../src/".$riga['file_mp3']."\" type=\"audio/mp3\"></audio></td></tr>";
	    echo "</table>";
	}
	
	function disegna_ris_frasi($risultato2, $lingua_base, $lingua_trad){
		
	    echo "<br><table bgcolor = \"#f5f5f5\" border = 0 align=\"center\" width = 1200>	
		      <tr><td align = \"center\" width=35%><br><b>".$lingua_base."</b></td><td align = \"center\"><br><b>".$lingua_trad."</b></td></tr>";		
			
			while($riga2 = mysqli_fetch_assoc($risultato2)){
				$traduzione = explode(" ", $riga2['traduzione']);
		        $grammatica = explode(" ", $riga2['grammatica']);
                echo "<tr><td align = \"center\" width=35%>".$riga2['frase']."</td>			
				
				            <td align=\"center\">
						      <table border=0 width=530><tr>";
						               foreach($traduzione as $t){
										   echo "<td>".$t."</td>";
									   }
									   echo "</tr><tr>";
									   foreach($grammatica as $g){
									        echo "<td>".$g."</td>";
									   }
									   echo "</tr>";
						
                               echo "</tr></table>
				
				            <td width=25%><audio controls><source src=\"../src/".$riga2['file_mp3']."\"type=\"audio/mp3\"></audio></td></tr>";
            }
	    echo "</table>";
   }
   
   
    function pulisci_stringa($stringa){
	    $values= array("à","è","é","ì","ò","ù","'");
	    $replace = array("&agrave","&egrave","&eacute","&igrave","&ograve","&ugrave", "\\'");
		$s = str_replace($values, $replace, $stringa);	
		return $s;
    }
	
	
	
	
    $connessione= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
    if (!$connessione) {
	die("Connection failed: " . mysqli_connect_error());
    }
	
	$lingua_base = $_SESSION['lingua_base'];
	$lingua_trad = $_SESSION['lingua_trad'];
	
//testo inserito nel form da ricercare
if (isset($_POST['cerca'])){
    $str = $_POST['traduci'];                                                             
    $stringa = pulisci_stringa($str);   
   
   
   
    //query sulle parole chiave
    $query = "SELECT * FROM parola_chiave WHERE lingua_base = '$lingua_base' && lingua_traduzione = '$lingua_trad' && ((parola_chiave = '$stringa') || (traduzione = '$stringa'))";
	//mysqli_set_charset($connessione, "utf8_general_ci");
	$risultato = mysqli_query($connessione, $query);
    //echo "Query Riuscita";
    //echo "<br>";
    $riga = mysqli_fetch_assoc($risultato);//preleva riga dal risultato
	$n = mysqli_num_rows($risultato);//numero di righe trovate




    //query sulle frasi
	$query2 = "SELECT frase.frase, frase.traduzione, frase.grammatica, frase.id_parola_chiave, frase.id_lezione, frase.file_mp3, lezione.lingua_base, lezione.lingua_traduzione
    FROM frase JOIN lezione ON frase.id_lezione = lezione.id_lezione JOIN parola_chiave ON frase.id_parola_chiave = parola_chiave.id_parola_chiave
    WHERE lezione.lingua_base = '$lingua_base'  &&  
    lezione.lingua_traduzione = '$lingua_trad'  &&  
    (frase.frase LIKE '%$stringa%'  ||  frase.traduzione LIKE '%$stringa%'  ||    parola_chiave.parola_chiave LIKE '%$stringa');";
	
	
	//mysqli_set_charset($connessione, "utf8_general_ci");
    $risultato2 = mysqli_query($connessione, $query2);
	$n2 = mysqli_num_rows($risultato2);//numero di righe trovate
	
	
	
    //se le query sono state lanciate e non hanno trovato risultati stampa il messaggio di errore	
	if(($n == 0) && ($n2 == 0)){
        echo "<h2>"."Non &egrave; stata trovata nessuna traduzione corrispondente al testo da te cercato. Riprova!"."</h2>";		
	}
    //altrimenti se il testo cercato fa parte sia di una frase che di un parola chiave, mostra entrambi; se no solo la frase che lo contiene
	else{	
	    echo "<table border = 0 width=1325 align=\"center\"><tr><td width = 1000>";
	    
		if($n != 0){ //se ha trovato un risultato nella tabella delle parole chiave, disegna la tabella parole
            disegna_ris_parole($riga, $lingua_base, $lingua_trad);
	    }else if($n == 0){
        echo "<h4>"."Non &egrave; stata trovata nessuna traduzione"."<br>"."corrispondente alla parola da te cercata. Riprova!"."</h4>";	
        echo "<h4>"."Consulta queste frasi: "."</h4>"."<br>";		
		}
		echo "</td></tr><tr><td width = 1000>";
		
		if ($n2 != 0){  //se ha trovato un risultato nella tabella delle frasi, disegna la tabella parole
		   if($n == 1)
            echo "<font size=\"4\" color=\"black\"><br><br><b>&nbsp;&nbsp;&nbsp;&nbsp;Frasi in cui è presente parola da te cercata: </b></font><br>";		
		    disegna_ris_frasi($risultato2, $lingua_base, $lingua_trad);		
        }
		echo "</td></tr>";
    
    }	

}
    mysqli_close($connessione);
?>	
	

</body>
    
</html>
















