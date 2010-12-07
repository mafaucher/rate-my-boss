<div class="main">

<?php
include "../php/opendb.php";
//check if a supervisor id is givin, if so pull from superEvaluation table. Otherwise pull from orgEvaluation table.
if (isset($_GET["superEvalId"]))
{
	$tableName = 'superEvaluation';
	$evalIdName = 'superEvalId';
	$evalId = $_GET["superEvalId"];
	
	$commentTable = 'superComment';
	$commentIdName = 'superCommentId';
} else {
	
	$tableName = 'orgEvaluation';
	$evalIdName = 'orgEvalId';
	$evalId = $_GET["orgEvalId"];
	
	$commentTable = 'orgComment';
	$commentIdName = 'orgCommentId';
}


//Check if a comment has been added.
if($HTTP_SERVER_VARS['REQUEST_METHOD']=='POST'){

	//get data from post
	$text = $_POST['text'];
	
	$sql="insert into $commentTable ($evalIdName, text, reported, uString) values
	($evalId, '$text', 0, 'aaa')";
	
	// post comment to database
	mysql_query($sql);
}


//Find evaluation in org or super tables depending how the variables are set
$query = "SELECT * FROM $tableName
		where $evalIdName=$evalId";

$result = mysql_query($query);
$row = mysql_fetch_array($result);

//Display evaluation
echo"
<h2>{$row[title]}</h2>
<p class='evalText'>{$row[text]}</p>
<br />
<span class='score'>Comments:</span>
";

//Display comments

$query = "SELECT * FROM $commentTable
		WHERE $evalIdName=$evalId";
$result = mysql_query($query);

// Display list of comments attributed to the evaluation
while($row = mysql_fetch_array($result))
{
    echo "
		<div class='comment'>
    		<p>{$row[text]}</p>
		</div>
		";
}
echo "
<p><strong> Enter a comment:</strong></p>
<form name='comment' action='index.php?page=evaluationid&$evalIdName=$evalId' method='post'>";
?>
<p><textarea type='text' name='text' cols="60" rows="10"></textarea></p>
<input type='submit' name='submitComment' value='Submit Comment' />
</form>

</div>