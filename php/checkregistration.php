<?php

/* Check if a user just registrated */
if (isset($_POST['newusername'])) {

	$password = md5($_POST['newpassword']);
	$isPending = 0;
	
	/* Check if user type is restricted */
	if ($_POST['register'] == "admin" || $_POST['register'] == "finance") {
		$isPending = 1;
	}

	include "../php/opendb.php";
	
	/* Check if a user with that name exists */
	$query = sprintf("SELECT name FROM user WHERE name='%s'",
			mysql_real_escape_string($_POST['newusername']));
	
	$result = mysql_query($query);

	/* Display error message in login box */
	if ($row = mysql_fetch_array($result)) {
		echo "<strong>Error: a user with that name already exists!</strong>";
	}
	else {
		/* Prepare the query */	
		$query = sprintf("INSERT INTO user (name, password, type, answer3, answer2, answer3, isPending) values
				('%s', '%s', '%s', '%s', '%s', '%s', '%d')",
				mysql_real_escape_string($_POST['newusername']),
				$password,
				mysql_real_escape_string($_POST['register']),
				mysql_real_escape_string($_POST['answer1']),
				mysql_real_escape_string($_POST['answer2']),
				mysql_real_escape_string($_POST['answer3']),
				$isPending);
		
		/* Output error message */
		$result = mysql_query($query);
		if ($result != '1') echo $result; // For testing purposes

	}

	include "../php/closedb.php";

	unset($_POST['newusername']);
}


?>
