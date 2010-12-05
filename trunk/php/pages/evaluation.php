<div class="main">

<h2> :</h2>
<ul class="listing">
<?php
include "../php/opendb.php";

$query = "SELECT * FROM evaluation
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
$content = $_POST['content'];


$sql="insert into supervisor (orgId, title, content, reported) values
($orgId, '$title', '$content', 0)";
mysql_query($sql);

echo "<span class='score'>Evaluation created!</span><br />";
}

include "../php/closedb.php";
?>
</div>
