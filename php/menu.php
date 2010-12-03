<!-- START OF MENU -->

	<div class="menu">

		<ul>
<?php

print "			<li><a href=index.php?>Main Page</a></li>\n";
print "			<li><a href=index.php?page=organization>Organization List</a></li>\n";

/* If organization was selected */
if (isset($orgId)) {
	print "			<li><a href=index.php?page=evaluation>Organization Evaluations</a></li>\n";
	print "			<li><a href=index.php?page=document>Documents</a></li>\n";
	print "			<li><a href=index.php?page=supervisor>Supervisor List</a></li>\n";
}

/* If no user is logged in */
if (isset($pageArray["register"])) {
	print "			<li><a href=index.php?page=register>Register an Account</a></li>\n";
}

/* Restricted menu items */
if (isset($pageArray["advertisement"])) {
	print "			<li><a href=index.php?page=advertisement>Advertisements</a></li>\n";
}
if (isset($pageArray["siteadmin"])) {
	print "			<li><a href=index.php?page=siteadmin>Site Administration</a></li>\n";
}
if (isset($pageArray["financeadmin"])) {
	print "			<li><a href=index.php?page=financeadmin>Financial Administration</a></li>\n";
}

?>
		</ul>

	</div>

<!-- END OF MENU -->
