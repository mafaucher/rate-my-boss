<div class="main">
<?php


if (!isset($_SESSION['editId'])) {
	$_SESSION['defaultTitle'] = "";
	$_SESSION['defaultContent'] = "";
}

if($_GET['return'] == 'org' || $_SESSION['editType'] == 'org')
{
	echo "<form name='evaluation' action='index.php?page=evaluation' method='post'>";
} else {
	if (isset($_GET['superId'])) {
		$superId = $_GET['superId'];
	} else {
		$superId = $_SESSION['editId'];
	}
	echo "<form name='evaluation' action='index.php?page=supervisorid&superId=$superId' method='post'>";
}
echo "
	<p>Title: <input type='text' name='title' value='$_SESSION[defaultTitle]' /></p>
	<p><textarea type='text' name='content' cols='60' rows='15' >$_SESSION[defaultContent]</textarea></p>
	<input type='submit' name='submitEval' value='Submit Evaluation' />
</form>
</div>
";
?>
