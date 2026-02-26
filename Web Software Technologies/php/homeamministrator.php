<?php
session_start();
if(empty($_SESSION['ruolo']) || strcmp($_SESSION['ruolo'],"Collaboratore")!=0){
header("location: home.php");
}
?>
<html>
<header>
		<hgroup>
		</hgroup>
		<nav>
			<a href="home.php"> <img src="../src/home.png"></a>
		</nav>
	
</header>
<table align="center" cellspacing="60" >
<tr><td><center><h3>GESTIONE UTENTI</h3></center></td><td><center><h3>GESTIONE PAROLE CHIAVE</h3></center></td><td><center><h3>GESTIONE LEZIONI</h3></center></td><td><center><h3>GESTIONE LINGUE</h3></center></td></tr>
<tr><td><a href="../php/aggutente.php"><center><img src="../src/utente.png"></center><a>  </td><td><a href="../php/parolechiave.php"><center><img src="../src/keyword.png"></a></center></td><td><a href="../php/editlezioni.php"><center><img src="../src/lesson.png"></center></td>
<td><a href="../php/gest_lingua.php"><center><img src="../src/lingue.png"></center></td>
</tr>
</table>
</html>