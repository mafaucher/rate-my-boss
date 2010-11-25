<?php
/* Array used to determine page content. Also used to manage permissions
 * (key only exists if user has permission to visit the page) */

// Permissions not implemented - waiting for user info

	$pageArray = array(
		/* No ID given (main pages) */
		"organization" => "../php/pages/organization.php",
		"evaluation" => "../php/pages/evaluation.php",
		"document" => "../php/pages/document.php",
		"supervisor" => "../php/pages/supervisor.php",

		// Privileged -- Only inserted if user is of certain type
		"advertisement" => "../php/pages/advertisement.php",
		"siteadmin" => "../php/pages/siteadmin.php",
		"financeadmin" => "../php/pages/financeadmin.php",
		
		/* With ID field */
		"organizationid" => "../php/pages/organizationid.php",
		"evaluationid" => "../php/pages/evaluationid.php",
		"documentid" => "../php/pages/documentid.php",
		"supervisorid" => "../php/pages/supervisorid.php",

		// Privileged
		"advertisementid" => "../php/pages/advertisementid.php"
	);

?>
