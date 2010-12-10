<?php
/* Array used to determine page content. Also used to manage permissions
 * (key only exists if user has permission to visit the page) */

$pageArray = array(
	/* No ID given (main pages) */
	"organization" => "../php/pages/organization.php",
	"evaluation" => "../php/pages/evaluation.php",
	"document" => "../php/pages/document.php",
	"supervisor" => "../php/pages/supervisor.php",
	"suggestorg" => "../php/pages/suggestorg.php",
	"suggestsuper" => "../php/pages/suggestsuper.php",
	"edit" => "../php/pages/edit.php",

	/* With ID field */
	"evaluationform" => "../php/pages/evaluationform.php",
	"organizationid" => "../php/pages/organizationid.php",
	"evaluationid" => "../php/pages/evaluationid.php",
	"documentid" => "../php/pages/documentid.php",
	"supervisorid" => "../php/pages/supervisorid.php",
	"ratingform" => "../php/pages/ratingform.php",
	"documentform" => "../php/pages/documentform.php",
	"documentupload" => "../php/pages/upload_file.php"
);

// Privileged -- Only inserted if user is of certain type
switch ($usertype) {
case "agent":
	$pageArray["advertisement"] = "../php/pages/advertisement.php";
	$pageArray["advertisementid"] = "../php/pages/advertisementid.php";
	$pageArray["adform"] = "../php/pages/adform.php";
	$pageArray["business"] = "../php/pages/business.php";
	break;
case "admin":
	$pageArray["siteadmin"] = "../php/pages/siteadmin.php";
	$pageArray["siteadminid"] = "../php/pages/siteadminid.php";
	break;
case "finance":
	$pageArray["financeadmin"] = "../php/pages/financeadmin.php";
	break;
case "registered":
	break;
default:
	$pageArray["register"] = "../php/pages/register.php";
	break;
}

?>
