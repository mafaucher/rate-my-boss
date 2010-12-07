<?php

/* Database information */
$dbhost = "clipper.encs.concordia.ca";
$dbuser = "tjc353_2";
$dbpass = "ahf3HY";
$dbname = "tjc353_2";

/*
 * $userid stores agent's user id
 */

if (isset($_SESSION["orgId"])) {
	$orgId = $_SESSION["orgId"];
}

// stores superId for evaluations and comments
if (isset($_SESSION["superId"])) {
	$superId = $_SESSION["superId"];
}

?>
