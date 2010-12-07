<!-- START OF MAIN -->

<?php

/* Unset the current organization id to reset menu */
if(isset($orgId)) {
	unset($orgId);
}

?>
	<div class="main">

		<h1>Modify a Previous Post</h1>

		<p>You may make modifications to a previous comment or rating by entering
		below the unique, 32 character string, along with it's md5 checksum.</p>
		<br />

		<form name='edit' onsubmit="return validateEdit(this)" action='' method='post'>
			<p><strong>Type of post</strong>:</p>
			<p><select name="edittype">
			<option value="rating">Organization Rating</option>
			<option value="orgEvaluation">Organization Evaluation</option>
			<option value="orgComment">Reply to an Organization Evaluation</option>
			<option value="docComment">Comment About a Document</option>
			<option value="superEvaluation">Supervisor Evaluation</option>
			<option value="superComment">Reply to a Supervisor Evaluation</option>
			</select></p>

			<p><strong>Unique String</strong>:</p>
			<p><input class='edit' type='text' name='uString' size=32 /></p>
			<p><strong>Checksum</strong>:</p>
			<p><input class='edit' type='text' name='checksum' size=32 /></p>

	</div>

<!-- END OF MAIN -->
