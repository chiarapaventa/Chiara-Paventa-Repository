<?php
session_start();
if(empty($_SESSION['ruolo']) || strcmp($_SESSION['ruolo'],"Collaboratore")!=0){
header("location: home.php");
}
require_once("conn.inc");
require_once("pulisci_stringa.php");


$lingua_base=$_SESSION['lingua_base'];
$lingua_traduzione=$_SESSION['lingua_trad'];


$connessione= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
if (!$connessione) {
	die("Connection failed: " . mysqli_connect_error());
}

function visualizza_frasi($connessione){
	$sql="SELECT * FROM frase";
	$risultato=mysqli_query($connessione,$sql);
	for($i=0; $i<mysqli_num_rows($risultato); $i++) {
	mysqli_data_seek($risultato, $i);
	$temp=mysqli_fetch_assoc($risultato);
	$parole[$i]=$temp;
	}
return $parole;
}



function elimina_frase($connessione,$id_frase){
$sql="DELETE FROM frase WHERE id_frase= '".$id_frase."'";
	if($risultato=mysqli_query($connessione,$sql))
		return true;
		else
		return false;
}

function inserisci_frase($connessione,$frase,$traduzione,$file_mp3,$id_parola_chiave,$id_lezione,$grammatica){
$sql = "INSERT INTO frase (frase,traduzione,file_mp3,id_parola_chiave,id_lezione,grammatica)
VALUES ('".$frase."','".$traduzione."','".$file_mp3."','".$id_parola_chiave."','".$id_lezione."','".$grammatica."')";
if(mysqli_query($connessione,$sql))
		return true;
		else
		return false;
}
function modifica_frase($connessione,$id_frase,$frase,$traduzione,$file_mp3,$id_parola_chiave,$id_lezione,$grammatica){
$sql="UPDATE frase
SET frase='".$frase."', traduzione='".$traduzione."', file_mp3='".$file_mp3."', id_parola_chiave=".$id_parola_chiave.",grammatica='".$grammatica."'
WHERE id_lezione=".$id_lezione." and id_frase=".$id_frase."";
if($risultato=mysqli_query($connessione,$sql))
		return true;
		else
		return false;
	
	
}



function visualizza_fras_lez($connessione,$id_lezione){
$sql="SELECT frase,traduzione,file_mp3,id_frase,grammatica FROM frase WHERE id_lezione='".$id_lezione."'";
	$lez=array();
	if($risultato=mysqli_query($connessione,$sql)){
	for($i=0; $i<mysqli_num_rows($risultato); $i++) {
	mysqli_data_seek($risultato, $i);
	$temp=mysqli_fetch_assoc($risultato);
	$lez[$i]=$temp;
	}
	
	}
	return $lez;
	
}



function aggiungilezione($connessione,$categoria,$lingua_base,$lingua_traduzione){
$id_liv=cerca_ultimo_id_liv_lez($connessione, $lingua_base,$lingua_traduzione,$categoria);
$id_liv++;
$sql = "INSERT INTO lezione (livello,categoria,lingua_base,lingua_traduzione)
VALUES ('".$id_liv."','".$categoria."','".$lingua_base."','".$lingua_traduzione."')";
if($risultato=mysqli_query($connessione,$sql))
		return true;
		else
		return false;

}

function parole_chiave_disp($connessione,$lingua_base,$lingua_traduzione,$categoria){
$sql="SELECT id_parola_chiave,parola_chiave FROM parola_chiave WHERE lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."'and categoria='".$categoria."'";

if($risultato=mysqli_query($connessione,$sql)){
	$p_disp=array();
	for($i=0; $i<mysqli_num_rows($risultato); $i++) {
	mysqli_data_seek($risultato, $i);
	$temp=mysqli_fetch_assoc($risultato);
	$p_disp[$i]=$temp;
	}
}
return $p_disp;

}

