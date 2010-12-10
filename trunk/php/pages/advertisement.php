<?php

/* Unset the current organization id to reset menu */
if(isset($orgId)) {
        unset($orgId);
}

/* Check if user created a new ad# */

include "../php/checkad.php";

/* Check business information */

include "../php/checkbusiness.php";

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
		<p><strong>Website:</strong> $row[website] </p> <br />
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
	
	/* TODO: Display specific ad detail and allow purchasing additional funds */

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
		if ($row['cost'] > 0) {
			echo " <em>Financial administrators are awaiting $$row[cost] for this ad.</em><br />";
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
