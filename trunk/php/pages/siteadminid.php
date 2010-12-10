<!-- START OF MAIN -->

	<div class="main">

			<h1>User Activity</h1>

<?php

/* Unset the current organization id to reset menu */

if(isset($orgId)) {
	unset($orgId);
}

/* Show all */

if ($_GET['id'] == 0) {

	include "../php/opendb.php";

	$query = "SELECT a.time, u.name, u.type, a.type FROM userActivity a JOIN user u ON a.userId=u.userId";
	$result = mysql_query($query);

	include "../php/closedb.php";
	
	echo "
		<p>This page shows the site activity for all users. If you wish to see the activities for
		a specific user, or see possible actions you can take against a user, return to the 'Site
		Administration' page and select the user.</p><br />

		<table border='1'>
		<tr>
		<td><strong>Time</strong></td>
		<td><strong>User Name</strong></td>
		<td><strong>User Type</strong></td>
		<td><strong>Type of Activity</strong></td>
		</tr>
		";

	while ($row = mysql_fetch_array($result)) {
		echo "
		<tr>
		<td>$row[time]</td>
		<td>$row[name]</td>
		<td>$row[type]</td>
		<td>$row[type]</td>
		</tr>";
	}
	echo "</table>";
}

/* Show a specific user */
else {

	if (isset($_POST['suspend'])) {
		$query = "UPDATE user SET isPending=1 WHERE userId=$_GET[id]";
	}

	include "../php/opendb.php";

	$query = "SELECT * FROM userActivity WHERE userId=$_GET[id]";
	$result = mysql_query($query);

	$subquery = "SELECT * FROM user WHERE userId=$_GET[id]";
	$subresult = mysql_query($subquery);
	$subrow = mysql_fetch_array($subresult);

	include "../php/closedb.php";

	echo "
		<p>This page shows the activity of the user <strong>$subrow[name]</strong> ($subrow[type]).</p><br />

		<table border='1'>
		<tr>
		<td><strong>Time</strong></td>
		<td><strong>Type of Activity</strong></td>
		</tr>
		";

	while ($row = mysql_fetch_array($result)) {
		echo "
		<tr>
		<td>$row[time]</td>
		<td>$row[type]</td>
		</tr>";
	}
	echo "</table>";

	if ($subrow['type'] != "admin" && $subrow['type'] != "finance") {
		echo "
			<br /><p>Possible Actions:
			<form action='' method='post'>
			<input type='submit' name='suspend' value='Suspend this User'/></form></p>
			";
	}
}

?>
	</div>

<!-- END OF MAIN -->

