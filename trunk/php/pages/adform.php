<!-- START OF MAIN -->

	<div class="main">

<?php

	/* Unset the current organization id to reset menu */
	if(isset($orgId)) {
	        unset($orgId);
	}

	/* Fetch the Price of ads */

	include "../php/opendb.php";

	$query = sprintf("SELECT adPrice FROM administrator");
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$adPrice = $row['adPrice'];

	include "../php/closedb.php";
	

	echo "

		<h1>Create a New Ad</h1>

		<p>This form allows you to purchase ads for your company. Simply type in the content
		of your ad, along with a series of keywords (max 10) and the number of times you wish
		your ad to be served. You are charged depending on how many times you wish your ad to
		be shown.</p>

		<h3>The current cost per ad displayed is: <strong>$$adPrice</strong></h3>
		<br />
		"
?>

		<form name="ad" onsubmit="return validateAd(this)" action='index.php?page=advertisement' method='post'>
			<p><strong>How many times do you wish you ad to be shown?</strong>
			<input class='ad' type='text' name='counter' /></p>
			<br />
			<p><strong>Type in the content of your ad.</strong> (500 characters max)</p>
			<textarea class='ad' type='text' name='content' cols="75" rows="25"></textarea>
			<br />
			<p><strong>Keyword 1</strong>: &nbsp;<input class='ad' type='text' name='keyword1' /></p>
			<p><strong>Keyword 2</strong>: &nbsp;<input class='ad' type='text' name='keyword2' /></p>
			<p><strong>Keyword 3</strong>: &nbsp;<input class='ad' type='text' name='keyword3' /></p>
			<p><strong>Keyword 4</strong>: &nbsp;<input class='ad' type='text' name='keyword4' /></p>
			<p><strong>Keyword 5</strong>: &nbsp;<input class='ad' type='text' name='keyword5' /></p>
			<p><strong>Keyword 6</strong>: &nbsp;<input class='ad' type='text' name='keyword6' /></p>
			<p><strong>Keyword 7</strong>: &nbsp;<input class='ad' type='text' name='keyword7' /></p>
			<p><strong>Keyword 8</strong>: &nbsp;<input class='ad' type='text' name='keyword8' /></p>
			<p><strong>Keyword 9</strong>: &nbsp;<input class='ad' type='text' name='keyword9' /></p>
			<p><strong>Keyword 10</strong>: <input class='ad' type='text' name='keyword10' /></p>
			<br />
			<p></p>
			<input type='submit' name='subad' value='Submit your ad' /></p>
		</form>

	</div>
   
<!-- END OF MAIN -->
