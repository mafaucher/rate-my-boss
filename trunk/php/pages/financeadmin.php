<!-- START OF MAIN -->

	<div class="main">

			<h1>Financial Administration</h1>

			<p>This panel is only accessible to the site's financial administrators. You may
			set the cost of future ads.</p>

<?php

/* Unset the current organization id to reset menu */

if(isset($orgId)) {
	unset($orgId);
}

/* Change Price */

if (isset($_POST['cost'])) {
	include "../php/opendb.php";

	$query = "UPDATE administrator SET adPrice=$_POST[cost] WHERE adminId=0";
	mysql_query($query);

	include "../php/closedb.php";
	
	unset($_POST['cost']);
}

include "../php/opendb.php";

$query = "SELECT adId FROM ad WHERE cost>0 ORDER BY userId";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	if (isset($_POST["confirm_$row[adId]"])) {
		$subquery = "UPDATE ad SET cost=0 WHERE adId=$row[adId]";
		mysql_query($subquery);
	}
	else if (isset($_POST["deny_$row[adId]"])) {
		$subquery = "DELETE FROM ad WHERE adId=$row[adId]";
		mysql_query($subquery);
	}
}

/* Get Price */

$query = "SELECT adPrice FROM administrator";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$adPrice = $row['adPrice'];

include "../php/closedb.php";

/* Change price form */

echo "
			<form name='adPrice' action='' method='post'>
			<p><strong>The current cost per ad is:</strong>:
			<input class='adPrice' type='text' name='cost' value='$adPrice'/>
			<input type='submit' name='subbusiness' value='Update the Price' /></p>
			</form>
	";

echo "
			<br />
			<p>Below are all the ads which have been created and are awaiting payment from their
			respective business agents. Once the payment has been received, you may allow the ads
			to circulate the search results. If an ad contains inappropriate content or their
			business fails to provide payment, you may also deny the ad and cancel payment.</p>
			<br />

			<ul>
	";

/* Pending ads */

include "../php/opendb.php";

$query = "SELECT * FROM ad WHERE cost>0 ORDER BY userId";
$result = mysql_query($query);

/* List of ads and allow or deny options */

$currentUser = 0;
$totalPerUser = 0;

while ($row = mysql_fetch_array($result)) {

	if ($currentUser != $row['userId']) {

		/* Close the previous User's list item */

		if ($currentUser != 0) {
			echo "<strong>Total: $$totalPerUser</strong></li><br /><br />\n";
		}

		/* Create a list item for the next user */

		$currentUser = $row['userId'];
		$totalPerUser = 0;
		
		$subquery = "SELECT contactName FROM business WHERE userId=$currentUser";
		$subresult = mysql_query($subquery);
		$subrow = mysql_fetch_array($subresult);
		echo "<li> <strong>$subrow[contactName]</strong>:<br />\n";
	}
	$totalPerUser += $row['cost'];

	echo "
			<form action='' method='post'>
				<p>$row[content]<br />
				Cost: $$row[cost]
				<input type='submit' name='confirm_$row[adId]' value='Confirm Payment'/>
				<input type='submit' name='deny_$row[adId]' value='Deny'/></p>
			</form>
		";
}

/* Close the Last User's list item */

echo "<strong>Total: $$totalPerUser</strong></li><br />";

include "../php/closedb.php";

?>

		</ul>

	</div>

<!-- END OF MAIN -->
