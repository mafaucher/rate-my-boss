<!-- START OF MAIN -->

	<div class='main'>
	
		<h1>Advertisement Control</h1>

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

if (isset($_POST['adViews'])) {
	include "../php/opendb.php";

	$additionalViews = (int)$_POST['adViews'];
	$cost = (float)($additionalViews*$adPrice);

	$query = "UPDATE ad SET counter=counter+$additionalViews, cost=$cost, isPending=1 WHERE adId=$_GET[id]";
	$result = mysql_query($query);

	include "../php/closedb.php";
	unset($_POST['adViews']);
}

include "../php/opendb.php";

$query = sprintf("SELECT * FROM ad WHERE adId='$_GET[id]'");
$result = mysql_query($query);
$row = mysql_fetch_array($result);

include "../php/closedb.php";

/* Display ad information */

echo "
	<p><strong>Ad Content:</strong></p>
	<p>$row[content]</p> <br />
	";

if ($row[isPending]) {
	echo "
		<p><em>This ad is pending approval from a financial administrator,
		please make sure you have send a payment of $$row[cost].</em><p>
		";
}
echo "
	<p><strong>Number of Views</strong> (hits): $row[hits]</p>
	<p><strong>Remaining Views</strong>: $row[counter]</p>
	<p><strong>Last Viewed</strong>: $row[lastView]</p>
	";


echo "      <p>The current cost per ad displayed is: <strong>$$adPrice</strong></p>\n";

echo "
	<form action='' method='post'>
	<p><strong>Purchase more views</strong>: <input type='text' name='adViews' /> <input type='submit' name='subAdViews' value='Purchase' />
	";

?>
	</div>

<!-- END OF MAIN -->
