<?php
	session_start();
	require_once('conn.inc');
	
	$connection= mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
    if (!$connection) {
	    die("Connection failed: " . mysqli_connect_error());
    }	
    	
        if(isset($_SESSION['checked'])){
			
		}else{
			$_SESSION['checked']=0;
		}
		if(isset($_SESSION['pwdverifiedold'])){
			
		}else{
			$_SESSION['pwdverifiedold']=-1;
		}
		if(isset($_SESSION['pwdverified'])){
			
		}else{
			$_SESSION['pwdverified']=-1;
		}
		
		if(isset($_POST['modifyName'])){
		         $_SESSION['info']="Modifica il tuo nome";
		         				 
        }
        if(isset($_POST['modifySurname'])){
		         $_SESSION['info']="Modifica il tuo cognome";
		         				 
        }
        if(isset($_POST['modifyUsername'])){
		         $_SESSION['info']="Cambia Username";
		         				 
        }
        
	    if(isset($_POST['modifyDate'])){
		         $_SESSION['info']="Modifica data di nascita";
		         				 
        }
        if(isset($_POST['modifyGender'])){
		         $_SESSION['info']="Modifica Sesso";
		         				 
        }
        if(isset($_POST['modifyEmail'])){
		         $_SESSION['info']="Cambia email";
		         				 
        }
        if(isset($_POST['modifyPassword'])){
		         $_SESSION['info']="Cambia Password";
		         				 
        }
        
        
	if(isset($_POST['set'])){//se è stato premuto il bottone per confermare i cambiamenti
		if($_SESSION['info']=="Modifica il tuo nome"){
			
			$queryupdate='UPDATE utente SET nome="'.$_POST['new'].'" WHERE username="'.$_SESSION['username'].'" ';
	        $send=mysqli_query($connection,$queryupdate);
	        if($send){
		        $_SESSION['checked']=1;
	        }
	        }
		
		if($_SESSION['info']=="Modifica il tuo cognome"){
			$queryupdate='UPDATE utente SET cognome="'.$_POST['new'].'" WHERE username="'.$_SESSION['username'].'" ';
	        $send=mysqli_query($connection,$queryupdate);
	        if($send){
		        $_SESSION['checked']=1;
	        }
	        }
		
		
		if($_SESSION['info']=="Cambia Username"){
			
			$queryupdate='UPDATE utente SET username="'.$_POST['new'].'" WHERE username="'.$_SESSION['username'].'" ';
	        $send=mysqli_query($connection,$queryupdate);
	        $_SESSION['username']=$_POST['new'];//aggiornare anche la variabile che tiene loggati 
	        
	        
	        if($send){
		        $_SESSION['checked']=1;
	        }
	        }
		
		
		if($_SESSION['info']=="Modifica data di nascita"){
			$queryupdate='UPDATE utente SET data_di_nascita="'.$_POST['new'].'" WHERE username="'.$_SESSION['username'].'" ';
	        $send=mysqli_query($connection,$queryupdate);
	        if($send){
		        $_SESSION['checked']=1;
	        }
	        }
		
		if($_SESSION['info']=="Modifica Sesso"){
			
				
				$queryupdate='UPDATE utente SET sesso="'.$_POST['gender'].'" WHERE username="'.$_SESSION['username'].'" ';
	            $send=mysqli_query($connection,$queryupdate);
	            if($send){
		           $_SESSION['checked']=1;
	            }

			
			
		}

		if($_SESSION['info']=="Cambia email"){
			$queryupdate='UPDATE utente SET email="'.$_POST['new'].'" WHERE username="'.$_SESSION['username'].'" ';
	        $send=mysqli_query($connection,$queryupdate);
	        if($send){
		        $_SESSION['checked']=1;
	        }
	        }
	        
	     if($_SESSION['info']=="Cambia Password"){
		    $querypwd='SELECT password FROM utente WHERE username="'.$_SESSION['username'].'" ';
		    $invia=mysqli_query($connection,$querypwd);
		    $pw=mysqli_fetch_assoc($invia);
		    $pwen=$pw['password'];
		    
		    if(password_verify($_POST['old'],$pwen)){//se la vecchia password corrisponde allora posso mettere 1 alla variabile sessione che mi farà sbloccare gli altri livelli
			    $_SESSION['pwdverifiedold']=1;	//se la password è verificata allora posso inserire la nuova password 
			    $encryptedpwd=password_hash($_POST['new'],PASSWORD_DEFAULT);	//cripto la nuova password
			    if(password_verify($_POST['newcheck'],$encryptedpwd)){
				   $_SESSION['pwdverified']=1;
				   $queryupdate='UPDATE utente SET password="'.$encryptedpwd.'" WHERE username="'.$_SESSION['username'].'" ';
	               $send=mysqli_query($connection,$queryupdate);
	                if($send){
		              $_SESSION['checked']=1;
	                }
 
			    }else{
				   $_SESSION['pwdverified']=0;
			    }	    
		    }else{
			    $_SESSION['pwdverifiedold']=0;
			    
		    }
		     
		  }   
		     
		    
		    
		    
				         
	}
