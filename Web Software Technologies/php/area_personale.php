<?php
	session_start();
	require_once('funzioni.php');
	require_once('conn.inc');
	if(empty($_SESSION['ruolo']) && empty($_SESSION['username']))
      header("location: home.php");
	
	$connection= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
    if (!$connection) {
	    die("Connection failed: " . mysqli_connect_error());
    }


		if(isset($_SESSION['info'])){
		
	}else{
		$_SESSION['info']="";
	}

	
	
	
?>
<!DOCTYPE html>

<html>

<head>
	<title>Area Personale</title>
		
</head> 
	
<body>
	
	<link rel="stylesheet"
		  type="text/css"
		  href="../css/cssAreaPersonale.css"
	>
	
	<a href="home.php"><img src="../src/home.png"></a><br><br><br>
	
	
	<div style="overflow-x:auto;">
	
		<center>
		<table id="tabella">
		
			<tr>
				<td><img name="profilo" src="../src/profilo.png"  onclick="showInfo()"></td>
				<td><img name="errori" src="../src/risultati.png"  onclick="showResults()"></td>
			</tr>
	
	
			<tr>
	
				<td>
				<center>
				<table id="info" name="info" >	
				<?php userinformation($name,$surname,$birthday,$gender,$email,$user,$connection,$role,$_SESSION['username']);?>
		
				<form name="form" action="ChangeInfo.php" method="post"> 	
					<tr>
						<td><b>Nome</b></td>&emsp;
						<td><?php echo $name;?></td>&emsp;&emsp;
						<td><input type="submit" name="modifyName" value="Modifica il tuo nome"></td>
					</tr>
					<tr>
						<td><b>Cognome</b></td>&emsp;
						<td><?php echo $surname;?></td>&emsp;&emsp;
						<td><input type="submit" name="modifySurname" value="Modifica il tuo cognome"></td>
					</tr>
					<tr>
						<td><b>Username</b></td>&emsp;
						<td><?php echo $user;?></td>&emsp;&emsp;
						<td><input type="submit" name="modifyUsername" value="Cambia Username"></td>
					</tr>
					<tr>
						<td><b>Data di Nascita</b></td>&emsp;
						<td><?php echo $birthday;?></td>&emsp;&emsp;
						<td><input type="submit" name="modifyDate" value="Modifica data di nascita"></td>
					</tr>
					<tr>
						<td><b>Sesso</b></td>&emsp;
						<td><?php echo $gender;?></td>&emsp;&emsp;
						<td><input type="submit" name="modifyGender" value="Modifica"></td>
					</tr>
					<tr>
						<td><b>email</b></td>&emsp;
						<td><?php echo $email;?></td>&emsp;&emsp;
						<td><input type="submit" name="modifyEmail" value="Cambia email"></td>
					</tr>
						<tr><td><b>Password</b></td>&emsp;
						<td></td>&emsp;&emsp;<td><input type="submit" name="modifyPassword" value="Cambia Password"></td>
					</tr>
					<tr>
						<td><b>Ruolo</b></td>&emsp;
						<td><?php echo $role;?></td>
					</tr>
				</form>
			    </table>
	
				<br><br><br><img src="../src/logoPiccolo.png"><img src="../src/logoPiccolo.png"><img src="../src/logoPiccolo.png"><br><br><br>
				</td>
	
				<td>  
					<center>
					<table id="errors">
					<tr>
						<?php  
						$countq = 'SELECT COUNT(*) FROM quizerrati WHERE username="'.$_SESSION['username'].'"';
						$rgh = mysqli_query($connection, $countq);
						$num = mysqli_fetch_row($rgh)[0];

						if($num != 0){
							echo "<td align=\"center\"><h1>Gli errori fatti nel quiz sono:</h1>";
							score($connection,$num,$_SESSION['username']);
							echo "</td></tr>";
						}	
			
						if(isset($_SESSION['countCorrect']) && isset($_SESSION['countq'])){
							echo "<tr><td align=\"center\"><h1>Punteggio</h1><br><h2>".$_SESSION['countCorrect']." risposte corrette <br> su <br>".$_SESSION['countq']." 					domande</h2></td></tr>";
						}
						?>
		
					</table>
					<br><br><br><img src="../src/logoPiccolo.png"><img src="../src/logoPiccolo.png"><img src="../src/logoPiccolo.png"><br><br><br>
				</td>
	
			</tr>
	
		</table>

	<div>
	
	
<script type="text/javascript">	
	function showInfo(){
		var elem = document.getElementById("info");
		if (elem.style.visibility == "hidden") {
			elem.style.visibility = "visible";
		} else {
			elem.style.visibility = "hidden";			
		}
	}
	
	function showResults() {
		var elem = document.getElementById("errors");
		if (elem.style.display == "none") {
			elem.style.display = "inline-block";
		} else {
			elem.style.display = "none";			
		}
	}
</script>


</body>


</html>