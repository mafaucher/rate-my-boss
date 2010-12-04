<div class="main">

<h2> List of Organizations:</h2>
<ul class="listing">
<?php

/* Unset the current organization id to reset menu */
if(isset($orgId)) {
	unset($orgId);
}

include "../php/opendb.php";

$query = "SELECT * FROM organization WHERE NOT isPending";
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
echo "
<br />
<a href='index.php?page=suggestorg'><button type='button'>Suggest an Organization</button></a> <br />
";
if($HTTP_SERVER_VARS['REQUEST_METHOD']=='POST'){
echo "<span class='score'>Thanks for suggesting an organization!</span> It will be pending until an administrator can confirm it.";
}

include "../php/closedb.php";
?>
</ul>
</div>
