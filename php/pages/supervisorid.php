<div class="main">
	
<?php

if (isset($_GET['orgId'])) {
	$orgId = $_GET['orgId'];
}

$superId = $_GET['superId'];

include "../php/opendb.php";
//Check if an Evaluation has been added.
//if($HTTP_SERVER_VARS['REQUEST_METHOD']=='POST'){
if(isset($_POST['title'])) {

	//get data from post
	$title = $_POST['title'];
	$content = $_POST['content'];


	if (isset($_SESSION['editId'])) {

		$sql="UPDATE superEvaluation SET title='$title', text='$content' WHERE superEvalId=$_SESSION[editId]";
		mysql_query($sql);
		echo "Your evaluation has been updated.<br />";

		unset($_SESSION['editId']);
		unset($_SESSION['editType']);
	}
	else {
		$sql="insert into superEvaluation (superId, title, text, reported, uString) values
		($superId, '$title', '$content', 0, '')";
		
		// post evaluation to database
		mysql_query($sql);
		
		$lastid = mysql_insert_id();
		$uString = md5("superEvaluation" . $lastid);
		$checksum = md5($uString);

		$sql="update superEvaluation set uString='$uString' WHERE superEvalId=$lastid";
		mysql_query($sql);
		
		echo "Thanks for adding an evaluation.<br />
			Unique String: $uString <br />
			Checksum: $checksum <br />";
	}
	unset($_POST['title']);
}

// Selects organization based on id
$query = "SELECT * FROM supervisor
		where superId=$superId";

$result = mysql_query($query);
$row = mysql_fetch_array($result);

echo"<h2>{$row[title]}</h2>
<span class='score'	>Evaluations:</span>
<ul class='listing'>
";

//Access orgEvaluation table
$query = "SELECT * FROM superEvaluation
		WHERE superId=$superId";
$result = mysql_query($query);

// Prints the list of evaluation titles as links to their individual pages
while($row = mysql_fetch_array($result))
{
    echo "<li>
    <a href='index.php?page=evaluationid&superEvalId=${row[superEvalId]}'>
    	{$row[title]}
    </a>
    </li>";
}

echo "
</ul>
<br />
<a href='index.php?page=evaluationform&return=super&superId=$superId'><button type='button'>Add an Evaluation</button></a> <br />
<br />
";
include "../php/closedb.php";
?>
</div>
