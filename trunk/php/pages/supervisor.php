<div class="main">

<h2> List of Supervisors:</h2>
<ul class="listing">
<?php
include "../php/opendb.php";

$query = "SELECT * FROM supervisor
		wHERE orgId=$orgId and NOT isPending";
$result = mysql_query($query);

/* Prints the list of organization names as links to their individual pages */

while($row = mysql_fetch_array($result))
{
    echo "<li>
    <a href='index.php?page=supervisor&id=${row[superId]}'>
    {$row[title]}
    </a>
    </li>";
}
echo "
</ul>
<br />
<a href='index.php?page=suggestsuper'><button type='button'>Add a Supervisor</button></a> <br />
<br />
";

if($HTTP_SERVER_VARS['REQUEST_METHOD']=='POST'){

$title = $_POST['title'];

$sql="insert into supervisor (orgId, title, isPending) values
($orgId, '$title', 1)";
mysql_query($sql);

echo "<span class='score'>Thanks for suggesting a supervisor!</span><br />
It will be pending until an administrator can confirm it.";
}

include "../php/closedb.php";
?>
</div>
