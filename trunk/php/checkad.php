<?php

/* Check if an ad was created */
if (isset($_POST['content'])) {

	include "../php/opendb.php";

	$query = sprintf("INSERT INTO ad (userId, content, counter, isPending, reported) VALUES
		(%d, '%s', %d, 1, 0)", $userid, mysql_real_escape_string($_POST['content']), ((int)$_POST['counter']));

	$result = mysql_query($query);

	include "../php/closedb.php";
}

?>
