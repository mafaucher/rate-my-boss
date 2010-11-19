<?php
/**
 * This code is called to verify the session information every time
 * the page is loaded and perform verifications on the user array.
 * Currently this is a global.php array, but it will be replaced with
 * an actual SQL query and verification.
 *
 * TODO:
 * 		- Consider removing $_SESSION["logged"] it doesn't seem to be used
 */

/**
 * Error codes:
 * 0 = no error
 * 1 = no username
 * 2 = no password
 * 3 = username doesn't exist
 * 5 = username/password do not match
 **/

/* Set variables using POST */
$username = $_POST["username"];
$password = $_POST["password"];
//$password = md5($_POST["password"]); // For testing purposes I'm not encrypting the password
$_SESSION["logged"] = false;

/* Initialize session error variable */
if (!isset($_SESSION["error"])) {
	$_SESSION["error"] = 0;
}

/* Check is session info is already set. */
if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {
	$username = $_SESSION["username"];
	$password = $_SESSION["password"];
	$_SESSION["error"] = 0;
	$_SESSION["logged"] = true;
}

/* Check is cookies were stored using "Remember me" */
elseif(isset($_COOKIE["name"]) && isset($_COOKIE["pass"])){
		$_SESSION["username"] = $_COOKIE["username"];
		$_SESSION["password"] = $_COOKIE["password"];
} 

/* No username inserted */
elseif( empty($_POST["username"]) ) {
	$_SESSION["error"] = 1;
}

/* No password inserted */
elseif( empty($_POST["password"]) ) {
	$_SESSION["error"] = 2;
}

/* Ready for validation */
else {
	// This uses hardcoded user info, see global.php
	if (array_key_exists($username, $userpassword)) {

		/* User info validates*/
		if ($userpassword[$username] == $password) {
			/* Set session information */
			$_SESSION["error"] = 0;
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;
			$_SESSION["logged"] = true;
			
			/* Set cookies if "Remember me" is selected */
			if (isset($_POST["remember"]) ) {
				$_COOKIE["username"] = $username;
				$_COOKIE["password"] = $password;
			}
		}
		/* password does not match */
		else {
			$_SESSION["error"] = 5;
		}
	}

	/* username does not exist */
	else {
		$_SESSION["error"] = 3;
	}
}
?>
