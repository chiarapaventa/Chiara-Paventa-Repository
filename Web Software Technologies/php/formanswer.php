<?php
	
	session_start();
	require_once('conn.inc');
	
	
	$connection= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
    if (!$connection) {
	    die("Connection failed: " . mysqli_connect_error());
    }
	
	if(isset($_SESSION['risposta'])){	
		
	}
	else{
		$_SESSION['risposta']="";
	}
	if(isset($_SESSION['messaggio'])){
		
	}
	else{
		$_SESSION['messaggio']="";
	}
	
    if(isset($_SESSION['check'])){
		
	}else{
		
		$_SESSION['check']=-1;
	}
	
	
	
	if(isset($_SESSION['countCorrect'])){
		
	}else{
		
		$_SESSION['countCorrect']=0;
	}
	
	
	
	//conta il numero di domande fatte, in modo che quando è finito il quiz si può fare il resoconto delle domande sbagliate su quante domande
	if(isset($_SESSION['countq'])){
		
	}else{
		
		$_SESSION['countq']=0;
	}
	
	$messaggio="";
	
	if(isset($_POST['conferma'])){
		
		if(isset($_POST['answer'])){//se è stato scritto qualcosa nella casella allora visualizza ancora quello che hei inserito e fare la verifica se la risposta è
			//corretta o meno
			
		    $_SESSION['risposta']=$_POST['answer'];
		    if($_POST['answer']==""){
			     $messaggio="Rispondi alla domanda";
		    }else{
			    
		    $_SESSION['countq']+=1;//conta le domande fatte in tutto
		    
		    $qp='SELECT id_parola_chiave FROM parola_chiave WHERE parola_chiave="'.$_SESSION['parolai'].'"';
		    $go=mysqli_query($connection,$qp);
		    $id=mysqli_fetch_assoc($go)['id_parola_chiave'];
		    

		    
		    
		    
		    
		    if(strtolower($_SESSION['risposta'])==$_SESSION['parolai']){//se la risposta è corretta
			   $messaggio="<b>La risposta è corretta</b>";
			   $_SESSION['countCorrect']+=1;//aumenta il conteggio delle risposte corrette
			   
			   //nel caso in cui l'utente sia registrato devo andare a vedere che se sto facendo le domande da quizerrati allora mi deve andare a fare delle delete
			    if(!empty($_SESSION['username']) && !empty($_SESSION['ruolo'])){
				   
				    if($_SESSION['Quizerrati']==1){
					   //se ci sono righe nella tabella quiz errati allora devo andare a fare delle delete riguardanti quella parola e quell'utente
					   
					   $delete='DELETE FROM quizerrati WHERE id_parola_chiave="'.$id.'" AND username="'.$_SESSION['username'].'"';
					   $send=mysqli_query($connection, $delete);
					   
				    }else{
					    $qr='SELECT id_parola_chiave FROM quizerrati WHERE id_parola_chiave="'.$id.'"';
					    $in=mysqli_query($connection,$qr);
					    if(mysqli_fetch_array($in)){// fare la delete anche durante il quiz normale se la parola è presente in quizerrati
						   $delete='DELETE FROM quizerrati WHERE id_parola_chiave="'.$id.'" AND username="'.$_SESSION['username'].'"';
					       $send=mysqli_query($connection, $delete);
					    }
				    }
			    }
			   $_SESSION['check']=1;
			   
		    }else{// risposta sbagliata
			   $messaggio="<b>Risposta sbagliata</b> <br><br> La risposta giusta è  <b>".$_SESSION['parolai']."</b>";
			   //nel caso in cui l'utente sia registrato e inserisce delle risposte sbagliate deve andare a fare una insert in quizerrati 
			   //se ci sono le righe nella tabella Quizerrati devi solo andare a incrementare il contatore 
			   if(!empty($_SESSION['username']) && !empty($_SESSION['ruolo'])){
				    if($_SESSION['Quizerrati']==1){
					   $_SESSION['countQuizErrati']+=1;//incremento il contatore
					   
				    }else{// l'utente è registrato ma non ci sono delle righe nella tabella per quell'utente allora devo andare a mettere nel database le parole che ha sbagliato
					    $qr='SELECT id_parola_chiave FROM quizerrati WHERE id_parola_chiave="'.$id.'"';
					    $in=mysqli_query($connection,$qr);
					    if(mysqli_fetch_array($in)){
						   
					    }else{
						   $insert='INSERT into quizerrati(id_parola_chiave,username) values("'.$id.'","'.$_SESSION['username'].'")';
					       $send2=mysqli_query($connection,$insert);

					    }
					   
					   
				   }
			    }
			   
			   
			   
			  $_SESSION['check']=0;
			  
		    }
		}
    }
			
			
		
		
	}
	
	
?>

<!DOCTYPE html>

<html>
	<table align="center">
		
	      <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
              <tr> <td><input type="text" name="answer" value="<?php echo $_SESSION['risposta'];?>"/> <td><tr>
	          <tr></tr>
              <tr><td><?php
	             if($_SESSION['check']==0 || $_SESSION['check']==1) {
		             echo "<input type='submit' name='conferma' value='conferma' disabled>";
	             }else{
		             echo "<input type='submit' name='conferma' value='conferma'>";
	             }
              ?></td></tr>
	          <tr></tr>
	      </form>
	       <tr> <td>
		       <form action="Quiz.php" target="_top">
		        <?php 
			     echo "<tr><td>".$messaggio."</td></tr>";
			     echo "<tr><td>";     
			 
			if($_SESSION['check']==0 || $_SESSION['check']==1){//sia nel caso che sia corretta, sia nel caso che sia sbagliata devi mostrare il bottone per andare
				 //avanti e ricaricare la pagina 
				  
				 echo "<input type='submit' name='avanti' value='avanti'>";
				 $_SESSION['risposta']="";
				 $_SESSION['check']=-1;
				 
				 
			 }else{
				 echo "<input type='submit' name='avanti' value='avanti' disabled>";
			 }
			 echo "</td>";
		 ?>
		   </form>
		
		<td>
			<form action="Score.php" target="_top">
				<input type="submit" name="score" value="Termina Quiz">
			</form>
			
		</td>
		
		</tr>
	      
	      
	      
	      
	      
	      
	      
	 </table>
	  
		 		 
</html>