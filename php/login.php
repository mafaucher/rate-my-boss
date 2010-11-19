<!-- START OF LOGIN -->

	<div class="login">

<?php

	if (!$_SESSION["logged"]) {
		echo('		<form action="" method="post">');
		echo('			<p>Username:&nbsp;<input class="loginbox" type="text" name="username" /></p>');
		echo('			<p>Password:&nbsp;<input class="loginbox" type="password" name="password" /></p>');
		echo('			<p>Remember me&nbsp;<input type="checkbox" name="remember" />');
		echo('			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		echo('			<input type="submit" name="sublogin" value="Login" /></p>');
		echo('		</form>');
	}
	else {
		echo("<p>Welcome {$_SESSION['username']}!</p>");
	}
?>

	</div>

<!-- END OF LOGIN -->
