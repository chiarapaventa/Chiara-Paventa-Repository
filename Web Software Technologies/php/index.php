<html>
    <div>
<?php
    session_start();
    require_once("conn.inc");

    $connessione= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
    if (!$connessione) {
	die("Connection failed: " . mysqli_connect_error());
    }
	
	
    //lancio query per verificare quali lingue sono presenti sul database
	$query_lingue = "SELECT nome FROM lingua";
	$risultato = mysqli_query($connessione, $query_lingue) or die ("Query fallita");
	
	    echo "<br><br><br><br><br><center><form \"".$_SERVER["PHP_SELF"]."\" method = \"post\"><table border = 0 width = 1320 height= 400 bgcolor=\"#f5f5f5\">";
		    echo "<tr>";
			
			
	            echo "<td width=50%>";
			        echo "<center><table border = 0 width = 200>";				
				        //aggiungo solo le lingue presenti del db
			            echo "<tr><td width=500><h2>Inserisci la tua lingua</h2></td></tr>";
					        /*while ($lingua = mysqli_fetch_assoc($risultato)){
                                echo "<tr><td>".$lingua['nome']."&nbsp;&nbsp;<input type=\"radio\" name=\"radio1\" value=".$lingua['nome']."></td></tr>";
					        }*/
								echo "<tr><td>Italiano&nbsp;&nbsp;<input type=\"radio\" name=\"radio1\" value=italiano></td></tr>";
				    echo "</table><br><br><br>";			
			    echo "</td>";
				
	            echo "<td width=50%>";
			        echo "<center><table border=0 width = 200>";				
				        //aggiungo solo le lingue presenti del db
			            echo "<tr><td width=500><h2>Inserisci la lingua da imparare</h2></td></tr>"; 
                            /*mysqli_data_seek($risultato, 0);	
					        while ($lingua = mysqli_fetch_assoc($risultato)){
                                echo "<tr><td>".$lingua['nome']."&nbsp;&nbsp;<input type=\"radio\" name=\"radio2\" value=".$lingua['nome']."></td></tr>";
					        }*/
								echo "<tr><td>Inglese&nbsp;&nbsp;<input type=\"radio\" name=\"radio2\" value=inglese></td></tr>";
				    echo "</table><br>";	
                    
                    echo "<input type=\"submit\" name=\"scegli\" value=\"Scegli\">";
					    if(isset($_POST['scegli'])){
							
							if ((isset($_POST['radio1'])) xor (isset($_POST['radio2']))){
								echo "<br><br>Devi selezionare almeno due lingue";								
							}	
							
                            if(isset($_POST['radio1']) && isset($_POST['radio2'])){
                                $radio1 = $_POST['radio1'];
                                $radio2 = $_POST['radio2'];								
								
							    if ($radio1 == $radio2){
								    echo "<br><br>Devi selezionare due lingue diverse!";
							    }else{
									
								    $_SESSION['lingua_base'] = $radio1;
								    $_SESSION['lingua_trad'] = $radio2;
                                    echo "<br>Variabili di sessione salvate:&nbsp;".$_SESSION['lingua_base']."&nbsp;".$_SESSION['lingua_trad'];		
									header("location: home.php");
							    }
							}
						}
			    echo "</td>";		
			echo "</tr>";
		echo "</table></form>";
    mysqli_close($connessione);
?>	
    </div>
</html>   