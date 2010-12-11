<div class="main">
<?php
include "../php/opendb.php";
$docId = $_GET['docId'];

//Report comments or document when flagged
if (isset($_GET["report"]))
{
	$reportType = $_GET["report"];
	
	if($reportType == "comment")
	{	
		$commentId = $_GET["commentId"];
		$sql="UPDATE docComment SET reported = 1
			WHERE docCommentId = $commentId";
	} else {
		$sql="UPDATE document SET reported = 1
			WHERE docId = $docId";
	}
	
	mysql_query($sql);
}
include "../php/closedb.php";

include "../php/opendb.php";
// Add comment to database
if (isset($_POST['text'])) {
	//get data from post
	$text = $_POST['text'];
	
	if (isset($_SESSION['editId'])) {

		$sql="update docComment set text='$text' WHERE docCommentId=$_SESSION[editId]";
		mysql_query($sql);

		echo "Your comment has been updated";
		unset($_SESSION['editId']);
	}
	else {
	
		$sql="insert into docComment (docId, text, reported, uString) values
			($docId, '$text', 0, '')";
	
		// post comment to database
		mysql_query($sql);

		$lastid = mysql_insert_id();
		$uString=md5("docComment".$lastid);
		$checksum=md5($uString);

		$sql="update docComment set uString='$uString' WHERE docCommentId=$lastid";
		mysql_query($sql);

		echo "Thanks for adding a comment.<br />
			Unique String: $uString<br />
			Checksum: $checksum<br />";
	}
		
		unset($_POST['text']);
}
if (isset($_SESSION['editDocId'])) {
	$docId = $_SESSION['editDocId'];
	unset($_SESSION['editDocId']);
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
<a href='index.php?page=documentid&docId=$docId&report=document'>report</a>
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
    		<p>{$row[text]}<br /><a href='index.php?page=documentid&docId=$docId&commentId=$row[docCommentId]&report=comment'>report</a></p>
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
<form name='comment' action='index.php?page=documentid&docId=$docId' method='post'>
<p><textarea type='text' name='text' cols='60' rows='10'>$defaultContent</textarea></p>
<input type='submit' name='submitComment' value='Submit Comment' />
</form>
</div>";
?>
