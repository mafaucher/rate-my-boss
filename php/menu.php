<!-- START OF MENU -->

	<div class="menu">

		<ul>
<?php
$titleArray = array(
"company" => "Companies",
"evaluation" => "Company Evaluations",
"document" => "Documents",
"supervisor" => "Supervisor Evaluations",
"advertisement" => "Advertisements",
"siteadmin" => "Site Administration",
"financeadmin" => "Financial Administration",
);

	foreach ($titleArray as $key => $title) {
		print "			<li><a href=index.php?page=$key>$title</a></li>\n";
	}
?>
		</ul>

	</div>

<!-- END OF MENU -->
