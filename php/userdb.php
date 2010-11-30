<?php
// Load "user" table into $userdb assoc-array

include "../php/opendb.php";

$query  = "SELECT * FROM user";
$userdb = mysql_query($query);

include "../php/closedb.php";

?>