function cerca_id_parola_chiave($connessione,$parola_chiave,$lingua_base,$lingua_traduzione){
$sql="SELECT id_parola_chiave FROM parola_chiave WHERE parola_chiave='".$parola_chiave."' and  lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."'";
if($risultato=mysqli_query($connessione,$sql)){
	$id_parola=mysqli_fetch_assoc($risultato);
		return $id_parola['id_parola_chiave'];
}else
	return null;

}


function id_lez_cat($connessione,$categoria,$lingua_base,$lingua_traduzione){
$temp=array();
$sql="SELECT id_lezione FROM lezione WHERE categoria='".$categoria."' and  lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."'";

if($risultato=mysqli_query($connessione,$sql)){
	for($i=0; $i<mysqli_num_rows($risultato); $i++) {
	$id_liv=mysqli_fetch_assoc($risultato);
    $temp[$i]=$id_liv['id_lezione'];
	}
}
return $temp;
}

function elimina_lezione($connessione,$id_lezione,$lingua_base,$lingua_traduzione){
$sql="DELETE FROM lezione WHERE id_lezione= '".$id_lezione."' and lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."'";
	if($risultato=mysqli_query($connessione,$sql))
		return true;
		else
		return false;
}

function num_liv_lez($connessione,$lingua_base,$lingua_traduzione,$categoria){
$riga=array();
$sql="SELECT count(*) as num_lez FROM lezione WHERE categoria='".$categoria."'and lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."'";
if($risultato=mysqli_query($connessione,$sql)){
$riga=mysqli_fetch_assoc($risultato);
return $riga['num_lez'];
}
return $riga;
}
function cerca_ultimo_id_liv_lez($connessione, $lingua_base,$lingua_traduzione,$categoria){
$riga=array();
$sql="SELECT livello FROM lezione WHERE lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."' and categoria='".$categoria."' ORDER BY livello DESC LIMIT 1";
if($risultato=mysqli_query($connessione,$sql)){
	$riga=mysqli_fetch_assoc($risultato);
	return $riga['livello'];
	}
else
	return $riga;
}

?>
<html>
<header>
	    <nav>
		
			<a href="homeamministrator.php"> <img src="../src/home.png"></a>
			
		</nav>
</header>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
	<table border=0 align="center" cellspacing=5 cellpadding=2><tr><td><h2>Visualizza Lezioni<h2></td></tr>
			<tr><td align="center"><select name="sceltacategoria" >
					<option value="Nome">Lezioni di Nome</option>
					<option value="Verbo">Lezioni di Verbo</option>
					<option value="Aggettivo">Lezioni di Aggettivo</option>
				</select>
		</td></tr>
		<tr><td  align="center">
             <input type="submit" name="sceltalez" value="Conferma">
		</td></tr>
	</table>
</form>



<?php

if(!empty($_POST['sceltalez']) && !empty($_POST['sceltacategoria'])){
$categoria=$_POST['sceltacategoria'];
$_SESSION['categoria']=$categoria;
//Chiamo la funzione num_liv_lez per avere il numeoro di lezioni della stessa categoria
$num_liv=num_liv_lez($connessione,$lingua_base,$lingua_traduzione,$categoria);


echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
		<table border=0 align=\"center\">
		<tr><td><h3>Seleziona lezione da visualizzare</h3></td><tr>
					<tr><td align=\"center\"><select name=\"livello\">";
				//Creo il menu per la scelta della lezione i-esima della categoria
						for($i=0; $i<(int)$num_liv;$i++)
							echo "<option value=\"".($i+1)."\"> ".($i+1)." </option>";
echo 				   "</select></td></tr>
			 <tr><td colspan=2 align=\"center\"><input type=\"submit\" name=\"sublivello\" value=\"Conferma\"></td></tr>
		</table>
	</form>";

}
if((!empty($_POST['sublivello'])&&(!empty($_POST['livello']) && !empty($_SESSION['categoria'])))){

$livello=$_POST['livello'];
$categoria=$_SESSION['categoria'];
//Prelevo l'id della lezione tramite il livello (lezione i-esima della categoria) scelto.
$id_lezioni=id_lez_cat($connessione,$categoria,$lingua_base,$lingua_traduzione);
//Dato l'id della lezione visualizzo le frasi che sono contenute nella lezione
$lez=visualizza_fras_lez($connessione,$id_lezioni[$livello-1]);//Mi prendo l'id lezione con livello scelto dall'utente
echo "<fieldset>
			<legend><h1><img src=\"../src/lesson2.png\"></h1>
			</legend>
				<table border =0 align=\"center\"><tr><td><h2>Lezione di ".$categoria. " n° ".$livello." </h2></td></tr>
					<tr><td>	  
					<textarea rows=\"10\" cols=\"150\" readonly>";
if($lez!=null){
 $count_lez=count($lez);
 for($i=0; $i<$count_lez;$i++){
  echo "Frase ",$i+1,": ",$lez[$i]['frase'],"  Traduzione: ",$lez[$i]['traduzione'],"  Nome audio: ",$lez[$i]['file_mp3'],"\n
  Grammatica Traduzione: ",$lez[$i]['grammatica'],"\n\r";
 }
}else{
echo "<center><h1>Lezione vuota aggiungi frasi alla lezione nell'area apposita in basso</h1></center>";
}
 
echo "</textarea>
		 </td></tr></table>
	 </fieldset>";
}


