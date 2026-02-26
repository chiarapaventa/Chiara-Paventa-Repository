<?php
session_start();
if(empty($_SESSION['ruolo']) || strcmp($_SESSION['ruolo'],"Collaboratore")!=0)
header("location: home.php");
require_once("pulisci_stringa.php");

if(isset($_GET['msg']))
		echo '<b>'.htmlentities($_GET['msg']).'</b><br /><br />';
	
require_once("conn.inc");

function aggiungi_utente($connessione,$nome,$cognome,$data_di_nascita,$email,$sesso,$username,$password,$ruolo){
    $sql ="INSERT INTO utente (nome,cognome,data_di_nascita,sesso,email,username,password,ruolo) VALUES
    ('".$nome."','".$cognome."','".$data_di_nascita."','".$sesso."','".$email."','".$username."','".$password."','".$ruolo."')";

    if($risultato = mysqli_query($connessione, $sql))
        return true;
    else
        return false;
    }



if(isset($_POST['s'])){
	
$connessione= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
if (!$connessione) {
	die("Connection failed: " . mysqli_connect_error());
}

$nome=$_POST['nome'];
$cognome=$_POST['cognome'];
$giorno=$_POST['giorno'];
$mese=$_POST['mese'];
$anno=$_POST['anno'];
$data_di_nascita=$anno."-".$mese."-".$giorno;
$sesso=$_POST['sesso'];
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
$password_crypt = password_hash($password, PASSWORD_DEFAULT);
$ruolo=$_POST['ruolo'];

$nome=pulisci_stringa($nome);
$cognome=pulisci_stringa($cognome);
$email=pulisci_stringa($email);
$username=pulisci_stringa($username);

echo "Nome";
if(aggiungi_utente($connessione,$nome,$cognome,$data_di_nascita,$email,$sesso,$username,$password_crypt,$ruolo))
{
echo "UTENTE AGGIUNTO CON SUCCESSO";
$id_inserito = mysqli_insert_id($connessione);
$messaggio = urlencode("Inserimento effettuato con successo (ID=$id_inserito)");
	header('location: '.$_SERVER['PHP_SELF'].'?msg='.$messaggio);
}else
{
echo "ERRORE NELL'INSERIMENTO DELL'UTENTE RIPROVARE";
}

mysqli_close($connessione);
$connessione=null;
}

?>

<html>
<body>
<header>
<a href="homeamministrator.php"> <img src="../src/home.png"> </a>
</header>

<form method="POST" action="<?php $_SERVER['PHP_SELF']?>" autocomplete="on">
<fieldset>
			<legend>
			<h1>Aggiungi utente</h1>
			</legend>
			<table border=0>
			   <tr> <td><label for="nome"> Nome</label></td><td><input type="text" name="nome" id="nome" placeholder="Carlo" pattern="[àèéìòùa-zA-Z[\]']{2,}" title="Non inserire caratteri speciali" required></td></tr>
			   
			   <tr> <td><label for="cognome"> Cognome</label></td><td><input type="text" name="cognome" id="cognome" placeholder="Rossi" pattern="[àèéìòùa-zA-Z\[\]']{2,}" title="Non inserire caratteri speciali" required></td></tr>
			   
               <tr> 
		        <td align=center>Sesso
				<select name="sesso">
				<option  value="F">F</option>
		        <option value="M">M</option>	
                </select><br><br>
			  </tr>	
			   
			  <tr> <td><label for="username"> Username</label></td><td><input type="text" name="username" placeholder="username"  id="username" pattern="[a-zA-Z0-9_]{2,30}" title="Puoi inserire solo caratteri, numeri e underscore(_). Max 30" required></td></tr>
			  
			   <tr> <td><label for="password">Password</label></td>   <td><input type="password" name="password" placeholder="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,8}" title="Deve contenere almeno un carattere maiuscolo, un carattere minuscolo ed un numero. Min 6 caratteri / Max 8 caratteri" required></td>   </tr>
			   
			  <tr>
			    <td align="center"><h3>Data di nascita</h3>
				<input name="giorno" type="number" placeholder="Giorno"  min=1 max=31 pattern=.{2}required>&nbsp;/&nbsp;
				<input name="mese" type="number" placeholder="Mese" min=1 max=12  pattern=.{2} required>&nbsp;/&nbsp;
				<input name="anno" type="number" placeholder="Anno"  min=1900 pattern=.{2} required><br><br><br></td>
	          </tr>
			   
			   <tr> <td><label for="email">Email</label></td>   <td><input type="email" name="email" placeholder="nome@dominio" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  title="Inserisci un'email valida" required></td></tr>
			   
			    <tr> <td><label for="datalist">Scegli Ruolo</label></td>   <td>
				
				<select name="ruolo" required>	
			    <option value="Visitatore">Visitatore</option>
				<option value="Collaboratore">Collaboratore</option>
				</td></tr>
				
			   <tr> <td><input type="submit" value="Aggiungi utente" name="s"></td>   <td><input type="reset" value="Cancella campi"></td>    </tr>	
			</table>

</fieldset>

</form>
</body>

</html>
