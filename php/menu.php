<!-- START OF MENU -->

	<div class="menu">

		<ul>
<?php

print "			<li><strong><a href=index.php?>Main Page</a></strong></li>\n";
print "			<li><strong><a href=index.php?page=organization>Organization List</a></strong></li>\n";

/* If organization was selected */
if (isset($orgId)) {

	/* Show the company name and submenus */
	include "../php/opendb.php";

	$query = "SELECT name FROM organization WHERE orgId=$orgId";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

	include "../php/closedb.php";

	print "			<li>&nbsp;&nbsp;&nbsp;&nbsp;<big>$row[name]:</big></li>\n";
	
	print "			<li>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php?page=organization&id=$orgId>Organization Rating</a></li>\n";
	print "			<li>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php?page=evaluation>Organization Evaluations</a></li>\n";
	print "			<li>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php?page=document>Documents</a></li>\n";
	print "			<li>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php?page=supervisor>Supervisor List</a></li>\n";
}

/* If no user is logged in */
if (isset($pageArray["register"])) {
	print "			<li><strong><a href=index.php?page=register>Register an Account</a></strong></li>\n";
}
/* If any other user is logged in */
else {
	print "			<li><strong><a href=index.php?page=edit>Edit a Previous Post</a></strong></li>\n";
}

/* Restricted menu items */
if (isset($pageArray["advertisement"])) {
	print "			<li><strong><a href=index.php?page=advertisement>Advertisements</a></strong></li>\n";
}
if (isset($pageArray["siteadmin"])) {
	print "			<li><strong><a href=index.php?page=siteadmin>Site Administration</a></strong></li>\n";
}
if (isset($pageArray["financeadmin"])) {
	print "			<li><strong><a href=index.php?page=financeadmin>Financial Administration</a></strong></li>\n";
}

?>
		</ul>

	</div>

<!-- END OF MENU -->
