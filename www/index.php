<?php
	@session_start();
	include("../php/header.php");
	include("../php/pages.php");
	include("../php/GetHostingPackageID.php");

	$flag = 0;
	if(isset($_GET["page"])&&!isset($_GET["error"]))
	{
		$flag = 1;
		if(array_key_exists($_GET["page"], $pageArray))
		{
			include($pageArray[$_GET["page"]]);
		} else {
			$_GET['error'] = 404;
		}
	}
	elseif(isset($_GET["host"]))
	{
		$flag = 1;
		$hostidArray = getHostingPackageID();
		if(in_array($_GET['host'], $hostidArray))
		{
			include("../php/HostingPackages.php");
		} else {
			$_GET['error'] = 404;
		}
	}
        if(isset($_GET["error"]))
	{
		$flag = 1;
		include("../php/statusCodes.php");
	}
	if($flag == 0)
	{
		include($pageArray['services']);
	}
	include("../php/footer.php")
?>
