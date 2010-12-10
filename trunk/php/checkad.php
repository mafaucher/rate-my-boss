<?php

/* Check if an ad was created */

if (isset($_POST['content'])) {

	/* Fetch the Price of ads */
	
	include "../php/opendb.php";

	$query = sprintf("SELECT adPrice FROM administrator");
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$adPrice = $row['adPrice'];

	/* Insert new ad */

	$cost = ((float)$_POST['counter'])*$adPrice;
	$query = sprintf("INSERT INTO ad (userId, content, counter, cost, isPending) VALUES
		(%d, '%s', %d, %f, 1)",
		$userid,
		mysql_real_escape_string($_POST['content']),
		((int)$_POST['counter']),
		$cost);

	mysql_query($query);

	$query = "SELECT LAST_INSERT_ID()";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$adId = $row[0];
	
	/* Create tags */
	
	$keyword = $_POST['keyword'];

	for ($i = 1; $i <= 10; $i++) {
		if ($keyword[$i] != "") {
			echo $adId;
			echo $keyword[$i];
			$query = "INSERT INTO tag (adId, keyword) VALUE ($adId, $keyword[$i])";
			echo mysql_query($query);
		}
	}

	include "../php/closedb.php";
	unset($_POST['content']);
}


?>
