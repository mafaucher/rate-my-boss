<?php

/* Check if a user just registrated */
if (isset($_POST['newpasswordrepeat'])) {

	include "../php/opendb.php";

	$query = "select * from user where userId=$userid AND answer1='$_POST[answer1]' AND answer2='$_POST[answer2]' AND answer3='$_POST[answer3]'";
	$result = mysql_query($query);

	if ($row = mysql_fetch_array($result)) {
		$password = md5($_POST['newpassword']);
		
		/* Log user registration */

		$query = "UPDATE user SET password='$password' WHERE userId=$userid";
		mysql_query($query);

	}
	else {
		echo "Error: answers are incorrect.";
	}


	include "../php/closedb.php";

	unset($_POST['newpasswordrepeat']);
}


?>
