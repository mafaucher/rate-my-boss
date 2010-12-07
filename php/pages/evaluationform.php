<div class="main">
<?php
	
	$superId = $_GET['superId'];

	if($_GET['return'] == 'org')
	{
		echo "<form name='evaluation' action='index.php?page=evaluation' method='post'>";
	} else {
		echo "<form name='evaluation' action='index.php?page=supervisorid&superId=$superId' method='post'>";
	}
?>
	<p>Title: <input type='text' name='title' /></p>
	<p><textarea type='text' name='content' cols="60" rows="15"></textarea></p>
	<input type='submit' name='submitEval' value='Submit Evaluation' />
</form>
</div>
