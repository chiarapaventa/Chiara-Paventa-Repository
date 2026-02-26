<?php
session_start();
$lingua_base=$_SESSION['lingua_base'];
$lingua_traduzione=$_SESSION['lingua_trad'];



function estrai_righe_frasi($connessione,$id_lezione){
//Query per estrarre frasi e traduzioni
$temp=array();
$sql ="SELECT * FROM frase WHERE id_lezione='".$id_lezione."'";
if($risultato = mysqli_query($connessione, $sql)){
for($i=0; $i<mysqli_num_rows($risultato); $i++) {
mysqli_data_seek($risultato, $i);
//Elaborazione della riga corrente
$riga=mysqli_fetch_row($risultato); //Array pos 0 frase pos 1 traduzione
//Utilizzo dei dati estrapolati
$temp[$i]=$riga; //Array bidimensionale per contenere tutte le frasi e traduzioni

}
}
return $temp;
}

function estrai_id_lezioni($connessione,$categoria,$lingua_base,$lingua_traduzione){
$temp=array();
//Query per estrarre frasi e traduzioni
$sql ="SELECT id_lezione from lezione where categoria='".$categoria."' and lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."'";
if($risultato = mysqli_query($connessione, $sql)){
$riga=mysqli_fetch_row($risultato);
for($i=0; $i<mysqli_num_rows($risultato); $i++) {
mysqli_data_seek($risultato, $i);
//Elaborazione della riga corrente
$riga=mysqli_fetch_assoc($risultato); //Array pos 0 frase pos 1 traduzione
//Utilizzo dei dati estrapolati
$temp[$i]=$riga['id_lezione']; //Array bidime
}
return $temp;
}
}
function estrai_parole_chiave($connessione,$id_parola_chiave,$lingua_base,$lingua_traduzione){
$sql="SELECT  parola_chiave,traduzione,immagine from parola_chiave  WHERE id_parola_chiave='".$id_parola_chiave."' and  lingua_base='".$lingua_base."' and lingua_traduzione='".$lingua_traduzione."'";
if($risultato=mysqli_query($connessione,$sql)){
return mysqli_fetch_assoc($risultato);

}
else
	return null;
}

function salva_progressi_utente($connessione,$username,$id_lezione,$categoria){
$sql="UPDATE utente SET id_lezione='".$id_lezione."',categoria='".$categoria."' WHERE username='".$username."'";
if($risultato=mysqli_query($connessione,$sql))
return true;
else
return false;
}


function preleva_id_categoria($connessione,$username){
$sql="SELECT id_lezione,categoria FROM utente WHERE username='".$username."'";
if($risultato=mysqli_query($connessione,$sql))
return mysqli_fetch_assoc($risultato);
else
return null;
}


function preleva_pagina_utente($connessione,$categoria,$id_lezione,$lingua_base,$lingua_traduzione){
$lezioni=estrai_id_lezioni($connessione,$categoria,$lingua_base,$lingua_traduzione);
$count_lez=count($lezioni);
$i=0;
if($count_lez!=0){
while(($lezioni[$i]!=$id_lezione)){
$i++;
}

if($i<$count_lez-1)
	return $i;
else
	return 0;
}else
	return 0;
}

function disegna_tabella_traduzioni($traduzione, $grammatica){
		$traduzione = explode(" ", $traduzione);
		$grammatica = explode(" ", $grammatica);
	    echo "<table border=0><tr>";
		    foreach($traduzione as $t){
		        echo "<td>".$t."</td>";
		    }
		    echo "</tr><tr>";
			foreach($grammatica as $g){
				echo "<td>".$g."</td>";
			}
		 echo "</tr></tr></table>";
	}	




if(isset($_POST['Nome'])){
$categoria="Nome";
$_SESSION['categoria']=$categoria;
unset($_POST['Nome']);
}
else if(isset($_POST['Verbo'])){
$categoria="Verbo";
$_SESSION['categoria']=$categoria;
unset($_POST['Verbo']);
}
else if(isset ($_POST['Aggettivo'])){
$categoria="Aggettivo";
$_SESSION['categoria']=$categoria;
unset($_POST['Aggettivo']);
}else if(empty($_SESSION['categoria'])){
header("location: sceglilezione.php");
}



?>
<html>

<body>

<header>
 <a href="home.php"> <img src="../src/home.png"></a>
<span style="font-family:arial">
	<nav>
			<ul> 
				<li> <a href="sceglilezione.php"> Vai alle lezioni </a> </li>

			</ul>
		</nav>
		</span>
</header>
</body>
</html>


<?php

require_once("conn.inc");


$connessione= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
if (!$connessione) {
	die("Connection failed: " . mysqli_connect_error());
}
$categoria=$_SESSION['categoria'];

if(!isset($_SESSION['flag'])){
$_SESSION['flag']=0;
}

