<div class="main">

<form name="evaluation" action='index.php?page=evaluation' method='post'>
<table border='0' class='form'>
	<tr>
		<td>Title:</td> <td><input type='text' name='title' /></td>
	</tr>
	<tr>
		<td><textarea type='text' name='content' cols="75" rows="25"></textarea>
	</tr>
</table>
<br />
<input type='submit' name='submitEval' value='Submit evaluation' />
</form>

<?php
/*
Should set div class to evaluation

include "../php/opendb.php";
include "../php/closedb.php";
*/

?>

</div>
