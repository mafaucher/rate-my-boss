<!-- START OF LOGIN -->

	<div class="login">

<?php

/* New user */
if ($_SESSION["error"] == 5) {
	/**
	 * Registering information - I havn't made this yet since
	 * I don't know exactly what will be required
	 **/
}
/* User is not logged in */
else if ( !isset($_SESSION["username"]) ) {
	echo("		<form action='' method='post'>\n");
	echo("			<p>Username:&nbsp;<input class='loginbox' type='text' name='username' /></p>\n");
	echo("			<p>Password:&nbsp;<input class='loginbox' type='password' name='password' /></p>\n");
	echo("			<p>Remember me&nbsp;<input type='checkbox' name='remember' />\n");
	echo("			<input type='submit' name='register' value='Register'");
	echo("			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n");
	echo("			<input type='submit' name='sublogin' value='Login' /></p>\n");
	echo("		</form>\n");

	/* Error messages */
	switch ($_SESSION["error"]) {
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
		echo("	<p>Error: Unable to find a matching username and password.</p>\n");
		break;
	}
}
/* User is logged in */
else {
	echo("	<p>Welcome <strong>{$_SESSION['username']}</strong> (<a href='../php/logout.php'>Logout</a>)</p>");
}



?>

	</div>

<!-- END OF LOGIN -->
