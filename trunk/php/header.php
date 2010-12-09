<!-- START OF HEADER -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	
<head>
		
	<title>Rate-My-Boss</title>
	<meta http-equiv="content-type" content="text/html+xml; charset=utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="favorite icon" type="image/png" href="images/icon.png" />
	<script type='text/javascript' src="javascript/validation.js"></script>

</head>

<body>

	<div class="header">
		<img src="images/logo.png" alt="RMB Logo" height=225px/>
		<h1><a href="index.php">Rate-My-Boss</a></h1>

<?php

if (isset($orgId)) {
	include "../php/opendb.php";

	$query = "SELECT name FROM organization WHERE orgId=$orgId";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

	include "../php/closedb.php";

	echo "
		<h2>$row[name]</h2>
		";
}

?>
	</div>

<!-- END OF HEADER -->