?>

<fieldset><legend><h1>Aggiungi/Modifica/Elimina</h1></legend>



<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
	<table align="center" colspacing="20" cellpadding=5><tr><td><h2>Seleziona opzione<h2></td></tr>
		<tr><td align="center"> 
			<select name="select" autofocus>
				<option value="aggiungil">Aggiungi lezione</option>
				<option value="eliminal">Elimina lezione</option>
				<option value="aggiungif">Aggiungi frase alla lezione</option>
				<option value="modificaf">Modifica frase alla lezione</option>
				<option value="eliminaf">Elimina frase dalla lezione</option>
			</select>
		</td></tr>
				<tr><td align="center"> 
				<input type="submit" name="s" value="Conferma">
				</td></tr>
	</table>
</form>

<?php

if(isset($_POST['s'])){
	$scelta=$_POST['select'];
switch ($scelta) {
    case "aggiungil":
	?>
		<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
		<table border=0 align="center"><tr> 
		<td><label for="categorial">  <h3>Step 1 Aggiungi lezione / Scegli categoria lezione</h3></label></td></tr>
			   <tr><td align="center">  <select name="categorial">
					<option value="Nome">Nome</option>
					<option value="Verbo">Verbo</option>
					<option value="Aggettivo">Aggettivo</option></td></tr>
				<tr><td align="center"></select><input type="submit" name="aggiungilezione" value="Conferma"></td></tr>
			   
		</table>	
		</form>
		
    
	<?php
        break;
    case "eliminal":
	?>
        
		<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
		<table border=0 align="center"> <tr> <td>
			   <label for="categorial">  <h3>Step 1 Elimina lezione /Scegli categoria lezione</h3></label></td></tr>
			   <tr><td align="center"> <select name="sceltacategoria_el">
					<option value="Nome">Nome</option>
					<option value="Verbo">Verbo</option>
					<option value="Aggettivo">Aggettivo</option></td></tr>
				<tr><td align="center"></select><input type="submit" name="eliminalezione" value="Conferma"></td></tr>
		</table>	   
			
		</form>
		
      </td></tr>
	  <?php
        break;
	case "aggiungif":
	?>
       	<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
	
		<table border=0 align="center">
			   <tr> <td><label for="sceltacategoria"> <h3>Step 1 Aggiungi frase alla lezione /Scegli categoria lezione</h3></label></td></tr>
			   <tr><td align="center">
			   <select name="sceltacategoria">
					<option value="Nome">Nome</option>
					<option value="Verbo">Verbo</option>
					<option value="Aggettivo">Aggettivo</option>
				</select></td></tr>
			   
			   <tr><td align="center"><input type="submit" name="sceltacat" value="Conferma"></td></tr>	
	     </table>
		
		
		</form>

		
	<?php
        break;
		case "eliminaf":
	   ?>
			<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
	
		<table border=0 align="center">
			   <tr> <td><label for="sceltacategoriael">  <h3>Step 1 Elimina frase dalla lezione / Scegli categoria lezione</h3></label></td>
			  <tr><td align="center">
			   <select name="sceltacategoriael">
					<option value="Nome">Nome</option>
					<option value="Verbo">Verbo</option>
					<option value="Aggettivo">Aggettivo</option>
				</select></td></tr>
			   
			   <tr><td align="center"><input type="submit" name="sceltacatel" value="Conferma"></td></tr>	
	     </table>
		</form>

		<?php
		 break;
		case "modificaf":
	   ?>
			<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
	
	<table border=0 align="center">
			   <tr> <td><label for="sceltacategoriamod">   <h3>Step 1 Modifica frase alla lezione /Scegli categoria lezione</h3></label></td></tr>
			     <tr><td align="center">
			   <select name="sceltacategoriamod">
					<option value="Nome">Nome</option>
					<option value="Verbo">Verbo</option>
					<option value="Aggettivo">Aggettivo</option>
				</select></td></tr>
			   
			  <tr><td align="center"><input type="submit" name="sceltacatmod" value="Conferma"></td></tr>	
	     </table>
		</form>
		<?php	
    default:
        
}

}
if(isset($_POST['sceltacatmod']) && !empty($_POST['sceltacategoriamod'])) {

	$categoria=$_POST['sceltacategoriamod'];
	$_SESSION['cat_mod_fras']=$categoria;
	$num_liv=cerca_ultimo_id_liv_lez($connessione,$lingua_base,$lingua_traduzione,$categoria);
	
	 echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
				<table border=0 align=\"center\">
				<tr> <td> <h3>Step 2 Modifica frase alla lezione /Seleziona lezione </h3></td></tr>
			    <tr><td align=\"center\"><select name=\"id_mod\">";

							for($i=0; $i<(int)$num_liv;$i++)
								echo "<option value=\"".($i+1)."\"> ".($i+1)." </option>";
								

			  echo "</select></td></tr>";

echo "<tr><td align=\"center\"><input type=\"submit\" name=\"num_lez_mod\" value=\"Conferma\"></td></tr>	
	</table>
		</form>"; 
		
}

