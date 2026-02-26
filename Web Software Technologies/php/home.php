<?php

    session_start();
    require_once("conn.inc");	
	
	if(empty($_SESSION['lingua_base']) || empty($_SESSION['lingua_trad'])){
		header("location: index.php");
	}	
	
    $connessione= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
    if (!$connessione) {
	die("Connection failed: " . mysqli_connect_error());
    }	
	
	
	
	//login
	if(isset($_POST['login'])){
		
        $username = $_POST['username'];
	    $password = $_POST['password'];
	
        //fare query su tabella utente, verificare se utente esiste e password_verify()
        $query_login = "SELECT username, password, ruolo FROM utente WHERE username = '$username'";
	    $risultato_login = mysqli_query($connessione, $query_login);
	    $riga_login = mysqli_fetch_assoc($risultato_login);
	    $n = mysqli_num_rows($risultato_login);
	
	    $password_attesa = $riga_login['password'];
	    $flag = password_verify($password, $password_attesa);
	
	    $ruolo = $riga_login['ruolo'];
	
	    if ($n != 0 && $flag==true){
		
		    $_SESSION['username'] = $username;
	        $_SESSION['ruolo'] = $ruolo;
		
		    //se ricordami ? settato, salva il cookie
		    if(isset($_POST['check_ricordami'])){
		
		        if(!isset($_COOKIE['username']) && !isset($_COOKIE['ruolo'])){
	                setcookie("username", $username, time()+36000000);	
		            setcookie("ruolo",  $ruolo, time()+36000000);
		        }
	        }

	    }else{
			echo "Username o password sbagliati";
		}
	}
?>	




<html lang="it">

<head>
	<meta charset="utf-8" />
	<meta name="author" content="GECE"/>
	<meta name="description" content="Learn languages"/>
	<title>Learn languages</title> 
</head>

