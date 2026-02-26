<?php
	if(isset($_POST['verbi'])){
		$selezione = $selezione."\n".$_POST['verbi'];
	}
	if(isset($_POST['aggettivi'])){
		$selezione = $selezione."\n".$_POST['aggettivi'];
	}
	if(isset($_POST['nomi'])){
		$selezione = $selezione."\n".$_POST['nomi'];
	}
	
	echo $selezione;
?>