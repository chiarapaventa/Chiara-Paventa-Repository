<?php
session_start();
if(empty($_SESSION['ruolo']) || strcmp($_SESSION['ruolo'],"Collaboratore")!=0)
header("location: home.php");

//$lingua_base=$_SESSION['lingua_base'];
//$lingua_traduzione=$_SESSION['lingua_trad'];
$lingua_base="italiano";
$lingua_traduzione="inglese";
?>
<html>

<body>

<header>
			<a href="homeamministrator.php"> <img src="../src/home.png"></a>		
</header>

<?php
require_once("conn.inc");
require_once("pulisci_stringa.php");

$connessione= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
if (!$connessione) {
	die("Connection failed: " . mysqli_connect_error());
}

function visualizza_parole_chiave($connessione,$lingua_base,$lingua_traduzione){
	$sql="SELECT * FROM parola_chiave WHERE lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."'";
	$parole=array();
	$risultato=mysqli_query($connessione,$sql);
	for($i=0; $i<mysqli_num_rows($risultato); $i++) {
	mysqli_data_seek($risultato, $i);
	$temp=mysqli_fetch_assoc($risultato);
	$parole[$i]=$temp;
	}
return $parole;
}
function cerca_parole_chiave($connessione,$parola_chiave,$lingua_base,$lingua_traduzione){
	$sql="SELECT parola_chiave FROM parola_chiave WHERE 
	parola_chiave='".$parola_chiave."' and lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."'";
	if($risultato=mysqli_query($connessione,$sql)){
	$riga=mysqli_fetch_row($risultato);
	return $riga;
	}else{
	return false;
	}
}


function num_parola_chiave_p_in_frase($connessione,$parola_chiave){
$sql="SELECT id_parola_chiave FROM parola_chiave WHERE  parola_chiave='".$parola_chiave."'";
$risultato=mysqli_query($connessione,$sql);
if($id_p_c=mysqli_fetch_assoc($risultato)){
$sql="SELECT count(*) FROM frase WHERE  id_parola_chiave='".$id_p_c['id_parola_chiave']."'";
$risultato=mysqli_query($connessione,$sql);
$number=mysqli_fetch_row($risultato);
return implode("",$number);;
}
else
return null;
}


function elimina_parola_chiave($connessione,$parola_chiave,$lingua_base,$lingua_traduzione){
if(((int)num_parola_chiave_p_in_frase($connessione,$parola_chiave))>0)
	return false;
$sql="DELETE FROM parola_chiave WHERE 
parola_chiave= '".$parola_chiave."'and lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."'";
	if($risultato=mysqli_query($connessione,$sql))
		return true;
		else
		return false;
}

function cerca_ultimo_id_parola_chiave($connessione){
$sql="SELECT id_parola_chiave FROM parola_chiave ORDER BY id_parola_chiave DESC LIMIT 1";
if($risultato=mysqli_query($connessione,$sql))
	return mysqli_fetch_assoc($risultato);
else
	return null;
}

function genera_pross_id_parola_chiave($connessione){
if(($id_p=cerca_ultimo_id_parola_chiave($connessione))!=null){
return ++$id_p['id_parola_chiave'];
}
else
return "p000";
}


function inserisci_parola_chiave($connessione,$parola_chiave,$lingua_base,$traduzione,$lingua_traduzione,$file_mp3,$immagine,$categoria){
$id=genera_pross_id_parola_chiave($connessione);
$sql = "INSERT INTO parola_chiave (id_parola_chiave,parola_chiave,lingua_base,traduzione,lingua_traduzione,file_mp3,immagine,categoria)
VALUES ('".$id."','".$parola_chiave."','".$lingua_base."','".$traduzione."','".$lingua_traduzione."','".$file_mp3."','".$immagine."','".$categoria."')";
if($risultato=mysqli_query($connessione,$sql))
		return true;
		else
		return false;
}


$parole=visualizza_parole_chiave($connessione,$lingua_base,$lingua_traduzione);
$num_righe=count($parole);

echo "<fieldset><legend><h1><img src=\"../src/keyword.png\"></h1></legend>";
echo "<center><textarea rows=\"10\" cols=\"100\" readonly>";

