<div class="main">
<?php
include "../php/opendb.php";
$docId = $_GET['docId'];

//Report comments when flagged
if (isset($_GET["report"]))
{
	$commentId = $_GET["commentId"];
		
	$sql="UPDATE docComment SET reported = 1
		WHERE docCommentId = $commentId";
	mysql_query($sql);
}

// Add comment to database
if (isset($_POST['text'])) {
		//get data from post
		$text = $_POST['text'];
	
		$sql="insert into docComment (docId, text, reported, uString) values
		($docId, '$text', 0, 'aaa')";
	
		// post comment to database
		mysql_query($sql);

		unset($_POST['text']);
}


//Find document from document table
$query = "SELECT * FROM document
		where docId=$docId";

$result = mysql_query($query);
$row = mysql_fetch_array($result);

$filename = "documents/". $row[filename];
//Display document title
echo"
<h2>{$row[title]}</h2>
<a href='$filename'><button type='button'>Download Document</button></a>
<br />
<br />
<span class='score'>Comments:</span>
";

//Display comments

$query = "SELECT * FROM docComment
		WHERE docId=$docId";
$result = mysql_query($query);

// Display list of comments attributed to the document
while($row = mysql_fetch_array($result))
{
    echo "
		<div class='comment'>
    		<p>{$row[text]}<a href='index.php?page=documentid&docId=$docId&commentId=$row[docCommentId]&report=comment'>report</a></p>
		</div>
		";
}
echo "
<p><strong> Enter a comment:</strong></p>
<form name='comment' action='index.php?page=documentid&docId=$docId' method='post'>";
?>
<p><textarea type='text' name='text' cols="60" rows="10"></textarea></p>
<input type='submit' name='submitComment' value='Submit Comment' />
</form>

</div>
