<div class="main">

<?php
if (isset($_GET['orgId'])) {
	$orgId = $_GET['orgId'];
}

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
if (isset($_GET["report"]))
{
	$reportType = $_GET["report"];
	
	if($reportType == 'eval')
	{
		$reportTable = $tableName;
		
			$sql="UPDATE $reportTable SET reported = 1
	WHERE $evalIdName = $evalId";
	} else {
		$commentId = $_GET["commentId"];
		
		$reportTable = $commentTable;
		
			$sql="UPDATE $reportTable SET reported = 1
			WHERE $commentIdName = $commentId";
	}
	mysql_query($sql);
	
}


//Check if a comment has been added.
//if($HTTP_SERVER_VARS['REQUEST_METHOD']=='POST'){
if (isset($_POST['text'])) {
		//get data from post
		$text = $_POST['text'];

		$uString = md5($commentTable . $evalId);
		$checksum = md5($uString);
	
		$sql="insert into $commentTable ($evalIdName, text, reported, uString) values
		($evalId, '$text', 0, '$uString')";
	
		// post comment to database
		mysql_query($sql);

		unset($_POST['text']);

		echo "Thanks for adding a comment.<br />
			Unique String: $uString<br />
			Checksum: $checksum<br />";
}


//Find evaluation in org or super tables depending how the variables are set
$query = "SELECT * FROM $tableName
		where $evalIdName=$evalId";

$result = mysql_query($query);
$row = mysql_fetch_array($result);

//Display evaluation
echo"
<h2>{$row[title]}</h2>
<p class='evalText'>{$row[text]} <a href='index.php?page=evaluationid&$evalIdName=$evalId&report=eval'>report</a></p>
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
	$commentId = $row[$commentIdName];
    echo "
		<div class='comment'>
    		<p>{$row[text]}<a href='index.php?page=evaluationid&$evalIdName=$evalId&commentId=$commentId&report=comment'>report</a></p>
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
