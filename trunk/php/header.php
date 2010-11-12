<?php
	#include global php modules	
	include("../php/config.php");
        include("../php/getOrganizationInfo.php");
	if($_SESSION['writeCookies']){
		setcookie("cName", $_SESSION['username'], time()+60*60*24*100, "/"); //Set the cookie "cName" to the value of the username variable for specified time.
	  	setcookie("cPass", $_SESSION['password'], time()+60*60*24*100, "/"); //Set the cookie "cPass" to the value of the password variable for specified time.
		$_SESSION['writeCookies'] = false;
	}

?>


<html>
<head>
	<title><?php echo getOrgInfo("companyName"); ?></title>
	<meta http-equiv="content-type" content="text/html+xml; charset=utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="favorite icon" type="image/png" href="images/icon.png" />
	<script type="text/javascript" src="javascript/frame.js"></script>
<?php

?>
</head>
<body>
      <div class="header">
         <img src="images/Logo-Border.png" alt="J.P. Peach Logo"/>
	<h1><?php echo getOrgInfo("companyName"); ?></h1>
      </div>
<?php
 include("../php/login.php"); #create login functionality
 include("../php/functionality.php");
 addJSArrays("www/");
?>
