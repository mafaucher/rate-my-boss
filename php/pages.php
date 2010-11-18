<?php
	$pageArray = array(
		/* No ID given (main pages) */
		"company" => "../php/pages/company.php",
		"evaluation" => "../php/pages/evaluation.php",
		"document" => "../php/pages/document.php",
		"supervisor" => "../php/pages/supervisor.php",

		// Privileged -- Only inserted if user is of certain type
		"advertisement" => "../php/pages/advertisement.php",
		"siteadmin" => "../php/pages/siteadmin.php",
		"financeadmin" => "../php/pages/financeadmin.php",
		
		/* With ID field */
		"companyid" => "../php/pages/companyid.php",
		"evaluationid" => "../php/pages/evaluationid.php",
		"documentid" => "../php/pages/documentid.php",
		"supervisorid" => "../php/pages/supervisorid.php",

		// Privileged
		"advertisementid" => "../php/pages/advertisementid.php"
	);

	$titleArray = array(
		"company" => "Companies",
		"evaluation" => "Company Evaluations",
		"document" => "Documents",
		"supervisor" => "Supervisor Evaluations",

		// Privileged
		"advertisement" => "Advertisements",
		"siteadmin" => "Site Administration",
		"financeadmin" => "Financial Administration",
	);
	
?>