if(isset($_POST['num_lez_mod']) && !empty($_POST['id_mod']) && !empty($_SESSION['cat_mod_fras'])){
	$liv_sel=$_POST['id_mod'];
	$categoria=$_SESSION['cat_mod_fras'];
	$id_lezioni=id_lez_cat($connessione,$categoria,$lingua_base,$lingua_traduzione);
	$id_lezione=$id_lezioni[$liv_sel-1];
	$_SESSION['id_lez_mod']=$id_lezione;

    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\"> 
	 <table border=0 align=\"center\">
	    <tr> <td> <h3>Step 3 Modifica frase alla lezione /Frasi </h3></td></tr>
		<tr><td align=\"center\"> 
		<select name=\"sel_frase_lez\" required>";
			$fras_lez=visualizza_fras_lez($connessione,$id_lezione);
			$count_p=count($fras_lez);
					for($i=0; $i<$count_p;$i++)
					{ 
					echo "<option value=\"".$fras_lez[$i]['id_frase']."\"> ".$fras_lez[$i]['frase']." </option>";
					}
		
				
			echo "</select></td></tr>";	
				if($count_p==0) echo "Nessuna frase presente nella lezione \r\n <a href=\"editlezioni.php\">Aggiungi frase alla lezione</a>";
			echo "<tr><td align=\"center\"><input type=\"submit\" name=\"submodfras\" value=\"Conferma\"> </td></tr>
			</form> ";
			
	
}
if(isset($_POST['submodfras']) && !empty($_POST['sel_frase_lez'])){
$_SESSION['id_fras_sel']=$_POST['sel_frase_lez'];

?>
<form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
		<table border=0 align="center">
		       <tr> <td colspan=2> <h3>Step 4 Modifica frase alla lezione /Modifica Frase </h3></td></tr>
			   <tr> <td><label for="frase"> Frase</label></td><td><input type="text" name="frase" id="frase" required></td></tr>
			   <tr> <td><label for="traduzione"> Traduzione</label></td><td><input type="text" name="traduzione" id="traduzione" required></td></tr>
               <tr> <td><label for="file_mp3">File mp3 frase </label></td> <td><input type="file" name="file_mp3" required></td></tr>
<?php
$categoria=$_SESSION['cat_mod_fras'];
			echo "<tr><td>
			 Parola chiave :
			 </td><td>
			 <select name=\"parola_chiave_mod\" required>";
			$parole=parole_chiave_disp($connessione,$lingua_base,$lingua_traduzione,$categoria);
			$count_p=count($parole);
					for($i=0; $i<$count_p;$i++)
					{ 
					echo "<option value=\"".$parole[$i]['id_parola_chiave']."\"> ".$parole[$i]['parola_chiave']." </option>";
					}
		
				
			echo "</select>";	
				if($count_p==0) echo "Nessuna parola chiave disponibile \r\n <a href=\"parolechiave.php\">Aggiungi parola chiave</a>";
			echo "</td><tr>"; 
		   ?>
			   <tr> <td><input type="submit" name="modfras" value="Modifica"></td>   <td><input type="reset" value="Cancella campi"></td>    </tr>	
			</table>
		
		</form>
		<?php


}

