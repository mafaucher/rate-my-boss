<div class="main">
	
<?php
include "../php/opendb.php";
echo"
<h2>Documents:</h2>
<ul class='listing'>";
//Access document table
$query = "SELECT * FROM document
		WHERE orgId=$orgId AND NOT isPending";
$result = mysql_query($query);

// Prints the list of document titles with links
while($row = mysql_fetch_array($result))
{
    echo "<li>
    <a href='index.php?page=documentid&docId=${row[docId]}'>
    	{$row[title]}
    </a>
    </li>";
}

echo "
</ul>
<br />
<a href='index.php?page=documentform'><button type='button'>Add an Document</button></a> <br />
<br />
";
include "../php/closedb.php";
?>
</div>
