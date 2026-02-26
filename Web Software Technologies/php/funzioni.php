<?php
	
	
		function numblevels($linguabase,$linguatraduzione,$cat,$connection){
		$queryliv='SELECT COUNT(*) FROM lezione WHERE categoria="'.$cat.'" AND lingua_base="'.$linguabase.'" AND lingua_traduzione="'.$linguatraduzione.'"  ORDER BY categoria';
		
		
		$l=mysqli_query($connection,$queryliv);
		return $r=mysqli_fetch_row($l);
	}
	   
	
	function score($connection,$num,$username){
		
		
		$queryerr='SELECT parola_chiave,traduzione FROM parola_chiave JOIN quizerrati on parola_chiave.id_parola_chiave=quizerrati.id_parola_chiave WHERE username="'.$username.'"';
	    $ght=mysqli_query($connection,$queryerr);
	    
	    for($i=1;$i<=$num;$i++){
		    mysqli_data_seek($ght,$num);
		    $r=mysqli_fetch_assoc($ght);
		    echo "<b>".$r['parola_chiave']."</b>-->";
		    echo $r['traduzione']."<br>";
	    }

	}
	
	
	
	
	function quizerrati($connection,&$categoria,&$traduzione,&$parolai,&$media,&$count,&$num,$username,&$finito){
		$countq='SELECT COUNT(*) FROM quizerrati WHERE username="'.$username.'"';
		$rgh=mysqli_query($connection, $countq);
		$num=mysqli_fetch_row($rgh)[0];
		
		$queryerr='SELECT parola_chiave,traduzione, categoria, file_mp3, immagine FROM parola_chiave JOIN quizerrati on parola_chiave.id_parola_chiave=quizerrati.id_parola_chiave WHERE username="'.$username.'"';
		$send5=mysqli_query($connection,$queryerr);
		//conto quanti risultati ci sono
		//ogni volta mi deve contare quante righe ci sono perchè potrei aver fatto una delete quando la risposta era giusta
		 
		if($num!=0){//se ci sono righe ritorna 1
			//se il numero di frasi è uguale al contatore allora che devo fare ritornare 0 lo stesso
			if($count==$num){//questo è per quando termina
				$count=0;
				$finito=1;
				
				return 0;
			}else{
				mysqli_data_seek($send5,$count);
			    $res=mysqli_fetch_assoc($send5);
			    $traduzione=$res['traduzione'];
			    $categoria=$res['categoria'];
			    $parolai=$res['parola_chiave'];
			    if($categoria=="Nome"){
				    $media=$res['immagine'];
			    }else{
				    $media=$res['file_mp3'];
			    }
			    return 1;

			}
			
		}else{
			
			return 0;//se non ci sono righe ritorna 0
			
		}
		
		
	}
	
	
	function randcat($linguabase,$linguatraduzione,$connection){
		$querycat='SELECT categoria FROM lezione WHERE lingua_base="'.$linguabase.'" AND lingua_traduzione="'.$linguatraduzione.'" ORDER BY RAND() LIMIT 1';
	    $send=mysqli_query($connection,$querycat);
	    return $risultato1 = mysqli_fetch_assoc($send);
	}
	
	
	function idlesson($cat,&$level,$connection,&$finished,&$nphrases,$flag,$nlev){
		
		$queryid='SELECT id_lezione FROM lezione WHERE categoria="'.$cat.'"';//trova tutti gli id delle lezioni per quella categoria
		//ne devo prendere solo una alla volta,quindi uso seek per spostarmi
		$send2=mysqli_query($connection,$queryid);
		mysqli_data_seek($send2,$level);
		$risultato2=mysqli_fetch_assoc($send2);
		$id_lezione=$risultato2['id_lezione'];
		//vedere se una lezione esiste 
		
		
		
		if($risultato2!=NULL){//esistono lezioni per questa categoria scelta,andiamo a controllare se ci sono frasi
			if($flag==0){ //se il flag è a zero allora vuol dire che stiamo cominciando una nuova lezione per quella categoria e quindi mi conto quante frasi ci sono
				$nphrases=numbphrases($id_lezione,$connection);
				if($nphrases!=NULL){//se ci sono frasi nella lezione 
					return $id_lezione;//ritorna l'id lezione da dove devo prendere tutte le frasi
				}else{//non ci sono frasi
					if($level<$nlev-1){
				          $level+=1;
				          header("Refresh; url=Quiz.php");//aggiorna la pagina
				    
			        }elseif($level==$nlev-1){//se il numero di lezioni fatte, cui mi trovo, è uguale al numero di lezioni complessive per quel livello
				          $finished=1;//i livelli, cioè le lezioni per quella categoria sono finiti
				          header("Refresh; url=Quiz.php");//aggiorna la pagina
			        }
				}
			}else{//se il flag non è zero gia sappiamo che ci sono frasi per quella lezione quindi dobbiamo restituire l'id della lezione
				return $id_lezione;//ritorna l'id lezione da dove devo prendere tutte le frasi
			}
				
			
			
			
		    			    
		    
		}else{//non esistono lezioni per questa categoria
			$finished=1;//dico che non ci sono lezioni per questa categoria
			header("Refresh; url=frame.php");//aggiorno la pagina
		}
	}
	
	
	function numbphrases($id_lezione,$connection){
		$querynfrasi='SELECT COUNT(*) FROM frase WHERE id_lezione="'.$id_lezione.'" GROUP BY id_lezione';
		
			$q=mysqli_query($connection,$querynfrasi);
		    return mysqli_fetch_row($q)[0];
		
	}
	
	function keywords($id_lezione,$connection,$flag){
		$querypl='SELECT id_parola_chiave FROM frase WHERE id_lezione="'.$id_lezione.'"';	
		$send3=mysqli_query($connection,$querypl);
		mysqli_data_seek($send3,$flag);
		
		
		return mysqli_fetch_assoc($send3)['id_parola_chiave'];
	}
	
	function word($idword,$connection){
		$qp='SELECT parola_chiave FROM parola_chiave WHERE id_parola_chiave="'.$idword.'"';
		$go=mysqli_query($connection,$qp);
		return mysqli_fetch_assoc($go)['parola_chiave'];
	}
	
	function wordtranslation($word,$connection){
		$queryti='SELECT traduzione, immagine, file_mp3 FROM parola_chiave WHERE parola_chiave="'.$word.'"';
		$send4=mysqli_query($connection,$queryti);
		return mysqli_fetch_assoc($send4);
	}
	function userinformation(&$name,&$surname,&$birthday,&$gender,&$email,&$user,$connection,&$role,$username){
		$queryuser='SELECT * FROM utente WHERE username="'.$username.'"';
	    $send=mysqli_query($connection,$queryuser);
	    $information=mysqli_fetch_assoc($send);
	    $name=$information['nome'];
	    $surname=$information['cognome'];
	    $birthday=$information['data_di_nascita'];
	    $gender=$information['sesso'];
	    $email=$information['email'];
	    $user=$information['username'];
	    $role=$information['ruolo'];
	    
	}

	
	function quiz(&$chosen_category,&$level,&$flag,&$nphrases,&$nlev,&$finished,&$traduzione,&$media,&$parolai,$connection){
		
		$id_lezione=idlesson($chosen_category,$level,$connection,$finished,$nphrases,$flag,$nlev);
               
		   
		    if($flag<$nphrases-1){
			   
		        $idword=keywords($id_lezione,$connection,$flag);
		        $parolai=word($idword,$connection);			   

			    $flag+=1;//incremento il flag fino a quando non arriva al numero di frasi  
			 
			  
		    }elseif($flag==$nphrases-1){//fine livello
			    $idword=keywords($id_lezione,$connection,$flag);
		        $parolai=word($idword,$connection);
			    
			    if($level==$nlev-1){//fine tutti i livelli
				        
				        $finished=1; 
				        
			        }
			    else{
				        $level+=1;
				        
			        }

			    
			    $flag=0;//metto il flag a zero perchè adesso deve ricominciare per il prossimo livello
			    $nphrases=0;//azzero anche il numero di frasi perchè adesso devo contare quante frasi ci sono nel prossimo livello
			    
		    }
		  		
		
				
			
		
		    //query per trovare la traduzione della parola chiave e la corrispondete immagine
		    
		    $risultato4=wordtranslation($parolai,$connection);
		    $traduzione=$risultato4['traduzione'];
		    
		    if($chosen_category=="Nome"){
			    $media=$risultato4['immagine'];
		    }else{
			    $media=$risultato4['file_mp3'];
		    }
		    
		     
		    
		
	}
	

?>