<div class="main">
<?php

include "../php/opendb.php";
echo"
<h2>Suggest a Supervisor</h2>

<form action='index.php?page=supervisor' method='post'>
<p> Fill the field out below to suggest a supervisor to the administrators.</p>
<table border='0' class='form'>
<tr>
<td><strong>Title:</strong></td>
<td><input type='text' name='title' /></td>
</tr>
</table>
<br />
<input type='submit' name='submitSuper' value='Submit Supervisor' />
";

include "../php/closedb.php";
?>
</div>
