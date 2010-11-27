<?php

/* Set login cookie (No sure all this is still needed)*/
if($_SESSION['writeCookies']) {
	setcookie("username", $_SESSION['username'], time()+60*60*24*100, "/");
  	setcookie("password", $_SESSION['password'], time()+60*60*24*100, "/");
	$_SESSION['writeCookies'] = false;
}

?>
