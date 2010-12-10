<div id="orgHeader">
<?php
/* Show the company name and submenus */
	include "../php/opendb.php";
if (isset($orgId))
{
	$query = "SELECT name FROM organization WHERE orgId=$orgId";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
echo "
<h3>
	$row[name]
";
}
?>
</h3>
</div>
