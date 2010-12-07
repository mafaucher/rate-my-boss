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

/* Allow or deny options */

include "../php/opendb.php";

$query = "SELECT userId FROM user WHERE isPending";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	if (isset($_POST["confirm_user_$row[userId]"])) {
		$subquery = "UPDATE user SET isPending=0 WHERE userId=$row[userId]";
		mysql_query($subquery);
	}
	else if (isset($_POST["deny_user_$row[userId]"])) {
		$subquery = "DELETE FROM user WHERE userId=$row[userId]";
		mysql_query($subquery);
	}
}

/* Pending admins */


$query = "SELECT * FROM user WHERE isPending ORDER BY type";
$result = mysql_query($query);

echo "		<h3>Pending Users</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	echo "<li>
		<form action='' method='post'>
		<p><strong>$row[name]</strong> - $row[type]</li>
		<input type='submit' name='confirm_user_$row[userId]' value='Confirm Access'/>
		<input type='submit' name='deny_user_$row[userId]' value='Deny'/></p>
		";
	
	
}
echo "		</ul>";

include "../php/opendb.php";

$query = "SELECT orgId FROM organization WHERE isPending";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	if (isset($_POST["confirm_org_$row[orgId]"])) {
		$subquery = "UPDATE organization SET isPending=0 WHERE orgId=$row[orgId]";
		mysql_query($subquery);
	}
	else if (isset($_POST["deny_org_$row[orgId]"])) {
		$subquery = "DELETE FROM organization WHERE orgId=$row[orgId]";
		mysql_query($subquery);
	}
}

/* Pending organizations */


$query = "SELECT * FROM organization WHERE isPending";
$result = mysql_query($query);

echo "		<h3>Pending Organizations</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	echo "<li>
		<form action='' method='post'>
		<p><strong>$row[name]</strong> - $row[industryType]</li>
		<input type='submit' name='confirm_org_$row[orgId]' value='Allow Organization'/>
		<input type='submit' name='deny_org_$row[orgId]' value='Deny'/></p>
		";
	
}
echo "		</ul>";

include "../php/opendb.php";

$query = "SELECT superId FROM supervisor WHERE isPending";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	if (isset($_POST["confirm_super_$row[superId]"])) {
		$subquery = "UPDATE supervisor SET isPending=0 WHERE superId=$row[superId]";
		mysql_query($subquery);
	}
	else if (isset($_POST["deny_super_$row[superId]"])) {
		$subquery = "DELETE FROM supervisor WHERE superId=$row[superId]";
		mysql_query($subquery);
	}
}

/* Pending Supervisors */

$query = "SELECT * FROM supervisor WHERE isPending ORDER BY orgId";
$result = mysql_query($query);

echo "		<h3>Pending Supervisors</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	$subquery = "SELECT name FROM organization WHERE orgId=$row[orgId]";
	$subresult = mysql_query($subquery);
	$subrow = mysql_fetch_array($subresult);

	echo "<li>
		<form action='' method='post'>
		<strong>$row[title]</strong> - $subrow[name]</li>
		<input type='submit' name='confirm_super_$row[superId]' value='Allow Supervisor'/>
		<input type='submit' name='deny_super_$row[superId]' value='Deny'/></p>
		";
	
}
echo "		</ul>";

/* elect all reported document, orgEval, superEval, orgComment, superComment, docComment */

include "../php/opendb.php";
$query = "SELECT orgEvalId FROM orgEvaluation WHERE reported";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	if (isset($_POST["confirm_orgEval_$row[orgEvalId]"])) {
		$subquery = "UPDATE orgEvaluation SET reported=0 WHERE orgEvalId=$row[orgEvalId]";
		mysql_query($subquery);
	}
	else if (isset($_POST["deny_orgEval_$row[orgEvalId]"])) {
		$subquery = "DELETE FROM orgEvaluation WHERE orgEvalId=$row[orgEvalId]";
		mysql_query($subquery);
	}
}

$query = "SELECT * FROM orgEvaluation WHERE reported ORDER BY orgId";
$result = mysql_query($query);

echo "		<h3>Reported Organization Evaluations</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	$subquery = "SELECT name FROM organization WHERE orgId=$row[orgId]";
	$subresult = mysql_query($subquery);
	$subrow = mysql_fetch_array($subresult);

	echo "<li>
		<form action='' method='post'>
		<strong>$row[title]</strong> - $subrow[name]</li>
		<p>$row[text]</p>
		<input type='submit' name='confirm_orgEval_$row[orgEvalId]' value='Unflag'/>
		<input type='submit' name='deny_orgEval_$row[orgEvalId]' value='Remove Evaluation'/>
		";

}
echo "		</ul>";

?>

	</div>

<!-- END OF MAIN -->