for($i=0;$i<$num_righe;$i++){

	echo "Parola chiave : ",$parole[$i]['parola_chiave'],"  Traduzione : ",$parole[$i]['traduzione'],"  Nome audio : ",$parole[$i]['file_mp3'],"  Categoria : ",$parole[$i]['categoria'],"\r\n";
}

echo "</textarea></center></fieldset><br>";

?>



<fieldset><legend><h1>Aggiungi/Modifica/Elimina</h1></legend>
<table align="center"><tr><td><center><h2>Seleziona opzione</h2></center></td></tr><tr><td>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
<select name="select">
  <option value="aggiungi">Aggiungi parola chiave</option>
  <option value="modifica">Modifica parola chiave</option>
  <option value="elimina">Elimina parola chiave</option>
</select>
<input type="submit" name="s" value="Conferma scelta">
</form>
</td></tr>
<?php
echo "<tr><td>";

if(isset($_POST['s'])){
unset($_POST['s']);
$scelta=$_POST['select'];
unset($_POST['select']);
switch ($scelta) {
    case "aggiungi":
	?>
		<form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
		<table border=0>
			   <tr> <td><label for="parola_chiave"> Parola Chiave</label></td><td><input type="text" name="parola_chiave" id="parola_chiave" required></td></tr>
			   <tr> <td><label for="traduzione"> Traduzione</label></td><td><input type="text" name="traduzione" id="traduzione" required></td></tr>
               <tr> <td><label for="file_mp3">File_mp3</label></td>   <td><input type="file" name="file_mp3" required></td></tr>			  
			   <tr> <td><label for="immagine"> Immagine</label></td><td><input type="file" name="immagine" id="immagine" required></td></tr>
			   <tr> <td><label for="categoria">Categoria</label></td><td>
			   <select name="categoria">
					<option value="Nome">Nome</option>
					<option value="Verbo">Verbo</option>
					<option value="Aggettivo">Aggettivo</option>
				</select></td></tr>
			   <tr> <td><input type="submit" name="add" value="Aggiungi"></td>   <td><input type="reset" value="Cancella campi"></td>    </tr>	
			</table>
		
		</form>
        <?php
		break;
		
    case "modifica":
	?>
     <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
      	<table border=0>
			   <tr> <td><label for="parola_chiave"> Parola Chiave</label></td><td><input type="text" name="parola_chiave" id="parola_chiave" required></td></tr>
			   <tr> <td><label for="traduzione"> Traduzione</label></td><td><input type="text" name="traduzione" id="traduzione" required></td></tr>
               <tr> <td><label for="file_mp3">File_mp3</label></td>   <td><input type="file" name="file_mp3" required></td></tr>			  
			   <tr> <td><label for="immagine"> Immagine</label></td><td><input type="file" name="immagine" id="immagine" required></td></tr>
			   <tr> <td><label for="categoria">Categoria</label></td><td>
			   <select name="categoria">
					<option value="Nome">Nome</option>
					<option value="Verbo">Verbo</option>
					<option value="Aggettivo">Aggettivo</option>
				</select></td></tr>
			   <tr> <td><input type="submit" name="mod" value="Modifica"></td>   <td><input type="reset" value="Cancella campi"></td>    </tr>	
			</table>
			</fieldset>

	</form>
		<?php
        break;
    case "elimina":
	?>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <label for="parola_chiave">Parola chiave </label><input type="text" name="parola_chiave">
		<input type="submit" name="eli" value="Elimina">
		</form>
		<?php
        break;
    default:
	echo" Nessuna scelta";
       
}
}
echo "</td></tr>";

