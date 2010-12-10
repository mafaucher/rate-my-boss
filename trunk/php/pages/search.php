<!-- START OF MAIN -->

<?php

/* Unset the current organization id to reset menu */
if(isset($orgId)) {
	unset($orgId);
}

?>
	<div class="main">

		<h1>Search results:</h1>

<?php

include "../php/opendb.php";

/* Get the first, least recently used and active AD corresponding to keyword */

$query = "SELECT a.adId, content, name, website FROM ad AS a JOIN (tag AS t, business AS b) ON a.adId=t.adId AND a.userId=b.userId WHERE NOT a.isPending AND a.counter>0 AND t.keyword like '%$_GET[search]%' ORDER BY a.lastView LIMIT 1";
	
$result = mysql_query($query);

if ($row = mysql_fetch_array($result)) {
	echo "
		<p><strong>$row[content]</strong></p>
		<p><small>An advertisement from our sponsors: <strong><a href='$row[website]'>$row[name]</a></strong></small></p>
		<br />
		";

	/* Update ad */

	$subquery = "UPDATE ad SET counter = counter - 1, hits = hits + 1, lastView = CURRENT_TIMESTAMP() WHERE adId=$row[adId]";
	mysql_query($subquery);
}


$stype = $_GET[stype];

if (isset($stype)) {

	/* Search by organization */

	if (in_array("org", $stype)) {

		echo "
			<h3>Organizations</h3>
			";
	
		$query = "SELECT orgId, name FROM organization WHERE name LIKE '%$_GET[search]%' OR industryType LIKE '%$_GET[search]%' OR province LIKE '%$_GET[search]%' AND NOT isPending";
	
		$result = mysql_query($query);
	
		while ($row = mysql_fetch_array($result)) {
			echo "
				<p><a href='index.php?page=organization&id=$row[orgId]'>$row[name]</a></p>
				";
		}
	}

	/* Search by Organization evaluations */

	if (in_array("orgEval", $stype)) {
		echo "
			<h3>Organization Evaluations</h3>
			";
	
		$query = "SELECT e.orgId, e.orgEvalId, e.title FROM orgEvaluation e LEFT JOIN orgComment c ON (e.orgEvalId=c.orgEvalId) WHERE e.title LIKE '%$_GET[search]%' OR e.text LIKE '%$_GET[search]%' OR c.text LIKE '%$_GET[search]%' GROUP BY e.orgEvalId";
		$result = mysql_query($query);
	
		while ($row = mysql_fetch_array($result)) {
			echo "
				<p><a href='index.php?page=evaluationid&orgEvalId=$row[orgEvalId]&orgId=$row[orgId]'>$row[title]</a></p>
				";
		}
	}

	if (in_array("doc", $stype)) {

	}

	if (in_array("super", $stype)) {

	}
	
	/* Search by Supervisor evaluations */

	if (in_array("superEval", $stype)) {
		echo "
			<h3>Supervisor Evaluations</h3>
			";
		$query = "SELECT s.orgId, e.superId, e.superEvalId, e.title FROM superEvaluation e LEFT JOIN superComment c ON (e.superEvalId=c.superEvalId) JOIN supervisor s ON (e.superId=s.superId) WHERE e.title LIKE '%$_GET[search]%' OR e.text LIKE '%$_GET[search]%' OR c.text LIKE '%$_GET[search]%' GROUP BY e.superEvalId";
		$result = mysql_query($query);
	
		while ($row = mysql_fetch_array($result)) {
			echo "
				<p><a href='index.php?page=evaluationid&superEvalId=$row[superEvalId]&orgId=$row[orgId]&superId=$row[superId]'>$row[title]</a></p>
				";
		}
	}

}


include "../php/closedb.php";

?>

	</div>

<!-- END OF MAIN -->
