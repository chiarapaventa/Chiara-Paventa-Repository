<?php
    function pulisci_stringa($stringa){
	    $values= array("à","è","é","ì","ò","ù","'");
	    $replace = array("&agrave","&egrave","&eacute","&igrave","&ograve","&ugrave", "\\'");
		$s = str_replace($values, $replace, $stringa);	
		return $s;
    }
?>