if(isset($_POST['add'])){
	
	$parola_chiave=$_POST['parola_chiave'];
	$traduzione=$_POST['traduzione'];
	$file_mp3=$_FILES['file_mp3']['name'];
	$immagine=$_FILES['immagine']['name'];
	$categoria=$_POST['categoria'];
	
	$parola_chiave=pulisci_stringa($parola_chiave);
	$traduzione=pulisci_stringa($traduzione);
	$file_mp3=pulisci_stringa($file_mp3);
	$immagine=pulisci_stringa($immagine);
	
	unset($_POST['add']);
	if(!cerca_parole_chiave($connessione,$parola_chiave,$lingua_base,$lingua_traduzione)){
	if(inserisci_parola_chiave($connessione,$parola_chiave,$lingua_base,$traduzione,$lingua_traduzione,$file_mp3,$immagine,$categoria)){
	   echo "<center><h1>Parola chiave aggiunta con successo</h1></center> <br><br>";
			
		if(is_uploaded_file($_FILES['file_mp3']['tmp_name'])){
        //echo '<br> FILE MP3 SCARICATO CORRETTAMENTE<br>';
		if(move_uploaded_file($_FILES['file_mp3']['tmp_name'], '../src/'.$file_mp3.'')){
		echo $file_mp3." caricato correttamente ! <br>";
		}
		
     }
	  if(is_uploaded_file($_FILES['immagine']['tmp_name'])){
       // echo '<br> FILE IMMAGINE SCARICATO CORRETTAMENTE<br>';
				if(move_uploaded_file($_FILES['immagine']['tmp_name'], '../src/'.$immagine.'')){
				echo $immagine." caricato correttamente ! <br>";
				}
    //  echo '<br> FILE SPOSTATO IN SRC ';
     // echo 'ERRORE<br>';
	  }
			
	}
	else
		echo "<center><h1>Parola chiave non aggiunta con successo</h1></center>";
	
	}else{
	echo "<center><h1>Parola già presente</h1></center> ";
	}
	
	
}
if(isset($_POST['mod'])){
	
	$parola_chiave=$_POST['parola_chiave'];
	$traduzione=$_POST['traduzione'];
	$file_mp3=$_FILES['file_mp3']['name'];
	$immagine=$_FILES['immagine']['name'];
	$categoria=$_POST['categoria'];
	$parola_chiave=pulisci_stringa($parola_chiave);
	$traduzione=pulisci_stringa($traduzione);
	$file_mp3=pulisci_stringa($file_mp3);
	$immagine=pulisci_stringa($immagine);
	
	unset($_POST['mod']);
	if(cerca_parole_chiave($connessione,$parola_chiave,$lingua_base,$lingua_traduzione)){
	if(elimina_parola_chiave($connessione,$parola_chiave,$lingua_base,$lingua_traduzione)){
		if(inserisci_parola_chiave($connessione,$parola_chiave,$lingua_base,$traduzione,$lingua_traduzione,$file_mp3,$immagine,$categoria)){
		echo"<center><h1>Parola chiave modificata correttamente  </h1><center><br><br>";
		
		if(is_uploaded_file($_FILES['file_mp3']['tmp_name'])){
		if(move_uploaded_file($_FILES['file_mp3']['tmp_name'], '../src/'.$file_mp3.'')){
		echo $file_mp3." caricato correttamente ! <br>";
		}
		
     }
	   if(is_uploaded_file($_FILES['immagine']['tmp_name'])){
				if(move_uploaded_file($_FILES['immagine']['tmp_name'], '../src/'.$immagine.'')){
				echo $immagine." caricato correttamente ! <br>";
				}
  
	  }
		
	}else{
	  echo" <center><h1>Parola chiave non è stata modificata correttamente </h1></center> <br><br>";
	}
	}else{
	 	echo"<center><h1>Parola chiave non eliminata<h1></center>";
	}
	}
	else
	{
	echo"<center><h1>Parola chiave non presente</h1></center>";
	}
	
	
}
if(isset($_POST['eli'])){
	$parola_chiave=$_POST['parola_chiave'];
	unset($_POST['eli']);
	$parola_chiave=pulisci_stringa($parola_chiave);

	
	if(cerca_parole_chiave($connessione,$parola_chiave,$lingua_base,$lingua_traduzione)){
	if(elimina_parola_chiave($connessione,$parola_chiave,$lingua_base,$lingua_traduzione))
		echo "<center><h1>Parola chiave eliminata con successo</h1></center>";
	else
		echo"<center><h1>La parola chiave è contenuta in una o più frasi impossibile eliminarla</h1></center>";
	}else{
	echo "<center><h1>Parola chiave non presente<h1></center>";
	}
	
}
	
	
echo"</td></tr>";


?>

</body>




</html>