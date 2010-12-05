<div class="main">
<?php

include "../php/opendb.php";
echo"
<form action='index.php?page=organization' method='post'>
<table border='0' class='form'>
<tr>
<td><strong>Name:</strong></td>
<td><input type='text' name='name' /></td>
</tr>
<tr>
<td><strong>Type of industry:</strong></td>
<td><input type='text' name='industryType' /></td>
</tr>

</table>
<br />
<input type='submit' name='submitOrg' value='Submit Organization' />
";

include "../php/closedb.php";
?>

</div>
