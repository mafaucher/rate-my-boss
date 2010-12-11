<?php
/**
 * This code is called to verify the session information every time
 * the page is loaded and perform verifications against the 'user' table
 **/

/**
 * Error codes:
 * 0 = no error
 * 1 = no username
 * 2 = no password
 * 3 = username doesn't exist
 * 4 = username/password do not match
 **/

/* Set variables using POST */
$username = $_POST["username"];
$password = md5($_POST["password"]);
$userId = 0;
$usertype = "";
//echo $password; // For testing, uncomment to get md5 checksum

/* Initialize session error variable */
if (!isset($_SESSION["error"])) {
	$_SESSION["error"] = 0;
}

/* Check is cookies were stored using "Remember me" */
elseif(isset($_COOKIE["name"]) && isset($_COOKIE["pass"])){
	$_SESSION["username"] = $_COOKIE["username"];
	$_SESSION["password"] = $_COOKIE["password"];
	$_SESSION["usertype"] = $_COOKIE["usertype"];
	$_SESSION["userid"] = $_COOKIE["userid"];
	$_SESSION["error"] = 0;
}

/* Check is session info is already set. */
if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {
	$username = $_SESSION["username"];
	$password = $_SESSION["password"];
	$usertype = $_SESSION["usertype"];
	$userid = $_SESSION["userid"];
	$_SESSION["error"] = 0;
}

/* No info inserted */
elseif( empty($_POST["username"]) && empty($_POST["password"]) ) {
	$_SESSION["error"] = 0;
}

/* No username inserted */
elseif( empty($_POST["username"]) && !empty($_POST["password"]) ) {
	$_SESSION["error"] = 1;
}

/* No password inserted */
elseif( empty($_POST["password"]) && !empty($_POST["username"]) ) {
	$_SESSION["error"] = 2;
}

/* Ready for validation */
else {
	/* SQL query */
	include "../php/opendb.php";
	
	$query = sprintf("SELECT userId, password, type FROM user WHERE name='%s' AND NOT isPending",
		mysql_real_escape_string($username));
	$result = mysql_query($query);

	include "../php/closedb.php";

	/* User info validates*/
	if ($row = mysql_fetch_array($result)) {
		if ($row['password'] == $password) {
			$usertype = $row['type'];
			$userid = $row['userId'];

			/* Set session information */
			$_SESSION["error"] = 0;
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;
			$_SESSION["usertype"] = $usertype;
			$_SESSION["userid"] = $userid;
			$_SESSION["logged"] = true;
			
			/* Set cookies if "Remember me" is selected */
			if (isset($_POST["remember"]) ) {
				$_COOKIE["username"] = $username;
				$_COOKIE["password"] = $password;
				$_COOKIE["usertype"] = $usertype;
				$_COOKIE["userid"] = $userid;
			}

			/* Log user login */
			include "../php/opendb.php";
		
			$query = "INSERT INTO userActivity (userId, type) VALUE ($userid, 'login')";
			$result = mysql_query($query);

			include "../php/closedb.php";
			
		}
		/* password does not match */
		else {
			$_SESSION["error"] = 4;
		}
	}
	/* username does not exist */
	if (! $_SESSION["logged"]) {
		$_SESSION["error"] = 3;
	}
}

?>