<body>
	<link rel="stylesheet"
		  type="text/css"
		  href="../css/cssHome.css"
	>
	
    <div id = "container">
	    
		
		<div id = "header">
			<form  name="module" action ="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return validaLogin()" method = "post" > 
			    
				<table id="tableHeader" width = 1320; height = 200>
				    <tr>                					
				
						<?php	
						
						    echo "<td align=\"left\" width=20%>";	
							
                            $lingua_base = $_SESSION['lingua_base'];
	                        $lingua_trad = $_SESSION['lingua_trad'];
							//echo $lingua_base."&nbsp;&nbsp;&nbsp;".$lingua_trad."<br>";
	
	                        $query_lingue = "SELECT nome, immagine FROM lingua WHERE nome = '$lingua_base'";	
	                        $risultato_lingua_base = mysqli_query($connessione, $query_lingue);
							$query_lingue = "SELECT nome, immagine FROM lingua WHERE nome = '$lingua_trad'";	
							$risultato_lingua_trad = mysqli_query($connessione, $query_lingue);
							
	                        echo "<table border=0 bgcolor = \"#f5f5f5\" width=200 height=120><tr>";
							$riga_lingua_base = mysqli_fetch_assoc($risultato_lingua_base);
							$riga_lingua_trad = mysqli_fetch_assoc($risultato_lingua_trad);
						
		                        
								echo "<td align=\"center\"><img id=\"lingua_base\" name=\"lingua_base\" src=\"../src/".$riga_lingua_base['immagine']."\">
								</td><td align=\"center\"><img id=\"lingua_trad\" name=\"lingua_trad\" src=\"../src/".$riga_lingua_trad['immagine']."\"></td>";
	                        
							echo "</tr><tr>";
							echo "<td colspan=2 align=\"center\"><a href =\"cambialingue.php\">Cambia le lingue</a></td></tr></table>";
							
                            echo "</td>";
							
							
	
							if((isset($_SESSION['username']) && (isset($_SESSION['ruolo']))) || ((!empty($_COOKIE['username'])) && (!empty($_COOKIE['ruolo'])))){
									
								if(!empty($_COOKIE['username']) && !empty($_COOKIE['ruolo'])){
								   $_SESSION['username']=$_COOKIE['username']; 
								   $_SESSION['ruolo']=$_COOKIE['ruolo']; 
								}
							
						
								echo "<td align = \"center\" width=60%><img name=\"logo\" src=\"../src/logoPrincipale.png\" onMouseUp=\"up()\" onMouseDown=\"down()\" ></td>";
						
                                echo "<td align = \"right\" width=20%><h3 id=\"titolo1\" onmousemove=\"handleMouseMove(this)\">Benvenuto</h3><h3 id=\"titolo2\">utente ". $_SESSION['username']."!</h3><h3 id=\"titolo3\">".$_SESSION['ruolo']."</h3>";
								if($_SESSION['ruolo'] == "Visitatore"){
			                        echo "<a href =\"area_personale.php\">Area Personale</a><br><br>";
								} else if($_SESSION['ruolo'] == "Collaboratore"){
									echo "<a href=\"homeamministrator.php\">Area Amministratore</a><br><br>";
			                        echo "<a href =\"area_personale.php\">Area Personale</a><br><br>";									
   							    }								
								echo "<a href=\"logout.php\" onclick=\"logout()\">Logout</a><br></td>";



				            }else{
								echo "<td align = \"center\" width=60%><img id=\"logo\" name=\"logo\" src=\"../src/logoPrincipale.png\"></td>
				                      
									  <td align = \"right\" width=20%><table cellpadding=5 cellspacing=0 border=0 bgcolor = \"#f5f5f5\" width=250 align = \"right\">	
									        <tr>
											    <td colspan=2 align=\"center\"><b>Accedi<b></td>
											</tr>
											
     			                            <tr>
					                            <td colspan=2 align=\"center\"><input id=\"username\" name=\"username\" autocomplete = \"off\" type=\"text\" placeholder=\"Username\" onchange=\"handleOnChange()\"></td>
				                            </tr>
											
					                        <tr>
					                            <td colspan=2 align=\"center\"><input id=\"password\" name=\"password\" autocomplete = \"off\" type=\"password\" placeholder=\"Password\" ></td>
				                            </tr>
				                            <tr>
											    <td align=\"center\" width=50%><input name=\"login\" type=\"submit\" value=\"Login\" onClick=\"checkLogin()\" ></td><td align=\"center\" width=50%><input type=\"checkbox\" name=\"check_ricordami\" value=\"Ricordami\">Ricordami</td>
				                            </tr> 
                                            <tr>
											    <td colspan=2 align=\"center\"><a  href = \"registrazione.php\"><h4>Registrati</h4></a></td>
											</tr>
				        
						                </table></td>";									
						    }
					    ?>
				    </tr>
				</table>
			</form><br>
        <div>
		
		
		
		
		
		<div id = "menu">
			<center><table id="tableMenu" bgcolor = "#f5f5f5" border = 0 width = 1320; height = 400>
		        <tr>
				    <td width = "33%"><center><a href="sceglilezione.php"><img name="lezione" src="../src/lezione.png" 
					onMouseOver="handleMouseOver('lezione')" onMouseOut="handleMouseOut('lezione')"></a><h3>Lezioni</h3></td>
                    <td width = "33%"><center><a href="Quiz.php"><img name="quiz" src="../src/quiz.png" onMouseOver="handleMouseOver('quiz')" 
					onMouseOut="handleMouseOut('quiz')"></a><h3>Quiz</h3></td>
                    <td width = "33%"><center><a href="cerca.php"><img id="cerca" name="cerca" src="../src/cerca.png" onMouseOver="handleMouseOver('cerca')" onMouseOut="handleMouseOut('cerca')"> </a><h3>Cerca parola</h3></td>																	 
				</tr>	
			</table>
		</div>

        <div id = "footer">
		    <br><br><a href="chisiamo.php"><h1 id="tit">Chi siamo</h1></a><br><br>
			<h3 id="ls">Salva elemento in Local Storage</h3>
		
		<div class="slideshow" id="slideshow">

			<div class="mySlides">
				<img src="../src/sun.jpg" style="width:20%">
			</div>

			<div class="mySlides">
				<img src="../src/jacket.jpg" style="width:20%">
			</div>

			<div class="mySlides">
				<img src="../src/soap.jpg" style="width:20%">
				</div>
			</div>
			
			<div class="mySlides">
				<img src="../src/scarf.jpg" style="width:20%">
				</div>
			</div>
			
			<div class="mySlides">
				<img src="../src/sea.jpg" style="width:20%">
				</div>
			</div>
			
			<div class="mySlides">
				<img src="../src/dog.jpg" style="width:20%">
				</div>
			</div>
			
			<div class="mySlides">
				<img src="../src/house.jpg" style="width:20%">
				</div>
			</div>
			
			<div class="mySlides">
				<img src="../src/chair.jpg" style="width:20%">
				</div>
			</div>
			
			<div class="mySlides">
				<img src="../src/backpack.jpg" style="width:20%">
				</div>
			</div>
			
			<div class="mySlides">
				<img src="../src/bike.jpg" style="width:20%">
				</div>
			</div>
			
	    </div>
	
		</div>	


	<script type="text/javascript">	
	
		//VALIDAZIONE LOGIN
		function validaLogin(){
			var username = document.module.username.value;
			var password = document.module.password.value;
			if ((username == "") || (username == "undefined")) {
				alert("Il campo username è obbligatorio.");
				document.modulo.username.focus();
				return false;
			}
			if ((password == "") || (password == "undefined")) {
				alert("Il campo password è obbligatorio.");
				document.modulo.password.focus();
				return false;
			}
		}
		
		function logout() {
			alert("Stai facendo logout");
		}
		
	//IMMAGINI		
		// IMMAGINI MENU: REGISTRAZIONE TIPO 1	
		function handleMouseOver(name){
			if(name == "lezione"){
				document.lezione.src="../src/lezione2.png";
			}
			if(name == "quiz"){
				document.quiz.src="../src/quiz2.png";
			}
			if(name == "cerca"){
				document.cerca.src="../src/cerca2.png";
			}
	    }
		
		function handleMouseOut(name){
			if(name == "lezione"){
				document.lezione.src="../src/lezione.png";
			}
			if(name == "quiz"){
				document.quiz.src="../src/quiz.png";
			}
			if(name == "cerca"){
				document.cerca.src="../src/cerca.png";
			}
		}
		
		//IMMAGINE LOGO: REGISTRAZIONE TIPO 2
		var element = document.logo;
		element.onmouseover = handleMouseEvent;
		element.onmouseout = handleMouseEvent;
		element.onmouseup = handleMouseEvent;
		element.onmousedown = handleMouseEvent;
		
		function handleMouseEvent(event){
			if(event.type == "mouseover"){
				event.target.src="../src/logo1.png";
			} else if(event.type == "mouseout"){
				event.target.src="../src/logoPrincipale.png";
			} else if(event.type == "mouseup"){
				event.target.src="../src/logoPrincipale.png";
			} else if (event.type == "mousedown"){
				event.target.src="";
			}
		}
		
	    //IMMAGINI LINGUE: REGISTRAZIONE TIPO 3
		var linguaBase = document.lingua_base;
		var linguaTrad = document.lingua_trad;
		linguaBase.addEventListener("click", function(){
			alert("Questa è lingua di base");
		});
		linguaTrad.addEventListener("click", function(){
			alert("Questa è la lingua da imparare");
		});
		
		
	//TITOLI H3
		//REGISTRAZIONE TIPO 1
		function handleMouseMove(elem){
			if (elem.style.color == "black"){
				elem.style.color = "red";
			} else {
				elem.style.color = "black"
			}
		}
		
		//REGISTRAZIONE TIPO 2
		var titolo2 = document.getElementById("titolo2");
		titolo2.onmouseover = handleMouseEvent2;
		titolo2.onmouseout = handleMouseEvent2;
		function handleMouseEvent2(e){
			if(e.type == "onmouseout"){
				e.target.style.color = "yellow";
			} else {
				e.target.style.color = "orange";
			}
		}
		
		//REGISTRAZIONE TIPO 3 
		var titolo3 = document.getElementById("titolo3");
		titolo3.addEventListener("click", function(){
				titolo3.style.color = "red";
		});
	
	//FASI MESSE IN EVIDENZA
	
		slideshow.addEventListener("click", handleClickSlideshow, true);
		function handleClickSlideshow(e) {
			if(e.eventPhase == Event.CAPTURING_PHASE){
				alert("Questo handle è gestito nella fase di \n" + 
					  "capturing");
			}
		}
		
		slideshow.addEventListener("mouseout", handleMouseoutSlideshow, true);
		function handleMouseoutSlideshow(e) {
			if(e.eventPhase == Event.BUBBLING_PHASE){
				alert("Questo handle è gestito nella fase di \n" + 
					  "bubbling");
			}
		}
		
		slideshow.addEventListener("mouseover", handleMouseoverSlideshow, true);
		function handleMouseoverSlideshow(e) {
			if(e.eventPhase == Event.AT_TARGET){
				alert("Questo handle è gestito nella fase di \n" + 
					  "target");
			}
		}
	
	//LOCAL STORAGE
		ls.addEventListener("click", salvaLS, true);
		
		function salvaLS(){
			/*if(!Modernizr.localstorage){
				alert("Local Storage non è disponibile");
			}*/
			var elem = prompt("Inserisci elemento da salvare", "");
			localStorage.setItem("elem", x);
			
			var x = localStorage.getItem("elem");
			alert("Elemento salvato: \n" + elem);
		}
	

	
	//SLIDESHOW
		var indice = 0;
		scorriSlides();
		
		function scorriSlides(){
		var slides = document.getElementsByClassName("mySlides");
		var i;

		for(i=0; i<slides.length; i++){
			slides[i].style.display = "none";
		}
		
		indice++;
		if(indice > slides.length){
			indice = 1
		}
		slides[indice-1].style.display = "block";
		setTimeout(scorriSlides, 2000);
		}
		
		
	</script> 
	
</body>
 
</html>