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

		/* Log user approval */
		$query = "INSERT INTO userActivity (userId, type) VALUE ($row[userId], 'approval')";
		$result = mysql_query($query);
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

/* Active Users */

$query = "SELECT * FROM user WHERE NOT isPending ORDER BY type";
$result = mysql_query($query);

echo "	<h3>Active Users</h3>
	<p>Click on an active user to get the user's history and possible actions.
	Alternatively, you may see details for <a href='index.php?page=siteadmin&id=0'><strong>all users</strong></a>.</p>
	";

while ($row = mysql_fetch_array($result)) {
	echo "
		<p><a href='index.php?page=siteadmin&id=$row[userId]'>$row[name]</a> ($row[type])</p>
		";
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
		<p><strong>$row[name]</strong> - $row[industryType]</p>
		<input type='submit' name='confirm_org_$row[orgId]' value='Allow Organization'/>
		<input type='submit' name='deny_org_$row[orgId]' value='Deny'/></li>
		";
	
}
echo "		</ul>";

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

/* Select all reported orgEval */

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

/* Select all reported orgComment */

$query = "SELECT orgCommentId FROM orgComment WHERE reported";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	if (isset($_POST["confirm_orgComment_$row[orgCommentId]"])) {
		$subquery = "UPDATE orgComment SET reported=0 WHERE orgCommentId=$row[orgCommentId]";
		mysql_query($subquery);
	}
	else if (isset($_POST["deny_orgComment_$row[orgCommentId]"])) {
		$subquery = "DELETE FROM orgComment WHERE orgCommentId=$row[orgCommentId]";
		mysql_query($subquery);
	}
}

$query = "SELECT orgId, title, c.text FROM orgComment c JOIN orgEvaluation e ON c.orgEvalId=e.orgEvalId WHERE c.reported ORDER BY orgId";
$result = mysql_query($query);

echo "		<h3>Reported Organization Comment</h3>
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
		<input type='submit' name='confirm_orgComment_$row[orgCommentId]' value='Unflag'/>
		<input type='submit' name='deny_orgComment_$row[orgCommentId]' value='Remove Comment'/>
		";

}
echo "		</ul>";

/* Select all reported superEval */

$query = "SELECT superEvalId FROM superEvaluation WHERE reported";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	if (isset($_POST["confirm_superEval_$row[superEvalId]"])) {
		$subquery = "UPDATE superEvaluation SET reported=0 WHERE superEvalId=$row[superEvalId]";
		mysql_query($subquery);
	}
	else if (isset($_POST["deny_superEval_$row[superEvalId]"])) {
		$subquery = "DELETE FROM superEvaluation WHERE superEvalId=$row[superEvalId]";
		mysql_query($subquery);
	}
}

$query = "SELECT * FROM superEvaluation WHERE reported ORDER BY superId";
$result = mysql_query($query);

echo "		<h3>Reported Supervisor Evaluations</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	$subquery = "SELECT title FROM supervisor WHERE superId=$row[superId]";
	$subresult = mysql_query($subquery);
	$subrow = mysql_fetch_array($subresult);

	echo "<li>
		<form action='' method='post'>
		<strong>$row[title]</strong> - $subrow[title]</li>
		<p>$row[text]</p>
		<input type='submit' name='confirm_superEval_$row[superEvalId]' value='Unflag'/>
		<input type='submit' name='deny_superEval_$row[superEvalId]' value='Remove Evaluation'/>
		";

}
echo "		</ul>";

/* Select all reported superComment */

$query = "SELECT superCommentId FROM superComment WHERE reported";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	if (isset($_POST["confirm_superComment_$row[superCommentId]"])) {
		$subquery = "UPDATE superComment SET reported=0 WHERE superCommentId=$row[superCommentId]";
		mysql_query($subquery);
	}
	else if (isset($_POST["deny_superComment_$row[superCommentId]"])) {
		$subquery = "DELETE FROM superComment WHERE superCommentId=$row[superCommentId]";
		mysql_query($subquery);
	}
}

$query = "SELECT superId, title, c.text FROM superComment c JOIN superEvaluation e ON c.superEvalId=e.superEvalId WHERE c.reported ORDER BY superId";
$result = mysql_query($query);

echo "		<h3>Reported Supervisor Comment</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	$subquery = "SELECT title FROM supervisor WHERE superId=$row[superId]";
	$subresult = mysql_query($subquery);
	$subrow = mysql_fetch_array($subresult);

	echo "<li>
		<form action='' method='post'>
		<strong>$row[title]</strong> - $subrow[title]</li>
		<p>$row[text]</p>
		<input type='submit' name='confirm_superComment_$row[superCommentId]' value='Unflag'/>
		<input type='submit' name='deny_superComment_$row[superCommentId]' value='Remove Comment'/>
		";

}
echo "		</ul>";




/* Select all reported docs */

$query = "SELECT docId FROM document WHERE reported";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	if (isset($_POST["confirm_doc_$row[docId]"])) {
		$subquery = "UPDATE document SET reported=0 WHERE docId=$row[docId]";
		mysql_query($subquery);
	}
	else if (isset($_POST["deny_doc_$row[docId]"])) {
		$subquery = "DELETE FROM document WHERE docId=$row[docId]";
		mysql_query($subquery);
	}
}

$query = "SELECT * FROM document WHERE reported ORDER BY orgId";
$result = mysql_query($query);

echo "		<h3>Reported Documents</h3>
			<ul>
	";
while ($row = mysql_fetch_array($result)) {

	$subquery = "SELECT name FROM organization WHERE orgId=$row[orgId]";
	$subresult = mysql_query($subquery);
	$subrow = mysql_fetch_array($subresult);

	echo "<li>
		<form action='' method='post'>
		<strong>$row[title]</strong> - $subrow[orgId]</li>
		<input type='submit' name='confirm_doc_$row[docId]' value='Unflag'/>
		<input type='submit' name='deny_doc_$row[docId]' value='Remove Document'/>
		";
}
echo "		</ul>";

/* Select all reported docComment */

$query = "SELECT docCommentId FROM docComment WHERE reported";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	if (isset($_POST["confirm_docComment_$row[docCommentId]"])) {
		$subquery = "UPDATE docComment SET reported=0 WHERE docCommentId=$row[docCommentId]";
		mysql_query($subquery);
	}
	else if (isset($_POST["deny_docComment_$row[docCommentId]"])) {
		$subquery = "DELETE FROM docComment WHERE docCommentId=$row[docCommentId]";
		mysql_query($subquery);
	}
}

$query = "SELECT orgId, title, text FROM docComment c JOIN document d ON c.docId=d.docId WHERE c.reported ORDER BY orgId";
$result = mysql_query($query);

echo "		<h3>Reported Document Comment</h3>
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
		<input type='submit' name='confirm_docComment_$row[docCommentId]' value='Unflag'/>
		<input type='submit' name='deny_docComment_$row[docCommentId]' value='Remove Comment'/>
		";

}
echo "		</ul>";

include "../php/closedb.php";

?>

	</div>

<!-- END OF MAIN -->