if(isset($_POST['modfras']) && !empty($_POST['frase']) && !empty($_POST['traduzione']) && !empty($_FILES['file_mp3']['name']) 
&& !empty($_SESSION['id_fras_sel']) && !empty($_POST['parola_chiave_mod']) && !empty($_SESSION['id_lez_mod']))	{
	$frase=$_POST['frase'];
	$id_frase=$_SESSION['id_fras_sel'];
	$traduzione=$_POST['traduzione'];
	$file_mp3=$_FILES['file_mp3'];
	$id_parola_chiave=$_POST['parola_chiave_mod'];
	$id_lezione=$_SESSION['id_lez_mod'];
	
		$frase=pulisci_stringa($frase);
	    $traduzione=pulisci_stringa($traduzione);
	
$_SESSION['frase']=$frase;
$_SESSION['traduzione']=$traduzione;
$_SESSION['file_mp3']=$file_mp3;
$_SESSION['id_parola_chiave']=$id_parola_chiave;
//unset($_SESSION['id_livello']);
	//unset($_SESSION['cat_agg_fras']);
    $arr_traduzione = explode(" ", $traduzione);
	$n = 0;
	foreach($arr_traduzione as $j){
	    $n++;
	}
	echo "<form action =\"".$_SERVER['PHP_SELF']."\" method = \"post\">";
	echo "<table align=\"center\" border=0>
	<center><h3>Step 5 Modifica frase alla lezione /Aggiungi Grammatica alla Frase </h3></center>
	<center><h3>Scrivi grammatica ex: Articolo,Pronome,Verbo ecc... </h3></center>
	<tr>";
    for($i=0;$i<$n;$i++){
		echo "<td>".$arr_traduzione[$i]."<br>";
		$str = "text".$i;
	    echo "<input name= \"".$str."\" type=\"text\" required></td>";

	}
	$_SESSION['n_mod']=$n;
	echo "</tr>
	<tr><td colspan=".$n." align=\"center\"><input name=\"invia_mod\" type=\"submit\" value=\"Aggiungi Grammatica\"></td></tr>
	</table>
	</form>";
}


