<?php
	require_once('funzioni.php');
	require_once('conn.inc');
	session_start();
		
	$connection= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
    if (!$connection) {
	    die("Connection failed: " . mysqli_connect_error());
    }
    
     
    ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Risultati Quiz</title>
	</head>
	<body>
	    <a href="home.php"><img src="../src/home.png"></a>
		<div align="center">
			
			
			<?php
				//se l'utente è registrato 
				if(!empty($_SESSION['username']) && !empty($_SESSION['ruolo'])){
					$countq='SELECT COUNT(*) FROM quizerrati WHERE username="'.$_SESSION['username'].'"';
		            $rgh=mysqli_query($connection, $countq);
		            $num=mysqli_fetch_row($rgh)[0];
		            

		            
					if($num!=0){
						$_SESSION['finito errati']=0;
						
						echo "<h1>Gli errori fatti nel quiz sono:</h1>";
						score($connection,$num,$_SESSION['username']);
                        echo "<h1>Punteggio</h1><br><h2>".$_SESSION['countCorrect']." risposte corrette <br> su <br>".$_SESSION['countq']." domande</h2>";
					}else{
						echo "<h1>Punteggio</h1><br><h2>".$_SESSION['countCorrect']." risposte corrette <br> su <br>".$_SESSION['countq']." domande</h2>";
						
					}
										
				}else{
					echo "<h1>Punteggio</h1><br><h2>".$_SESSION['countCorrect']." risposte corrette <br> su <br>".$_SESSION['countq']." domande</h2>";
					
				}
			?>
	    </div>
	</body>
</html>