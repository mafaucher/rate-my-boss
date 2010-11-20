<!-- START OF LOGIN -->

	<div class="login">

<?php

/* New user */
if ($_SESSION["error"] == 5) {
	$_SESSION["error"] = 0;
	echo("<p>This is just a test, reload to return.</p>");
	/**
	 * Registering information - I haven't made this yet since
	 * I don't know if we need to make a new page for this ...
	 **/
}
/* User is not logged in */
else if ( !isset($_SESSION["username"]) ) {
	echo("		<form action='' method='post'>\n");
	echo("			<p>Username:&nbsp;&nbsp;<input class='loginbox' type='text' name='username' /></p>\n");
	echo("			<p>Password:&nbsp;&nbsp;<input class='loginbox' type='password' name='password' /></p>\n");
	echo("			<p>Remember me&nbsp;<input type='checkbox' name='remember' />\n");
	echo("			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	echo("			<input type='submit' name='sublogin' value='Login' /></p>\n");
	echo("		</form>\n");

	/* Error messages */
	switch ($_SESSION["error"]) {
	case 0:
		echo("	<p>Enter your username and password.</p>\n");
		break;
	case 1:
		echo("	<p>Error: Please enter your username.</p>\n");
		break;
	case 2:
		echo("	<p>Error: Please enter your password.</p>\n");
		break;
	case 3:
		echo("	<p>Error: This user does not exist.</p>\n");
		break;
	case 4:
		echo("	<p>Error: Incorrect password.</p>\n");
		break;
	}
}
/* User is logged in */
else {
	echo("	<p>Welcome <strong>{$_SESSION['username']}</strong> (<a href='logout.php'>logout</a>)</p>");
}



?>

	</div>

<!-- END OF LOGIN -->