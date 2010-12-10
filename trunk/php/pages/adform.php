<!-- START OF MAIN -->

	<div class="main">

		<h1>Create a New Ad</h1>

		<p>This form allows you to purchase ads for your company. Simply type in the content
		of your ad, along with a series of keywords (max 10) and the number of times you wish
		your ad to be served. You are charged depending on how many times you wish your ad to
		be shown.</p>

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
	
echo "		<p>The current cost per ad displayed is: <strong>$$adPrice</strong></p>\n";

/* TODO: Javascript validation and confirmation */
?>

		<br />
		<form name="ad" onsubmit="return validateAd(this)" action='index.php?page=advertisement' method='post'>
			<p><strong>How many times do you wish you ad to be shown?</strong>
			<input class='ad' type='text' name='counter' /></p>
			<br />
			<p><strong>Type in the content of your ad.</strong> (500 characters max)</p>
			<textarea class='ad' type='text' name='content' cols="75" rows="25"></textarea>
			<br />
			<p><strong>Keyword 1</strong>: &nbsp;<input class='ad' type='text' name='keyword[0]' /></p>
			<p><strong>Keyword 2</strong>: &nbsp;<input class='ad' type='text' name='keyword[1]' /></p>
			<p><strong>Keyword 3</strong>: &nbsp;<input class='ad' type='text' name='keyword[2]' /></p>
			<p><strong>Keyword 4</strong>: &nbsp;<input class='ad' type='text' name='keyword[3]' /></p>
			<p><strong>Keyword 5</strong>: &nbsp;<input class='ad' type='text' name='keyword[4]' /></p>
			<p><strong>Keyword 6</strong>: &nbsp;<input class='ad' type='text' name='keyword[5]' /></p>
			<p><strong>Keyword 7</strong>: &nbsp;<input class='ad' type='text' name='keyword[6]' /></p>
			<p><strong>Keyword 8</strong>: &nbsp;<input class='ad' type='text' name='keyword[7]' /></p>
			<p><strong>Keyword 9</strong>: &nbsp;<input class='ad' type='text' name='keyword[8]' /></p>
			<p><strong>Keyword 10</strong>: <input class='ad' type='text' name='keyword[9]' /></p>
			<br />
			<p></p>
			<input type='submit' name='subad' value='Submit your ad' /></p>
		</form>

	</div>
   
<!-- END OF MAIN -->
