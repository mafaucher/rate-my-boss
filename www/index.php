<?php
session_start();
	
/* HEADER */
include("../php/header.php");

/* Load $pageArray */
include("../php/pages.php");

/* Check for "page=<type>" in query string
 * and load content from <type>.php if exists */
if(isset($_GET["page"])) {

	if(array_key_exists($_GET["page"], $pageArray)) {

		/* If an "id=<id#>" exists, load corresponding <type>id.php */
		if(isset($_GET["id"])) {

			include($pageArray[$_GET["page"]."id"]);
			// To get ID: $_GET["id"]

		/* Load main <type>.php */
		} else {
			include($pageArray[$_GET["page"]]);
		}

	/* <type> does not exist */
	} else {
		//$_GET["error"] = 404; // Not yet implemented
	}
	/* Check for "search=<keyword>" in query string */
} elseif(isset($_GET["search"])) {
	/* Load search page */
	include("../php/pages/search.php");
	// To get keyword: $_GET["search"]
}

/* FOOTER */
include("../php/footer.php");
?>
