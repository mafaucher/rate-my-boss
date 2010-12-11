<div class="main">

<?php
if (isset($_GET['orgId'])) {
	$orgId = $_GET['orgId'];
}

include "../php/opendb.php";

if (isset($_SESSION['editId'])) {
	if ($_SESSION['editType'] == "super") {
		$tableName = 'superEvaluation';
		$evalIdName = 'superEvalId';
		$evalId = $_SESSION['editEvalId'];
		
		$commentTable = 'superComment';
		$commentIdName = 'superCommentId';
	}
	else {
		$tableName = 'orgEvaluation';
		$evalIdName = 'orgEvalId';
		$evalId = $_SESSION['editEvalId'];
		
		$commentTable = 'orgComment';
		$commentIdName = 'orgCommentId';
	}
}
else {
	//check if a supervisor id is givin, if so pull from superEvaluation table. Otherwise pull from orgEvaluation table.
	if (isset($_GET["superEvalId"])) {
		$tableName = 'superEvaluation';
		$evalIdName = 'superEvalId';
		$evalId = $_GET["superEvalId"];
		
		$commentTable = 'superComment';
		$commentIdName = 'superCommentId';
	}
	else {
		$tableName = 'orgEvaluation';
		$evalIdName = 'orgEvalId';
		$evalId = $_GET["orgEvalId"];
		
		$commentTable = 'orgComment';
		$commentIdName = 'orgCommentId';
	}
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

include "../php/closedb.php";
include "../php/opendb.php";

//Check if a comment has been added.
//if($HTTP_SERVER_VARS['REQUEST_METHOD']=='POST'){
if (isset($_POST['text'])) {

		//get data from post
		$text = $_POST['text'];

		if (isset($_SESSION['editId'])) {
			$sql="UPDATE $commentTable SET text='$text' WHERE $commentIdName=$_SESSION[editId]";
			mysql_query($sql);

			echo "Your comment was updated. <br />";

			unset($_SESSION['editId']);
			unset($_SESSION['editType']);
			unset($_SESSION['editEvalId']);
		}
		else {
	
			$sql="insert into $commentTable ($evalIdName, text, reported, uString) values
				($evalId, '$text', 0, '')";
			// post comment to database
			mysql_query($sql);

			
			$lastid = mysql_insert_id();
			$uString = md5($commentTable.$lastid);
			$checksum = md5($uString);

			$sql="update $commentTable set uString='$uString' WHERE $commentIdName=$lastid";
			mysql_query($sql);

			echo "Thanks for adding a comment.<br />
				Unique String: $uString<br />
				Checksum: $checksum<br />";
		}
	unset($_POST['text']);
}

//Find evaluation in org or super tables depending how the variables are set
$query = "SELECT * FROM $tableName
		where $evalIdName=$evalId";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

//Display evaluation
echo"
<h2>{$row[title]}</h2>
<p class='evalText'>{$row[text]}<br /><a href='index.php?page=evaluationid&$evalIdName=$evalId&report=eval'>report</a></p>
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
    		<p>{$row[text]}<br /><a href='index.php?page=evaluationid&$evalIdName=$evalId&commentId=$commentId&report=comment'>report</a></p>
		</div>
		";
}
if (isset($_SESSION['editId'])) {
	$defaultContent = $_SESSION['defaultContent'];
}
else {
	$defaultContent = "";
}
echo "
<p><strong> Enter a comment:</strong></p>
<form name='comment' action='index.php?page=evaluationid&$evalIdName=$evalId' method='post'>
<p><textarea type='text' name='text' cols='60' rows='10'>$defaultContent</textarea></p>
<input type='submit' name='submitComment' value='Submit Comment' />
</form>

</div>
";
?>
