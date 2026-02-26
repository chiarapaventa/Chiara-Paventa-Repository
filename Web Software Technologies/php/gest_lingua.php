<?php
session_start();
if(empty($_SESSION['ruolo']) || strcmp($_SESSION['ruolo'],"Collaboratore")!=0)
header("location: home.php");

require_once("conn.inc");
$connessione= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
if (!$connessione) {
	die("Connection failed: " . mysqli_connect_error());
}


function aggiungi_lingua($connessione,$lingua,$nome_immagine){
$sql = "INSERT INTO lingua (nome,immagine)
VALUES ('".$lingua."','".$nome_immagine."')";
if($risultato=mysqli_query($connessione,$sql))
		return true;
		else
		return false;
}
function lingua_disponibile($connessione){
	$lingua=array();
	$sql = "SELECT nome FROM lingua";
	$risultato=mysqli_query($connessione,$sql);
	for($i=0; $i<mysqli_num_rows($risultato); $i++) {
	mysqli_data_seek($risultato, $i);
	$temp=mysqli_fetch_assoc($risultato);
	$lingua[$i]=$temp['nome'];
	}
return $lingua;
}
function elimina_lingua($connessione,$nome_lingua){
$sql = "DELETE FROM lingua
WHERE nome = '".$nome_lingua."'";
	if($risultato=mysqli_query($connessione,$sql))
		return true;
		else
		return false;
}
function contr_lingua_in_lezione($connessione,$nome_lingua){
$sql = "SELECT count(*) as num_lin_lez FROM lezione WHERE lingua_base='".$nome_lingua."' or lingua_traduzione='".$nome_lingua."'";
$risultato=mysqli_query($connessione,$sql);
$temp=mysqli_fetch_assoc($risultato);
if($temp['num_lin_lez']>0)
return false;
else
return true;
}


function contr_lingua_in_parola_chiave($connessione,$nome_lingua){
$sql = "SELECT count(*) as num_lin_lez FROM parola_chiave WHERE lingua_base='".$nome_lingua."' or lingua_traduzione='".$nome_lingua."'";
$risultato=mysqli_query($connessione,$sql);
$temp=mysqli_fetch_assoc($risultato);
if($temp['num_lin_lez']>0){
return false;
}
else
return true;

}

?>
<html>
<header>
	    <nav>
		
			<a href="homeamministrator.php"> <img src="../src/home.png"></a>
			
		</nav>
</header>
<body>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
<table align="center" border=0 cellspacing=50>
<tr><td align="center"><h2>Gestione lingua<h2></td></tr>
<tr><td align="center"><select name="op_lingua">
  <option value="aggiungi">Aggiungi lingua</option>
  <option value="elimina">Elimina lingua </option>
</select></td></tr>
<tr><td align="center"><input type="submit" name="gest_lingua" value="Conferma"></td></tr>
</table>

</form>
<?php
if(isset($_POST['gest_lingua']) && !empty($_POST['op_lingua'])){

if($_POST['op_lingua']=="aggiungi"){
echo 
"<form action=".$_SERVER['PHP_SELF']." method=\"POST\"  enctype=\"multipart/form-data\">
<table align=\"center\" border=0 cellspacing=20>
<tr><td>Aggiungi lingua</td><td><input type=\"text\" name=\"lingua\" required></td></tr>
<tr><td><label for=\"img_lingua\">Immagine lingua </label></td><td><input type=\"file\" name=\"img_lingua\" required></td></tr>
<tr><td colspan=2 align=\"center\"><input type=\"submit\" name=\"agg_lingua\" value=\"Aggiungi\" ></td></tr>
</table>
</form>";
	
}else if($_POST['op_lingua']=="elimina"){
	
	$lingue=lingua_disponibile($connessione);
	$count_lin=count($lingue);
	echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
	<table align=\"center\" border=0 cellspacing=20>
		<tr><td><h3> Seleziona lingua da eliminare</h3> </td></tr>
		<tr><td align=\"center\"><select name=\"ling_elim\">";

	for($i=0; $i<(int)$count_lin;$i++) 
	echo "<option value=\"".$lingue[$i]."\"> ".$lingue[$i]." </option>";

echo "</select> </td></tr>
<tr><td align=\"center\">
<input type=\"submit\" name=\"sub_ling_elim\" value=\"Elimina\"> 
</td></tr>

</form>"; 
	
		
}

}

if(isset($_POST['agg_lingua']) && !empty($_POST['lingua']) && !empty($_FILES['img_lingua']['name'])){
$nome_lingua=$_POST['lingua'];
$nome_immagine=$_FILES['img_lingua']['name'];

if(aggiungi_lingua($connessione,$nome_lingua,$nome_immagine)){
	    echo "Lingua aggiunta con successo <br>";
			if(is_uploaded_file($_FILES['img_lingua']['tmp_name'])){
        //echo '<br> FILE MP3 SCARICATO CORRETTAMENTE<br>';
		if(move_uploaded_file($_FILES['img_lingua']['tmp_name'], '../src/'.$nome_immagine.'')){
		echo $nome_immagine." caricato correttamente ! <br>";
		}
	}	
}
else
	echo "<center><h1>Lingua non aggiunta con successo</h1></center>";
}

if(isset($_POST['sub_ling_elim']) && !empty($_POST['ling_elim']) ){
$nome_lingua=$_POST['ling_elim'];
if(contr_lingua_in_lezione($connessione,$nome_lingua) && contr_lingua_in_parola_chiave($connessione,$nome_lingua)){

	if(elimina_lingua($connessione,$nome_lingua))
	echo "<center><h1>Lingua eliminata con successo !</h1><center>";
	else
	echo "<center><h1>Lingua non eliminata con successo !</h1></center>";	

}else
echo "<center><h1>Non è possibile eliminare la lingua perchè è presente nelle lezioni e\o parole chiave</h1></center>";

}

?>


</body>
</html>