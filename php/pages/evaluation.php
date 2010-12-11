<div class="main">

<?php
include "../php/opendb.php";

//Check if an Evaluation has been added.
//if($HTTP_SERVER_VARS['REQUEST_METHOD']=='POST'){
if (isset($_POST['title'])) {

	//get data from post
	$title = $_POST['title'];
	$content = $_POST['content'];

	if (isset($_SESSION['editId'])) {
		$sql="UPDATE orgEvaluation SET title='$title', text='$content' WHERE orgEvalId=$_SESSION[editId]";
		mysql_query($sql);
		echo "Your evaluation has been updated.<br />";
		
		unset($_SESSION['editId']);
		unset($_SESSION['editType']);
	}
	else {
		$sql="insert into orgEvaluation (orgId, title, text, reported, uString) values
		($orgId, '$title', '$content', 0, '')";
	
		// post evaluation to database
		mysql_query($sql);

		$lastid = mysql_insert_id();
		$uString = md5("orgEvaluation" . $lastid);
		$checksum = md5($uString);

		$sql="update orgEvaluation set uString='$uString' WHERE orgEvalId=$lastid";
		mysql_query($sql);

		echo "Thanks for adding an evaluation.<br />
			Unique String: $uString <br />
			Checksum: $checksum <br />";
		
	}
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
