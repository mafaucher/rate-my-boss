<?php

//Remember to set $orgid once an organization is chosen
include "../php/opendb.php";

$query  = "SELECT * FROM organization";
$result = mysql_query($query);

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    echo "Name :{$row['name']} <br>";
}
 
include "../php/closedb.php";


?>
