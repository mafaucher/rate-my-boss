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

$query = "SELECT content, name, website FROM ad NATURAL JOIN (tag, business) WHERE tag.keyword='$_GET[search]' AND NOT ad.isPending AND ad.counter>0 ORDER BY ad.lastView LIMIT 1";
$result = mysql_query($query);

if ($row = mysql_fetch_array($result)) {
	echo "
		<p><strong>$row[content]</strong></p>
		<p><small>An advertisement from our sponsors: <strong><a href='$row[website]'>$row[name]</a></strong></p>
		<br />
		";
	/* Update ad */
}

include "../php/closedb.php";

?>

	</div>

<!-- END OF MAIN -->