if(isset($_POST['invia_mod']) && !empty($_SESSION['file_mp3']) && !empty($_SESSION['frase'])
&& !empty($_SESSION['traduzione'])&& !empty($_SESSION['id_lez_mod'])&&
!empty($_SESSION['id_parola_chiave'])&& !empty($_SESSION['n_mod'])&&
!empty($_SESSION['cat_mod_fras']) &&!empty($_SESSION['id_fras_sel'])){
	
	$str2 = "text0";
    for($i=0;$i<$_SESSION['n_mod'];$i++){
		if(isset($_POST[$str2]))
        $arr_grammatica[$i] = $_POST[$str2++]." ";
	}		
	$grammatica = implode($arr_grammatica);

$file_mp3=pulisci_stringa($_SESSION['file_mp3']['name']);

if(modifica_frase($connessione,$_SESSION['id_fras_sel'],$_SESSION['frase'],$_SESSION['traduzione'],$file_mp3,$_SESSION['id_parola_chiave'],$_SESSION['id_lez_mod'],$grammatica)){
	if(is_uploaded_file($_SESSION['file_mp3']['tmp_name'])){
        //echo '<br> FILE MP3 SCARICATO CORRETTAMENTE<br>';
		if(move_uploaded_file($_SESSION['file_mp3']['tmp_name'], '../src/'.$_SESSION['file_mp3']['name'].'')){
		echo $file_mp3." caricato correttamente ! <br>";
		}
	}
echo "<center><h1>Frase modificata con successo alla lezione !</h1></center>";
}else{
echo "<center><h1>Frase non modificata con successo alla lezione !</h1></center>";	

}



}


if(isset($_POST['sceltacatel']) && !empty($_POST['sceltacategoriael'])) {

	$categoria=$_POST['sceltacategoriael'];
	$_SESSION['cat_el_fras']=$categoria;
	$num_liv=cerca_ultimo_id_liv_lez($connessione,$lingua_base,$lingua_traduzione,$categoria);
	 echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
	 <table border=0 align=\"center\">
	 <tr> <td> <h3>Step 2 Elimina frase alla lezione /Seleziona lezione </h3></td></tr>
	 <tr><td align=\"center\"><select name=\"id_el\">";

				for($i=0; $i<(int)$num_liv;$i++)
					echo "<option value=\"".($i+1)."\"> ".($i+1)." </option>";
  

			echo "</select></td></tr>
				<tr><td align=\"center\"><input type=\"submit\" name=\"num_lez_el\" value=\"Conferma\"></td></tr>
	</table>
				</form>"; 
		
}

if(isset($_POST['num_lez_el']) && !empty($_POST['id_el']) && !empty($_SESSION['cat_el_fras'])){
	$liv_sel=$_POST['id_el'];
	$categoria=$_SESSION['cat_el_fras'];
	$id_lezioni=id_lez_cat($connessione,$categoria,$lingua_base,$lingua_traduzione);
	$id_lezione=$id_lezioni[$liv_sel-1];
    $_SESSION['id_lez_elim']=$id_lezione;
	
   	$frasi=visualizza_fras_lez($connessione,$id_lezione);
	$count_frasi=count($frasi);
	
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
	<table border=0 align=\"center\">
	<tr> <td> <h3>Step 3 Elimina frase alla lezione /Frasi </h3></td></tr>
	<tr><td align=\"center\"><select name=\"frase_el\">";
								for($i=0; $i<$count_frasi;$i++)
										echo "<option value=\"".$frasi[$i]['id_frase']."\"> ".$frasi[$i]['frase']." </option>";
    
	echo 
	"</select></td></tr>
	
	<tr><td align=\"center\"><input type=\"submit\" name=\"subelfras\" value=\"Elimina\"></td></tr>
	</table>
	</form> ";
	
}
if(isset($_POST['subelfras']) && !empty($_POST['frase_el']) && !empty($_SESSION['id_lez_elim'])){

if(elimina_frase($connessione,$_POST['frase_el'],$_SESSION['id_lez_elim']))
echo "<center><h1>Frase eliminata con successo !</h1></center>";
else
echo "<center><h1>Frase non eliminata con successo !</h1></center>";	

}





