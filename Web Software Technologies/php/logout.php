<?php  
    session_start();
	setcookie("username", null);
	setcookie("ruolo", null);
    unset($_SESSION['username']);
	unset($_SESSION['ruolo']);
	if(isset($_SESSION['countCorrect'])){
	unset($_SESSION['countCorrect']);
	}
	if(isset($_SESSION['countq'])){
	unset($_SESSION['countq']);
	}
    header("location: home.php");
?>