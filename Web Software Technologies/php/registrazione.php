<?php
    session_start();
    require_once("conn.inc");
    require_once("pulisci_stringa.php");
?>
<html lang="it">
<body>

 <a href = "home.php"><img src = "../src/home.png"></a> 
<?php
	function aggiungi_utente($connessione,$nome,$cognome,$data_di_nascita,$email,$sesso,$username,$password,$ruolo){
    $sql ="INSERT INTO utente (nome,cognome,data_di_nascita,sesso,email,username,password,ruolo) VALUES
    ('".$nome."','".$cognome."','".$data_di_nascita."','".$sesso."','".$email."','".$username."','".$password."','".$ruolo."')";
	
	
    if($risultato = mysqli_query($connessione, $sql))
        return true;
    else
        return false;
    }
	
if(isset($_POST['iscriviti'])){

	
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

    $nome=pulisci_stringa($nome);
    $cognome=pulisci_stringa($cognome);
    $email=pulisci_stringa($email);
    $username=pulisci_stringa($username);

    if(aggiungi_utente($connessione,$nome,$cognome,$data_di_nascita,$email,$sesso,$username,$password_crypt,"Visitatore"))
    {
    echo "UTENTE AGGIUNTO CON SUCCESSO";
    }else
    {
    echo "RIPROVARE LA REGISTRAZIONE";
    }

    mysqli_close($connessione);
    $connessione=null;
}

?>




   
    <form action ="<?php $_SERVER['PHP_SELF']; ?>" method = "post"><fieldset><legend><h1><code><font face=”Times New Roman, Times, serif”><b>Registrati</b></font></code></h1></legend>
	  
	    <table border=0  bgcolor = "#f5f5f5" width=700 align=center>
			<tr>
			    <td align = center><h3>Il tuo nome</h3>			
			    <input id="nome" name=nome type=text placeholder=Nome style="height:50; width:300;" pattern="[àèéìòùa-zA-Z[\]']{2,}" title="Non inserire caratteri speciali"required onblur="handleOnBlur();"><br><br>
			    <input id="cognome" name=cognome type=text placeholder=Cognome style="height:50; width:300;" pattern="[àèéìòùa-zA-Z\[\]']{2,}" title="Non inserire caratteri speciali" required><br><br></td>
	        </tr>
            <tr>
		        <td align=center><h3>Sesso</h3>
				<select name="sesso">
				<option  value="F">F</option>
		        <option value="M">M</option>	
                </select><br><br>
			</tr>
			<tr>
			    <td align="center"><h3>Data di nascita</h3>
				<input name="giorno" type="number" placeholder=Giorno style="height:50; width:85;" min=1 max=31 pattern=.{2}required>&nbsp;/&nbsp;
				<input name="mese" type="number" placeholder=Mese style="height:50; width:85;" min=1 max=12  pattern=.{2} required>&nbsp;/&nbsp;
				<input name="anno" type="number" placeholder=Anno style="height:50; width:85;" min=1900 pattern=.{2} required><br><br><br></td>
	        </tr>
            <tr>
			   <td align="center"><h3>Email</h3>
				<input name="email" type="text" placeholder="esempio@email.com" style="height:50; width:300;" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  title="Inserisci un'email valida" required><br><br><br><br></td>
	        </tr>
			<tr>
			    <td align="center"><h3>Username</h3>
				<input name="username" type="text" placeholder="username" style="height:50; width:300;" pattern="[a-zA-Z0-9_]{2,30}" title="Puoi inserire solo caratteri, numeri e underscore(_). Max 30" required><br><br>			
			    <h3>Nuova password</h3>
			    <input name="password" type="password" placeholder="password" style="height:50; width:300;" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,8}" title="Deve contenere almeno un carattere maiuscolo, un carattere minuscolo ed un numero. Min 6 caratteri / Max 8 caratteri" required><br><br><br></td>
	        </tr> 
			<tr> 
			    <td align="center"><input name="iscriviti" type="submit" ><br><br><br><br><br><br>
				<input type="reset"  value="Resetta il form"></td>
	        </tr>			
			
	    </table>
		
	</fieldset></form>
	
	<script>
		//ONBLUR
		function handleOnBlur(){
			alert("Hai lasciato la casella di testo ");
		}
		//ONFOCUS
		var cognome = document.getElementById("cognome");
		cognome.addEventListener("focus", function(){
			cognome.style.color = "red";;
		});
	</script>
	</body>
</html>