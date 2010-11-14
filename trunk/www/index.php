<?php
	@session_start();
	
	// Prepend page header 
	include("../php/header.php");

	// Load $pageArray
	include("../php/pages.php");

	// Check for "page=<type>" in query string
	// and load content from <type>.php if exists
	if(isset($_GET["page"]))
	{
		if(array_key_exists($_GET["page"], $pageArray))
		{
			// If an "id=<id#>" exists, load corresponding <type>id.php
			if(isset($_GET["id"]))
			{
				include($pageArray[$_GET["page"]."id"]);
				// Get ID from: $_GET["id"]
			}
			// Else load main <type>.php
			else
			{
				include($pageArray[$_GET["page"]]);
			}
		}
		// Else 404 error
		else { $_GET["error"] = 404; }
	}
	// Check for "search=<keyword>" in query string
	elseif(isset($_GET["search"]))
	{
		// Load search page
		include("../php/pages/search.php")
		// Get keyword from $_GET["search"]
	}

	// Append page footer
	include("../php/footer.php")
?>
