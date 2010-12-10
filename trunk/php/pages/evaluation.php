<div class="main">
	
<?php
include "../php/opendb.php";

//Check if an Evaluation has been added.
//if($HTTP_SERVER_VARS['REQUEST_METHOD']=='POST'){
if (isset($_POST['title'])) {

//get data from post
$title = $_POST['title'];
$content = $_POST['content'];

$sql="insert into orgEvaluation (orgId, title, text, reported, uString) values
($orgId, '$title', '$content', 0, 'aaa')";

// post evaluation to database
mysql_query($sql);
echo "Thanks for adding an evaluation.<br />";
unset($_POST['title']);
}

echo"
<h2>Evaluations:</h2>
<ul class='listing'>
";

//Access orgEvaluation table
$query = "SELECT * FROM orgEvaluation
		WHERE orgId=$orgId";
$result = mysql_query($query);

// Prints the list of evaluation titles as links to their individual pages
while($row = mysql_fetch_array($result))
{
    echo "<li>
    <a href='index.php?page=evaluationid&orgEvalId=${row[orgEvalId]}'>
    	{$row[title]}
    </a>
    </li>";
}

echo "
</ul>
<br />
<a href='index.php?page=evaluationform&return=org'><button type='button'>Add an Evaluation</button></a> <br />
<br />
";
include "../php/closedb.php";
?>
</div>
