<div class="main">

<h2> List of Organizations:</h2>
<ul class="listing">
<?php

/* Unset the current organization id and supervisor id to reset menu */
if(isset($orgId)) {
	unset($orgId);
}

if(isset($superId)) {
	unset($superId);
}

include "../php/opendb.php";

$query = "SELECT * FROM organization WHERE NOT isPending";
$result = mysql_query($query);

/* Prints the list of organization names as links to their individual pages */

while($row = mysql_fetch_array($result))
{
    echo "<li>
    <a href='index.php?page=organization&id=${row[orgId]}'>
    
    {$row[name]}
    </a>
    </li>";
}

echo "
</ul>
<br />
<a href='index.php?page=suggestorg'><button type='button'>Suggest an Organization</button></a> <br />
<br />
";
if($HTTP_SERVER_VARS['REQUEST_METHOD']=='POST'){

$name = $_POST['name'];
$industryType = $_POST['industryType'];
$city = $_POST['city'];
$province = $_POST['province'];
$website = $_POST['website'];
$numberofEmployees = $_POST['numberofEmployees'];

$sql="insert into organization (name, industryType, city, province, website, numberofEmployees, isPending) values
('$name', '$industryType', '$city', '$province', '$website', '$numberofEmployees', 1)";

//$sql="insert into organization (name) values ($name, $industryType, $city, $province, 

//echo "$name, $industryType, $city, $province, $website, $numberofEmployees";
mysql_query($sql);

echo "<span class='score'>Thanks for suggesting an organization!</span><br />
It will be pending until an administrator can confirm it.";
}

include "../php/closedb.php";
?>
</div>
