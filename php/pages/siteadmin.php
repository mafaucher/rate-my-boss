<!-- START OF MAIN -->

	<div class="main">

			<h1>Website Administration</h1>

			<p>This panel is accessible to the site's administrators. You may
			view pending organizations and supervisors, as well as other administrators
			which require your approval. You also have access to a list of comments
			which were flagged as inappropriate by users.</p>
			<br />
<?php

/* Unset the current organization id to reset menu */

if(isset($orgId)) {
	unset($orgId);
}

/* TODO: allow or deny options */

/* Pending admins */

include "../php/opendb.php";

$query = "SELECT * FROM user WHERE isPending ORDER BY type";
$result = mysql_query($query);

echo "		<h3>Pending Users</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	echo "<li><strong>row[name]</strong> - row[type]</li>\n";
	
}
echo "		</ul>";

/* Pending organizations */

include "../php/opendb.php";

$query = "SELECT * FROM organization WHERE isPending";
$result = mysql_query($query);

echo "		<h3>Pending Organizations</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	echo "<li><strong>row[name]</strong> - row[industryType]</li>\n";
	
}
echo "		</ul>";

/* Pending Supervisors */

include "../php/opendb.php";

$query = "SELECT * FROM supervisor WHERE isPending ORDER BY orgId";
$result = mysql_query($query);

echo "		<h3>Pending Supervisors</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	$subquery = "SELECT name FROM organization WHERE orgId=$row[orgId]";
	$subresult = mysql_query($subquery);
	$subrow = mysql_fetch_array($subresult);

	echo "<li><strong>row[title]</strong> - subrow[name]</li>\n";
	
}
echo "		</ul>";

/* Select all reported document, orgEval, superEval, orgComment, superComment, docComment 

include "../php/opendb.php";

$query = "SELECT * FROM supervisor WHERE isPending ORDER BY orgId";
$result = mysql_query($query);

echo "		<h3>Pending Supervisors</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	$subquery = "SELECT name FROM organization WHERE orgId=$row[orgId]";
	$subresult = mysql_query($subquery);
	$subrow = mysql_fetch_array($subresult);

	echo "<li><strong>row[title]</strong> - subrow[name]</li>\n";
	
}
echo "		</ul>";
 */
?>

	</div>

<!-- END OF MAIN -->
