<?php

/* Check if an ad was created */

if (isset($_POST['content'])) {

	/* Fetch the Price of ads */
	
	include "../php/opendb.php";

	$query = sprintf("SELECT adPrice FROM administrator");
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$adPrice = $row['adPrice'];

	$cost = ((float)$_POST['counter'])*$adPrice;
	$query = sprintf("INSERT INTO ad (userId, content, counter, cost, isPending) VALUES
		(%d, '%s', %d, %f, 1)",
		$userid,
		mysql_real_escape_string($_POST['content']),
		((int)$_POST['counter']),
		$cost);

	$result = mysql_query($query);

	include "../php/closedb.php";
	unset($_POST['content']);
	
	/* TODO: Create keyword entries in the 'tag' table */
}


?>