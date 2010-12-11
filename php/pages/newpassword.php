<!-- START OF MAIN -->

	<div class="main">

	<?php

	/* Unset the current organization id to reset menu */
	if(isset($orgId)) {
	        unset($orgId);
	}
	
	?>

		<h2>Choose a New Password</h2>

		<p>Enter your new password and your answers to your three secret questions.</p><br />
		

		<form name="changepassword" action='index.php' method='post'>
			<p><strong>Enter a new Password</strong>:&nbsp;&nbsp;
			<input class='register' type='password' name='newpassword' /></p>
			<p><strong>Repeat your Password</strong>:&nbsp;&nbsp;
			<input class='register' type='password' name='newpasswordrepeat' /></p>
			<br />
			<p><strong>Question 1</strong>: What is your mother's maiden name?</p>
			<p><input class='register' type='text' name='answer1' /></p>
			<p><strong>Question 2</strong>: What is the name of your first pet?</p>
			<p><input class='register' type='text' name='answer2' /></p>
			<p><strong>Question 3</strong>: What is the name of your favorite magazine?</p>
			<p><input class='register' type='text' name='answer3' /></p>
			<br />
			<input type='submit' name='subregister' value='Change Password' /></p>
		</form>

	</div>
   
<!-- END OF MAIN -->