if(!empty($_SESSION['username']) && ($_SESSION['flag']==0 || !isset($_SESSION['flag']))){
if($ris=preleva_id_categoria($connessione,$_SESSION['username'])){//Puo ritornare null per campo id_lezione categoria vuoti dell'utente
$categoria_r=$ris['categoria'];
if($_SESSION['categoria']==$categoria_r){
$id_lezione=$ris['id_lezione'];
$pag=preleva_pagina_utente($connessione,$_SESSION['categoria'],$id_lezione,$lingua_base,$lingua_traduzione);
$count=$pag;
$_SESSION['flag']=1;
}
}
}


if(empty($_GET['a']) && $_SESSION['flag']==0)
$count=0;
else if(isset($_GET['a'])){
$count=$_GET['a'];
}



$lez=estrai_id_lezioni($connessione,$categoria,$lingua_base,$lingua_traduzione);
$count_id=count($lez);

if(!($count>=$count_id)){
	
$righe=estrai_righe_frasi($connessione,$lez[$count]);//Estrai righe_verbi ritorna array contentente le info di frasi dato il codice della lezione 
$count_righe=count($righe);
/*
echo "<span style=\"font-family:arial\">";
echo "<fieldset><legend> <h1>Lezioni di ".$_SESSION['categoria']."</h1></legend>";
echo "<table align=\"center\"  cellspacing=\"20\" border=0> ";
echo "<tr><th>Frase</th><th>Traduzione e grammatica frase</th><th>Parola chiave</th><th>Traduzione parola chiave</th><th>Ascolta Traduzione frase</th>";

if((strcmp($_SESSION['categoria'],"Nome"))==0)
	echo "<th>Immagine</th></tr>";
else
	echo "</tr>";

for($i=0;$i<$count_righe;$i++){
	echo "<tr><td>",$righe[$i][1],"</td><td>",disegna_tabella_traduzioni($righe[$i][2], $righe[$i][6]),"</td><td>";
	$parola_c=estrai_parole_chiave($connessione,$righe[$i][4],$lingua_base,$lingua_traduzione);
	echo $parola_c['parola_chiave'],"</td><td>",$parola_c['traduzione'],"</td>";
    echo "<td><audio controls><source src=\"../src/".$righe[$i][3]."\" type=\"audio/mp3\"></audio></td>";
	if((strcmp($_SESSION['categoria'],"Nome"))==0)
    echo "<td><img src=\"../src/".$parola_c['immagine']."\"></td></tr>";
else
	echo "</tr>";
	
}


echo "</form>";
echo "</table>";
echo "<center>";
*/

echo "<span style=\"font-family:arial\">";
echo "<fieldset><legend> <h1>Lezioni di ".$_SESSION['categoria']."</h1></legend>";
echo "<table align=\"center\"  cellspacing=50 cellpadding=10 border=0> ";
//echo "<tr><th>Frase</th><th>Traduzione e grammatica frase</th><th>Parola chiave</th><th>Traduzione parola chiave</th><th>Ascolta Traduzione frase</th>";



for($i=0;$i<$count_righe;$i++){
	echo "<tr><td>Frase ",$i+1,"</td><td>",$righe[$i][1],"</td></tr>
	<tr><td>Traduzione e grammatica frase</td><td>",disegna_tabella_traduzioni($righe[$i][2], $righe[$i][6]),"</td></tr>
	<tr><td>Parola chiave</td><td>";
	
	$parola_c=estrai_parole_chiave($connessione,$righe[$i][4],$lingua_base,$lingua_traduzione);
	
	
	echo $parola_c['parola_chiave'],"</td></tr>
	<tr><td>Traduzione parola chiave</td><td>",$parola_c['traduzione'],"</td></tr>
    <tr><td>Ascolta Traduzione frase</td><td><audio controls><source src=\"../src/".$righe[$i][3]."\" type=\"audio/mp3\"></audio></td></tr>";
	if((strcmp($_SESSION['categoria'],"Nome"))==0)
    echo "<tr><td> Immagine </td><td><img src=\"../src/".$parola_c['immagine']."\"></td></tr>";
	
}


echo "</form>";
echo "</table>";
echo "<center>";




if(!empty($_SESSION['username'])){
	if(salva_progressi_utente($connessione,$_SESSION['username'],$lez[$count],$categoria))
	$_SESSION['flag']=0;
}

echo "<form action=\"",$_SERVER["PHP_SELF"],"?a=",++$count,"\" method=\"POST\">";
echo "<input type=\"submit\" value=\"Lezione Successiva\" name=\"n\" style=\"width:200px;height:50px;font-family:arial;\">";
echo" </span>"; 
echo "</fieldset>";
echo "</form>";
echo"</center>";

}else{

echo "<center><label style=\"font-family:arial;\">LEZIONE TERMINATA<label></center>";
$_SESSION['flag']=0;
mysqli_close($connessione);
$connessione=null;
}

?>


