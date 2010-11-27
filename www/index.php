<?php

/* SESSION */
session_start();
include("../php/session.php");
	
/* GLOBAL_VARS */
include("../php/global.php");

/* HEADER */
include("../php/header.php");

/* LOGIN */
include("../php/checklogin.php");
include("../php/login.php");

/* SEARCHBOX */
include("../php/searchbox.php");

/* PAGE INFORMATION (permissions and menu entries) */
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

		/* Not implemented: <type> does not exist 
		} else {
			//$_GET["error"] = 404;
		} */
	}
} else {
	/* Unset the current organization id to reset menu */
	if(isset($orgid)) {
		unset($orgid);
	}

	/* Check for "search=<keyword>" in query string */
	if(isset($_GET["search"])) {
		/* Load search page */
		include("../php/pages/search.php");
		// To get keyword: $_GET["search"]

	/* Load main page */
	} else {
		include("../php/pages/main.php");
	}
}

/* MENU */
include("../php/menu.php");

/* FOOTER */
include("../php/footer.php");

?>