if(isset($_POST['aggiungilezione'])){
	unset($_POST['aggiungilezione']);
	$categoria=$_POST['categorial'];
	
	unset($_POST['categorial']);
	if(aggiungilezione($connessione,$categoria,$lingua_base,$lingua_traduzione)){
		echo "<center><h1>Lezione aggiunta con successo</h1></center>";
	
	}
	else
		echo "<center><h1>Lezione non aggiunta con successo</h1></center>";
	
	
}
if(isset($_POST['sceltacat'])){

$categoria=$_POST['sceltacategoria'];
$num_liv=cerca_ultimo_id_liv_lez($connessione,$lingua_base,$lingua_traduzione,$categoria);
$_SESSION['cat_agg_fras']=$categoria;
$_SESSION['number_id_lez']=$num_liv;

echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
			<table border=0 align=\"center\">
			<tr> <td> <h3>Step 2 Aggiungi frase alla lezione /Seleziona lezione </h3></td></tr>

			<tr><td align=\"center\"><select name=\"id\">";

					for($i=0; $i<(int)$num_liv;$i++)
							echo "<option value=\"".($i+1)."\"> ".($i+1)." </option>";
  

echo "</select></td></tr>

<tr><td align=\"center\"><input type=\"submit\" name=\"num_lez\" value=\"Conferma\"></td></tr>	
</table>
</form>";
}
if(isset($_POST['num_lez'])){
	$_SESSION['id_livello']=$_POST['id'];
	
?>


<form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
		 <table border=0 align="center">
		 <tr> <td colspan=2> <h3>Step 3 Aggiungi frase alla lezione <?php echo $_SESSION['id_livello'];?></h3></td></tr>
			   <tr> <td><label for="frase"> Frase</label></td><td><input type="text" name="frase" id="frase" required></td></tr>
			   <tr> <td><label for="traduzione"> Traduzione</label></td><td><input type="text" name="traduzione" id="traduzione" required></td></tr>
               <tr> <td><label for="file_mp3">File mp3 frase </label></td> <td><input type="file" name="file_mp3" required></td></tr>
<?php
            $categoria=$_SESSION['cat_agg_fras'];
			
			echo "<tr><td>";
			echo "Parola chiave: ";
			echo "</td><td>";
			echo " <select name=\"parola_chiave\" required>";
			$parole=parole_chiave_disp($connessione,$lingua_base,$lingua_traduzione,$categoria);
			$count_p=count($parole);
					for($i=0; $i<$count_p;$i++)
					{ 
					echo "<option value=\"".$parole[$i]['id_parola_chiave']."\"> ".$parole[$i]['parola_chiave']." </option>";
					}
		
			echo "</select></td></tr>";	
				if($count_p==0) echo "<tr><td colspan=2>Nessuna parola chiave disponibile <br> <a href=\"parolechiave.php\">Aggiungi parola chiave</a></td></tr>";
			 
?>			   
			   <tr> <td><input type="submit" name="aggiungifras" value="Aggiungi"></td><td><input type="reset" value="Cancella campi"></td>    </tr>	
			</table>
		
		</form>
<?php
}

if(isset($_POST['aggiungifras'])){
	
	//unset($_POST['aggiungifras']);
	$frase=$_POST['frase'];
	$traduzione=$_POST['traduzione'];
	$file_mp3=$_FILES['file_mp3'];
	$id_parola_chiave=$_POST['parola_chiave'];
	
		$frase=pulisci_stringa($frase);
	    $traduzione=pulisci_stringa($traduzione);
	
$_SESSION['frase']=$frase;
$_SESSION['traduzione']=$traduzione;
$_SESSION['file_mp3']=$file_mp3;
$_SESSION['id_parola_chiave']=$id_parola_chiave;
//unset($_SESSION['id_livello']);
	//unset($_SESSION['cat_agg_fras']);
	

    $arr_traduzione = explode(" ", $traduzione);
	$n = 0;
	foreach($arr_traduzione as $j){
	    $n++;
	}
	echo "<form action =\"".$_SERVER['PHP_SELF']."\" method = \"post\">
	<table align=\"center\" border=0>
	<center><h3>Step 4 Aggiungi frase alla lezione /Aggiungi Grammatica alla Frase </h3></center>
	<center><h3>Scrivi grammatica ex: Articolo,Pronome,Verbo ecc... </h3></center>
	<tr>";
    for($i=0;$i<$n;$i++){
		echo "<td align=\"center\">".$arr_traduzione[$i]."<br>";
		$str = "text".$i;
	    echo "<input name= \"".$str."\" type=\"text\" required></td>";

	}
	$_SESSION['n']=$n;
	echo "</tr>
		<tr><td colspan=".$n." align=\"center\"><input name=\"invia\" type=\"submit\" value=\"Aggiungi Grammatica\"></td></tr>
		</table>
		
		</form>";
}