?>

<!DOCTYPE html>
<html>
	<head><title><?php echo $_SESSION['info'];?></title></head>
	<header align="center"><h1><?php
		if($_SESSION['checked']==0){
			echo $_SESSION['info'];
			if($_SESSION['pwdverifiedold']==1 & $_SESSION['pwdverified']==0 & $_SESSION['info']=="Cambia Password"){
				echo "<br>La tua nuova password non corrisponde!";		      
            }elseif($_SESSION['pwdverifiedold']==0 & $_SESSION['info']=="Cambia Password"){
	            echo "<br>La tua vecchia password non corrisponde!";
            }
		}elseif($_SESSION['checked']==1){
			echo "I tuoi dati sono stati aggiornati con successo!";
		}
		
		?></h1>
	</header>
	<body>
		
		 <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
			 <div align="center">
			    <?php
				    if($_SESSION['checked']==0){
					    if($_SESSION['info']=="Modifica data di nascita"){
						    echo "<input type='date' name='new'  required>";
					    }
					    elseif($_SESSION['info']=="Modifica Sesso"){
						    
						    echo "Female<input type='radio'  name='gender' value='F' >";
						    echo "Male<input type='radio' name='gender'  value='M'>";
					    }
					    elseif($_SESSION['info']=="Cambia Password"){
						    echo "<table align='center'> <tr><td>";
						    echo "Inserisci la tua password</td>";
						    echo "<td><input type='password' name='old'  required></td></tr>";
						    echo "<tr><td>Inserisci la tua nuova password</td>";
						    echo "<td><input type='password' name='new'  required></td></tr>";
						    echo "<tr><td>Inserisci di nuovo la password</td>";
						    echo "<td><input type='password' name='newcheck'  required></td></tr>";
						    echo "</table>";
					    }
					    else{
						    echo "<input type='text' name='new'  required>";
					    }
					   
				    }
			    ?>
			 </div>
		
			 <p>
			 <div align="center">
				
				 <?php
				    if($_SESSION['checked']==0){					   
					   echo "<input type='submit' name='set' value='Applica i cambiamenti' >";					   
				    }
				    
				    ?>
				 </form>  
				 <form action="area_personale.php" method="post">
				    <?php 
					   
					   if($_SESSION['checked']==0){
						 echo "<br>";
						 echo "<input type='submit' name='goBack' value='Cancella operazione' >";  
						 
					   }
					   if($_SESSION['checked']==1){//è andato tutto a buon fine
						if($_SESSION['info']=="Cambia Password"){
							$_SESSION['pwdverified']=-1;
							$_SESSION['pwdverifiedold']=-1;
						}
						 
					   $_SESSION['checked']=0;					   
					   echo "<input type='submit' name='goBack' value='ritorna al tuo Profilo' >";
					  
				    }
			    ?>
				</form>
			 </div>
			 </p>
		 
		
    </body>
</html>