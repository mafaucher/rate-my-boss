<?php
	//Negate the cookies, destroy the session, redirect to index.php.
	setcookie("cName", $username, time()-60*60*24*100, "/");
	setcookie("cPass", $password, time()-60*60*24*100, "/");
	@session_start();
	session_destroy(); 	
	@header("Location: ../www/index.php");
?>
