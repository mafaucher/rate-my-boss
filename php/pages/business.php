<!-- START OF MAIN -->

	<div class="main">

		<h1>Provide Information about your Business</h1>

		<p>We invite you to provide information about the business you
		wish to advertise. You may enter only the information you wish
		to have publicized about your business. You will be able to add
		more information at any time.</p>
		<br />
<?php

/* Unset the current organization id to reset menu */
if(isset($orgId)) {
	unset($orgId);
}

include "../php/opendb.php";

/* Get previously entered values to fill form */

$query = sprintf("SELECT * FROM business WHERE userId=$userid");
$result = mysql_query($query);

include "../php/closedb.php";

$businessname = "";
$businessaddress = "";
$businesscity = "";
$businessstate = "";
$businesscountry = "";
$businesspostalcode = "";
$businesswebsite = "";
$contactname = "";
$contactposition = "";
$contactlandnum = "";
$contactmobilenum = "";
$contactfaxnum = "";
$contactemail = "";

if ($row = mysql_fetch_array($result)) {
	$businessname = "$row[name]";
	$businessaddress = "$row[address]";
	$businesscity = "$row[city]";
	$businessstate = "$row[state]";
	$businesscountry = "$row[country]";
	$businesspostalcode = "$row[postalCode]";
	$businesswebsite = "$row[website]";
	$contactname = "$row[contactName]";
	$contactposition = "$row[contactPosition]";
	$contactlandnum = "$row[contactNumberLand]";
	$contactmobilenum = "$row[contactNumberMobile]";
	$contactfaxnum = "$row[contactNumberFax]";
	$contactemail = "$row[contactEmail]";
}
/* TODO: javascript validation, make contact name and website obligatory */
echo "
		<form name='business' action='index.php?page=advertisement' method='post'>
			<h3>Contact information</h3>
			<p><strong>Company name</strong>:
			<input class='business' type='text' name='businessname' value='$businessname' /></p>
			<p><strong>Address</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input class='business' type='text' name='businessaddress' value='$businessaddress' /></p>
			<p><strong>City</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input class='business' type='text' name='businesscity' value='$businesscity'/></p>
			<p><strong>State/Province</strong>:&nbsp;
			<input class='business' type='text' name='businessstate' value='$businessstate'/></p>
			<p><strong>Country</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input class='business' type='text' name='businesscountry' value='$businesscountry' /></p>
			<p><strong>Postal Code</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input class='business' type='text' name='businesspostalcode' value='$businesspostalcode'/></p>
			<p><strong>Website</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input class='business' type='text' name='businesswebsite' value='$businesswebsite'/></p>
			<br />
			<h3>Contact information</h3>
			<p><strong>Name</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input class='business' type='text' name='contactname' value='$contactname'/></p>
			<p><strong>Position</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input class='business' type='text' name='contactposition' value='$contactposition'/></p>
			<p><strong>Land Number</strong>:&nbsp;&nbsp;&nbsp;
			<input class='business' type='text' name='contactlandnum' value='$contactlandnum'/></p>
			<p><strong>Mobile Number</strong>:
			<input class='business' type='text' name='contactmobilenum' value='$contactmobilenum'/></p>
			<p><strong>Fax Number</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input class='business' type='text' name='contactfaxnum' value='$contactfaxnum'/></p>
			<p><strong>Email</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input class='business' type='text' name='contactemail' value='$contactemail'/></p>
			<br />
			<input type='submit' name='subbusiness' value='Update your information' /></p>
			</form>
	"
?>

	</div>

<!-- END OF MAIN -->