if(isset($_POST['invia']) && !empty($_SESSION['frase'])&& !empty($_SESSION['traduzione'])&& 
!empty($_SESSION['file_mp3'])&& !empty($_SESSION['id_parola_chiave'])&& !empty($_SESSION['id_livello'])
&& !empty($_SESSION['cat_agg_fras'])&& !empty($_SESSION['n'])){
	
	$str2 = "text0";
    for($i=0;$i<$_SESSION['n'];$i++){
		if(isset($_POST[$str2]))
        $arr_grammatica[$i] = $_POST[$str2++]." ";
	}		
	$grammatica = implode($arr_grammatica);


$liv_sel=$_SESSION['id_livello'];
$categoria=$_SESSION['cat_agg_fras'];
   $file_mp3=pulisci_stringa($_SESSION['file_mp3']['name']); 

$id_lezioni=id_lez_cat($connessione,$categoria,$lingua_base,$lingua_traduzione);
$id_lezione=$id_lezioni[$liv_sel-1];
if(inserisci_frase($connessione,$_SESSION['frase'],$_SESSION['traduzione'],$file_mp3,$_SESSION['id_parola_chiave'],$id_lezione,$grammatica)){
	if(is_uploaded_file($_SESSION['file_mp3']['tmp_name'])){
        //echo '<br> FILE MP3 SCARICATO CORRETTAMENTE<br>';
		if(move_uploaded_file($_SESSION['file_mp3']['tmp_name'], '../src/'.$file_mp3.'')){
		echo $file_mp3," caricato correttamente ! <br>";
		}
	}
echo "<center><h1>Frase inserita correttamente alla lezione</h1></center>";
}else{
echo "<center><h1>Frase non inserita correttamente alla lezione</h1></center>";
}

}





if(!empty($_POST['eliminalezione'])){
$categoria=$_POST['sceltacategoria_el'];
$_SESSION['categoria_el']=$categoria;
$num_liv= num_liv_lez($connessione,$lingua_base,$lingua_traduzione,$categoria);

echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
			<table border=0 align=\"center\">
					<tr> <td> <h3>Step 2 Elimina lezione /Seleziona lezione </h3></td></tr>
					<tr><td align=\"center\"><select name=\"id\">";

									for($i=0; $i<(int)$num_liv;$i++)
										echo "<option value=\"".($i+1)."\"> ".($i+1)." </option>";
  

echo "</select></td></tr>
			<tr><td align=\"center\"><input type=\"submit\" name=\"num_lez_el\" value=\"Conferma\"></td></tr>
			</table>
	
	</form>";

}

if(!empty($_POST['num_lez_el']) && !empty($_SESSION['categoria_el'])&& !empty($_POST['id'])){
	$id_lez=id_lez_cat($connessione,$_SESSION['categoria_el'],$lingua_base,$lingua_traduzione);
	$livello=$_POST['id'];
	$id_lezione= $id_lez[$livello-1];
	
if(elimina_lezione($connessione,$id_lezione,$lingua_base,$lingua_traduzione))
	echo "<center><h1>Lezione eliminata con successo</h1></center>";
else
	echo "<center><h1>La Lezione contiene frasi all'interno elimina tutte le frasi per eliminarla</h1></center>";

}



?>
</td></tr>
</table>
</fieldset>
</html>