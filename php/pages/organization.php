<div class="main">

<h2> List of Organizations:</h2>
<ul class="listing">
<?php
include "../php/opendb.php";

$query = "SELECT * FROM organization";
$result = mysql_query($query);

/* Prints the list of organization names as links to their individual pages */

while($row = mysql_fetch_array($result))
{
    echo "<li>
    <a href='index.php?page=organization&id=${row[orgId]}'>
    
    {$row[name]}
    </a>
    </li>";
}

include "../php/closedb.php";
?>
</ul>
</div>
