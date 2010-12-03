<!-- START OF MAIN -->

	<div class="main">

<?php

/* Unset the current organization id to reset menu */
if(isset($orgId)) {
        unset($orgId);
}

?>

		<h1>New User Registration</h1>

		<p>You do <strong>not</strong> need to register to post comments on the site.
		You do, however, need to register an account if you want to add new organizations
		or supervisors, post reviews, rate an organization, or upload documents. This will
		allow you to update your posts later on. In order to assure your anonymity, we do
		not, and will never, ask you personal questions. Your username is used to login,
		and will never be used to identify your posts. We do this by giving you a unique,
		random string of characters which you can use to edit your posts.</p>
		
		<p>Entries marked with a star (*) are obligatory. If you choose to provide answers
		to your three secret questions, you will be able to change your password at any time.
		Otherwise, there will be <strong>no way</strong> for you to change your password,
		and we won't be able to change it for you.</p>
		<br />

		<form name="registration" onsubmit="return validateRegistration(this)" action='index.php' method='post'>
			<p>* <strong>What type of account do you wish to create?</strong>
			(new administrators require approval from a site administrator)</p>
			<input class='register' type='radio' name='register' value='registered' CHECKED />Regular User<br />
			<input class='register' type='radio' name='register' value='agent' />Business Agent<br />
			<input class='register' type='radio' name='register' value='admin' />Site Administrator<br />
			<input class='register' type='radio' name='register' value='finance' />Financial Administrator<br />
			<br />
			<p>* <strong>Pick a Username</strong>:&nbsp;&nbsp;&nbsp;
			<input class='register' type='text' name='newusername' /></p>
			<p>* <strong>Enter a Password</strong>:&nbsp;&nbsp;
			<input class='register' type='password' name='newpassword' /></p>
			<p>* <strong>Repeat Password</strong>:&nbsp;&nbsp;
			<input class='register' type='password' name='newpwrepeat' /></p>
			<br />
			<p><strong>Question 1</strong>: What is your mother's maiden name?</p>
			<p><input class='register' type='text' name='answer1' /></p>
			<p><strong>Question 2</strong>: What is the name of your first pet?</p>
			<p><input class='register' type='text' name='answer2' /></p>
			<p><strong>Question 3</strong>: What is the name of your favorite magazine?</p>
			<p><input class='register' type='text' name='answer3' /></p>
			<br />
			<input type='submit' name='subregister' value='Create a New User' /></p>
		</form>

	</div>
   
<!-- END OF MAIN -->
