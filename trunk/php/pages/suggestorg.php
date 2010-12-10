<div class="main">
<?php

include "../php/opendb.php";
echo"
<h2>Suggest an Organization</h2>

<form action='index.php?page=organization' method='post'>
<p> Fill out the fields below to suggest an organization to the administrators.</p>
<table border='0' class='form'>
<tr>
<td><strong>Name:</strong></td>
<td><input type='text' name='name' /></td>
</tr>
<tr>
<td><strong>Type of industry:</strong></td>
<td><input type='text' name='industryType' /></td>
</tr>
<tr>
<td><strong>City:</strong></td>
<td><input type='text' name='city' /></td>
</tr>
<tr>
<td><strong>Province:</strong></td>
<td><input type='text' name='province' /></td>
</tr>
<tr>
<td><strong>Website:</strong></td>
<td><input type='text' name='website' /></td>
</tr>
<tr>
<td><strong>Number of employees:</strong></td>
<td><input type='text' name='numberofEmployees' /></td>
</tr>
</table>
<br />
<input type='submit' name='submitOrg' value='Submit Organization' />
";

include "../php/closedb.php";
?>

</div>
