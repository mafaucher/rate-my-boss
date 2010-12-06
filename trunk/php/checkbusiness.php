<?php

/* Check if a user just registrated */
if (isset($_POST[businessname])) {
	include "../php/opendb.php";

	// userId, name, charter (NULL), address, city, state, country, postalCode, email,
	// contactName, contactNumberLand, contactNumberMobile, contactNumberFax, contactPosition, contactEmail
	$query = sprintf("REPLACE INTO business (userId, name, charter, address, city, state, country, postalCode, email,
		contactName, contactNumberLand, contactNumberMobile, contactNumberFax, contactPosition, contactEmail) VALUES
		(%d, '%s', NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
			$userid,
			mysql_real_escape_string($_POST[businessname]),
			mysql_real_escape_string($_POST[businessaddress]),
			mysql_real_escape_string($_POST[businesscity]),
			mysql_real_escape_string($_POST[businessstate]),
			mysql_real_escape_string($_POST[businesscountry]),
			mysql_real_escape_string($_POST[businesspostalcode]),
			mysql_real_escape_string($_POST[businessemail]),
			mysql_real_escape_string($_POST[contactname]),
			mysql_real_escape_string($_POST[contactlandnum]),
			mysql_real_escape_string($_POST[contactmobilenum]),
			mysql_real_escape_string($_POST[contactfaxnum]),
			mysql_real_escape_string($_POST[contactposition]),
			mysql_real_escape_string($_POST[contactemail]));
	$result = mysql_query($query);

	include "../php/closedb.php";
	unset($_POST[businessname]);
}
?>
