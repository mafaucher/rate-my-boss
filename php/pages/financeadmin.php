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

/* Ad Price */

include "../php/opendb.php";

$query = "SELECT adPrice FROM administrator";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$adPrice = $row['adPrice'];

include "../php/closedb.php";

echo "		<p>The current cost per ad displayed is: <strong>$$adPrice</strong></p>\n";

/* TODO: Change price form */

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

/* TODO: List of ads and allow or deny options */

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

	echo "			$row[content]<br />\n";
	echo "			Cost: $$row[cost]<br /><br />\n";
}

/* Close the Last User's list item */

echo "<strong>Total: $$totalPerUser</strong></li><br />";

include "../php/closedb.php";

?>

		</ul>

	</div>

<!-- END OF MAIN -->
