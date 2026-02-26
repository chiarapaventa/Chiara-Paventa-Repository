<?php
	require_once('funzioni.php');
	require_once('conn.inc');
	session_start();
	
	$connection= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
    if (!$connection) {
	    die("Connection failed: " . mysqli_connect_error());
    }
	
			
		if(isset($_SESSION['username'])){
			
		}else{
			$_SESSION['username']=0;
		}
		
	
	//SET VARIABILI SESSIONI

					
	//IL FLAG INDICA QUANTE PAROLE PER OGNI LEZIONE SONO STATE FATTE USCIRE NEL QUIZ
	if(isset($_SESSION['flagN'])){
		

	}else{
		$_SESSION['flagN']=0;
	}
	
    if(isset($_SESSION['flagV'])){
		
	}else{
		$_SESSION['flagV']=0;
	}
	
	if(isset($_SESSION['flagA'])){
		
	}else{
		$_SESSION['flagA']=0;
	}
	
	

   //PER OGNI CATEGORIA POSSONO APPARIRE AL MASSIMO N PAROLE(IL NUMERO DIPENDE DAL NUMERO DI FRASI PER TIPO DI LEZIONE),SE VIENE RANDOMIZZATA LA ennesima VOLTA LA STESSA CATEGORIA, SI PASSA ALLA LEZIONE SUCCESSIVA DI QUELLA CATEGORIA, quindi allla fine del quiz tutte le parole per ogni LEZIONE saranno state domandate.
  
	
	
	//QUESTO CONTATORE SERVE PER CONTARE LE LEZIONI PER OGNI CATEGORIA
	if(isset($_SESSION['countLN'])){
	}else{
		$_SESSION['countLN']=0;
	}
	
	
	if(isset($_SESSION['countLV'])){
	}else{
		$_SESSION['countLV']=0;
	}	
	
	
	if(isset($_SESSION['countLA'])){
	}else{
		$_SESSION['countLA']=0;
	}
	
	//QUESTE VARIABILI DEVONO CONTENERE IL NUMERO DI FRASI PRESENTI PER OGNI CATEGORIA PER QUELLA DETERMINATA LEZIONE
	if(isset($_SESSION['nFrasiN'])){
	}else{
		$_SESSION['nFrasiN']=0;
	}
    if(isset($_SESSION['nFrasiV'])){
	}else{
		$_SESSION['nFrasiV']=0;
	}
	if(isset($_SESSION['nFrasiA'])){
	}else{
		$_SESSION['nFrasiA']=0;
	}
	
	
	//QUESTE VARIABLI VENGONO USATE PER SAPERE CHE TUTTE LE LEZIONI DI OGNI CATEGORIA SONO FINITE E QUINDI IL QUIZ DEVE TERMINARE
	if(isset($_SESSION['finitoN'])){
	}else{
		$_SESSION['finitoN']=0;
	}
    if(isset($_SESSION['finitoV'])){
	}else{
		$_SESSION['finitoV']=0;
	}
	if(isset($_SESSION['finitoA'])){
	}else{
		$_SESSION['finitoA']=0;
	}
	
	//VARIABILE PER RICORDARE IL NUMERO DELLE LEZIONI PER OGNI CATEGORIA perchè il quiz deve fare tutte le lezioni di tutte le categorie
	if(isset($_SESSION['nlivN'])){
	}else{
		
		
		$_SESSION['nlivN']=numblevels($_SESSION['lingua_base'],$_SESSION['lingua_trad'],$cat="Nome",$connection)[0];
	}
    if(isset($_SESSION['nlivV'])){
	}else{
		
		$_SESSION['nlivV']=numblevels($_SESSION['lingua_base'],$_SESSION['lingua_trad'],$cat="Verbo",$connection)[0];
	}
	if(isset($_SESSION['nlivA'])){
	}else{
		
		$_SESSION['nlivA']=numblevels($_SESSION['lingua_base'],$_SESSION['lingua_trad'],$cat="Aggettivo",$connection)[0];;
		
	}
	
	//QUESTO è UN CONTATORE CHE SERVE COME INDICE A FAR USCIRE I QUIZ DALLA TABELLA DATABASE QUIZERRATI 
	if(isset($_SESSION['countQuizErrati'])){
		
	}else{
		$_SESSION['countQuizErrati']=0;
	}
	
	//TALE VARIABILE RICORDA QUANTE PAROLE CI SONO IN QUIZERRATI
	if(isset($_SESSION['numQuizErrati'])){
		
	}else{
		$_SESSION['numQuizErrati']=0;
	}
	
	//QUESTA VARIABILE SI RICORDA SE CI SONO QUIZ ERRATI O MENO NELLA TABELLA QUIZERRATI
	if(isset($_SESSION['Quizerrati'])){
		
	}else{
		$_SESSION['Quizerrati']=0;
	}
	
	//TALE VARIABILE SERVE A COMUNICARE CON LA PAGINA formanswer.php PER MANDARE LA PAROLA SU CUI VIENE FATTO IL QUIZ E POI PER SAPERE SE LA RISPOSTA DATA ALLA DOMANDA è CORRETTA O MENO
    if(isset($_SESSION['parolai'])){	
	}
	else{
		$_SESSION['parolai']="";
   }
   //TALE VARIABILE SERVE A SAPERE SE ABBIAMO FATTO VEDERE TUTTI I QUIZ SU PAROLE CHE ERANO STATE SBAGLIATE NEL QUIZ PRECEDENTEMENTE EFFETTUATO
   if(isset($_SESSION['finito errati'])){
	   
   }else{
	   $_SESSION['finito errati']=0;
   }
      
   
		
		
	//IN QUESTO MODO VENGONO GESTITE LE EVENTUALI RIPETIZIONI DOVUTE ALLA RAND SULLA TIPOLOGIA DI QUIZ. SE DELLE CATEGORIE HANNO GIà TERMINATO TUTTE LE LEZIONI ALLORA SI PUò ANDARE ALL'ALTRA CATEGORIA CHE ANCORA DEVE FINIRE FINO A QUANDO NON SONO FINITE TUTTE LE LEZIONI		
	$finitoquiz=0;
	if($_SESSION['finitoN']==1 & $_SESSION['finitoV']==1 & $_SESSION['finitoA']==1){
		$finitoquiz=1;
		$traduzione="";
		$quiz_categoria_scelta="";
	}elseif($_SESSION['finitoN']==1){
		
		if(($_SESSION['finitoV']==1)){
			$quiz_categoria_scelta="Aggettivo";
			
		}elseif($_SESSION['finitoA']==1){
			$quiz_categoria_scelta="Verbo";
			
		}else{

			$cat=array('Verbo','Aggettivo');
	        $quiz_categoria_scelta= $cat[array_rand($cat)];
	        
		}
			
	}elseif($_SESSION['finitoV']==1){
		
		if(($_SESSION['finitoN']==1)){
			$quiz_categoria_scelta="Aggettivo";
			
		}elseif($_SESSION['finitoA']==1){
			$quiz_categoria_scelta="Nome";
			
		}else{
			$cat=array('Nome','Aggettivo');
	        $quiz_categoria_scelta= $cat[array_rand($cat)];
	       
		}		
	
	
	}elseif($_SESSION['finitoA']==1){
		
		if(($_SESSION['finitoN']==1)){
			$quiz_categoria_scelta="Verbo";
			
		}elseif($_SESSION['finitoV']==1){
			$quiz_categoria_scelta="Nome";
			
		}else{
			$cat=array('Nome','Verbo');
	        $quiz_categoria_scelta= $cat[array_rand($cat)];
		}	
	}
	else{//SE NESSUNA CATEGORIA HA FINITO LE LEZIONI ALLORA DEVE FARE LA RANDOM SULLA CATEGORIA
		
		if(!empty($_SESSION['username']) && !empty($_SESSION['ruolo'])){//SE L'UTENTE è REGISTRATO
			
			if($_SESSION['finito errati']==0){//CONTROLLO CHE NON SIA GIà STATO FATTO IL QUIZ DA QUIZERRATI IN MANIERA PRIORITARIA
				$_SESSION['Quizerrati']=quizerrati($connection,$quiz_categoria_scelta,$traduzione,$parolai,$media,$_SESSION['countQuizErrati'],$_SESSION['numQuizErrati'],$_SESSION['username'],$_SESSION['finito errati']);
				//SI VA A METTERE NELLA VARIABILE IL VALORE RESTITUITO DALLA FUNZIONE CHE PUò ESSERE 1 SE ESISTONO PAROLE NELLA TABELLA QUIZERRATI
				//OPPURE 0 SE NON ESISTONO PAROLE IN QUIZERRATI OPPURE ABBIAMO GIà TERMINATO QUESTO TIPO DI QUIZ
				
				//SE è 0 ALLORA BISOGNA FARE IL QUIZ NORMALE PRENDENDO LE PAROLE DALLA TABELLA DELLE PAROLE CHIAVE SU TUTTE LE LEZIONI ESISTENTI
				if($_SESSION['Quizerrati']==0){
				  //CON LA FUNZIONE randcat SI VA A FARE LA RANDOM SULLA CATEGORIA NOME-VERBO-AGGETTIVO, A SECONDA DELLA SCELTA CI SARà UN TIPO DI QUIZ
	              $quiz_categoria_scelta = randcat($_SESSION['lingua_base'],$_SESSION['lingua_trad'],$connection)['categoria'];
                }
			}else{//IL QUIZ SU QUIZERRATI è STATO GIà FATTO, cioè $_SESSION['finito errati']=1
				//allora fai il quiz normale
				$quiz_categoria_scelta = randcat($_SESSION['lingua_base'],$_SESSION['lingua_trad'],$connection)['categoria'];
			}
			
		}else{//SE L'UTENTE NON è REGISTRATO ALLORA FAI IL QUIZ NORMALMENTE
			$quiz_categoria_scelta = randcat($_SESSION['lingua_base'],$_SESSION['lingua_trad'],$connection)['categoria'];
		}
        
	}
	
        
        //SE LA CATEGORIA SCELTA è NOME, ALLORA VERRà CREATA UNA TIPOLOGIA DI  QUIZ RELATIVA A QUESTA CATEGORIA
	    if($quiz_categoria_scelta=="Nome"){
		    
			$domanda="Osservare l'immagine e tradurre il seguente nome";	
		    
		    
		    //SE L'UTENTE è REGISTRATO E CI SONO DELLE PAROLE NELLA TABELLA QUIZERRATI
		    
		    if($_SESSION['Quizerrati']==1){
			    //NON DEVE FARE NIENTE PERCHè SE IL VALORE è DAVVERO UGUALE A 1, ALLORA HA GIà FATTO TUTTE LE QUERY LA FUNZIONE quizerrati CHIAMATA IN PRECEDENZA
		    }else{//trovo l'id_lezione corrispondente alla categoria per il livello che gli passo, facendo il quiz normale, e lo devo fare a prescindere dal fatto che l'utente sia loggato o meno in quanto anche se l'utente è loggato ma non ci sono dei quiz errati deve cominciare a fare il quiz normale
			    quiz($quiz_categoria_scelta,$_SESSION['countLN'],$_SESSION['flagN'],$_SESSION['nFrasiN'],$_SESSION['nlivN'],$_SESSION['finitoN'],$traduzione,$media,$parolai,$connection);
		    }
		    
		    
		    $immagine=$media;
            $_SESSION['parolai']=$parolai;//LA PAROLA VIENE MESSA NELLA VARIABILE DI SESSIONE PER FAR SI CHE VENGA VALUTATA GIUSTA O SBAGLIATA NELL'ALTRA PAGINA
		}		
	
	
	
	
	    //PER LE CATEGORIE VERBO E NOME VIENE USATA LA STESSA LOGICA USATA PER LA CATEGORIA NOME
	    if($quiz_categoria_scelta=="Verbo"){
		    
		   $domanda="Ascoltare e tradurre il seguente verbo";
		   
		   if($_SESSION['Quizerrati']==1){
			   
		   }else{
			   quiz($quiz_categoria_scelta,$_SESSION['countLV'],$_SESSION['flagV'],$_SESSION['nFrasiV'],$_SESSION['nlivV'],$_SESSION['finitoV'],$traduzione,$media,$parolai,$connection);
		   }
		   
		   
		   $suono=$media;
		   $_SESSION['parolai']=$parolai;
		   
		}
				  

		
		
		
			
	
	if($quiz_categoria_scelta=="Aggettivo"){
		
		    $domanda="Ascoltare e tradurre il seguente aggettivo";
            
            if($_SESSION['Quizerrati']==1){
	            
            }else{
	            quiz($quiz_categoria_scelta,$_SESSION['countLA'],$_SESSION['flagA'],$_SESSION['nFrasiA'],$_SESSION['nlivA'],$_SESSION['finitoA'],$traduzione,$media,$parolai,$connection);
            }
            
            
            $suono=$media;		    		    
		    $_SESSION['parolai']=$parolai;
	}
	
	
	
	if($quiz_categoria_scelta==""){
		$domanda="Il Quiz è terminato!";
		$_SESSION['finito errati']=0;
	}
	
	
		
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> Quiz </title>
	</head>
	
	<body>
		   
			<table align="center" bgcolor = "#f5f5f5">
				<tr>
					<td><?php echo $domanda;?></td>
					
				</tr>
				
				<tr>
					
					<td>
						<?php
						     if(isset($immagine)){
							    echo "<img src=\"../src/".$immagine."\" width=360 height=360>";
						    }elseif(isset($suono)){
							    echo " <audio controls> 
							               <source src=\"../src/".$suono."\" type=\"audio/mp3\">  
							          </audio>
						    ";
							}else{
								
							}
					    ?> 
						
						
						
						
						</td>
				</tr>
				<tr>
					<td><?php echo $traduzione;?></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td>
					<?php 
						if($finitoquiz==1){
							echo"Torna alla home";
						}else{
							echo "Inserire qui la traduzione";
						}
				    ?>
					</td>
					
					
				</tr>
				<tr><td>					
				</td><td></td><td>
			 
		 </td></tr>
								
				<tr>
					
						<td><?php
							if($domanda!="Il Quiz è terminato!"){
								echo "<iframe src='formanswer.php' width='300' height='500' frameborder='0'> </iframe>";
							}
							
						?></td> 
					    <td></td></tr>
				<td></td><td>
				
			</table>
		
	</body>
</html>