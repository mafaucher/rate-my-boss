<?php

/* Unset the current organization id to reset menu */
if(isset($orgId)) {
        unset($orgId);
}

/* INSERT new business information */

include "../php/checkbusiness.php";

/* INSERT new ad information */

include "../php/checkad.php";

/* SELECT business information */

include "../php/opendb.php";

$query = sprintf("SELECT * FROM business WHERE userId=$userid");
$result = mysql_query($query);

include "../php/closedb.php";

if ($row = mysql_fetch_array($result)) {

	echo "<!-- START OF MAIN -->

	<div class='main'>";
	
	echo "		<h1>Advertisements</h1>\n";

	/* Display company information */

	echo "		<h2>$row[name]</h2>
		<p><strong>Address:</strong> $row[address] </p>
		<p><strong>City:</strong> $row[city] </p>
		<p><strong>State/Province:</strong> $row[state] </p>
		<p><strong>Country:</strong> $row[country] </p>
		<p><strong>Postal Code:</strong> $row[postalCode] </p>
		<p><strong>Email:</strong> $row[email] </p> <br />
		";
	
	echo "		<h2>$row[contactName]</h2>
		<p><strong>Position:</strong> $row[contactPosition] </p>
		<p><strong>Land Number:</strong> $row[contactNumberLand] </p>
		<p><strong>Mobile Number:</strong> $row[contactNumberMobile] </p>
		<p><strong>Fax Number:</strong> $row[contactNumberFax] </p>
		<p><strong>Email:</strong> $row[contactEmail] </p>
		";

	/* Link to business.php, to change business info */

	echo "<p>(<a href='index.php?page=business'>Change information</a>)</p>";
	
	/* TODO: Print list of ads */

	include "../php/opendb.php";

	$query = sprintf("SELECT * FROM ad WHERE userId=$userid");
	$result = mysql_query($query);

	include "../php/closedb.php";

	$count = 0;
	echo "		<ul>";
	while ($row = mysql_fetch_array($result)) {
		if ($count == 0) {
			echo "<br />\n";
			echo "<h2>Your advertisements</h2>\n";
		}
		$count += 1;
		echo "		<li><strong><a href='index.php?page=advertisement&id=$row[adId]'>Avertisement $count</a></strong> <br />";
		if ($row['isPending'] == 1) {
			echo " <em>This advertisement is pending approval from a financial administrator</em><br />";
		}
		echo "				Last viewed: $row[lastView] <br />
							Remaining views: $row[counter] <br />
							<strong>$row[content]</strong></li><br />";
	}

	/* New ad button and form (TODO: validate and confirm price ) */

	echo "		<a href='index.php?page=adform'><button type='button'>Add a New Ad</button></a>\n";

	echo "
	</div>

<!-- END OF MAIN -->
	";

}
/* The business for this agent hasn't been created  */
else {
	include "../php/pages/business.php";
}


?>