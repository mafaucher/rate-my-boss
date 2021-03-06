<div class="main">

<?php

include "../php/opendb.php";
//Set orgId for the session to allow access to appropriate menu items
$_SESSION["orgId"] = $_GET[id];
$orgId = $_GET[id];

// Selects organization based on id sent by organization page
$query = "SELECT * FROM organization
		where orgId=$orgId";

$result = mysql_query($query);
$row = mysql_fetch_array($result);
include "../php/closedb.php";

echo"<div id='left'><h2>Info:</h2></div>";

//Check if a rating form has been submitted
//if($HTTP_SERVER_VARS['REQUEST_METHOD']=='POST'){
if (isset($_POST['socialValues'])) {

//process form information when a new rating is added.
$socialValues = $_POST['socialValues'];
$professionalism = $_POST['professionalism'];
$openness = $_POST['openness'];
$encouraging = $_POST['encouraging'];
$acceptance = $_POST['acceptance'];
$recognition = $_POST['recognition'];
$qualityWorkplace = $_POST['qualityWorkplace'];
$fairness = $_POST['fairness'];
$cooperation = $_POST['cooperation'];
$rewardSystem = $_POST['rewardSystem'];
$fairWages = $_POST['fairWages'];
$qualityBenefits = $_POST['qualityBenefits'];
$supportEmployees = $_POST['supportEmployees'];
$levelStress = $_POST['levelStress'];
$levelCollegiality = $_POST['levelCollegiality'];
$levelBureaucracy = $_POST['levelBureaucracy'];
$advancement = $_POST['advancement'];
$supportFamily = $_POST['supportFamily'];

include "../php/opendb.php";
if (isset($_SESSION['editId'])) {
	$sql="UPDATE rating SET socialValues=$socialValues, professionalism=$professionalism, openness=$openness, encouraging=$encouraging, acceptance=$acceptance, recognition=$recognition, qualityWorkplace=$qualityWorkplace, fairness=$fairness, cooperation=$cooperation, rewardSystem=$rewardSystem, fairWages=$fairWages, qualityBenefits=$qualityBenefits, supportEmployees=$supportEmployees, levelStress=$levelStress, levelCollegiality=$levelCollegiality, levelBureaucracy=$levelBureaucracy, advancement=$advancement, supportFamily=$supportFamily WHERE ratingId='$_POST[editId]')";
mysql_query($sql);
	unset($_SESSION['editId']);
	echo "<div id='right' class='score'>Your rating has been updated.</div><div class='clear'></div>";
}
else {
	$sql="insert into rating (orgId, socialValues, professionalism, openness, encouraging, acceptance, recognition, qualityWorkplace, fairness, cooperation, rewardSystem, fairWages, qualityBenefits, supportEmployees, levelStress, levelCollegiality, levelBureaucracy, advancement, supportFamily, uString) values ($orgId, $socialValues, $professionalism, $openness, $encouraging, $acceptance, $recognition, $qualityWorkplace, $fairness, $cooperation, $rewardSystem, $fairWages, $qualityBenefits, $supportEmployees, $levelStress, $levelCollegiality, $levelBureaucracy, $advancement, $supportFamily, '')";
	mysql_query($sql);
	$lastId = mysql_insert_id();
	$uString = md5("rating".$lastId);
	$checksum = md5($uString);

	$sql="UPDATE rating SET uString='$uString' WHERE ratingId=$lastId";
	mysql_query($sql);

	echo "<div id='right' class='score'>Thanks for adding a rating!</div><div class='clear'></div>";
	echo "Unique String: $uString<br />
		Checksum: $checksum<br />";
	
include "../php/closedb.php";
}
	unset($_POST['socialValues']);
} else {
echo "<div id='right'><a href='index.php?page=ratingform'><button type='button'>Add a Rating</button></a></div><div class='clear'></div>";
}

include "../php/opendb.php";

echo "
<table border='0' class='listing'>
<tr>
<td><strong>Type of industry:</strong></td><td>{$row[industryType]} </td>
</tr>
<tr>
<td><strong>City:</strong></td><td>{$row[city]} </td>
</tr>
<tr>
<td><strong>Province:</strong></td><td>{$row[province]} </td>
</tr>
<tr>
<td><strong>Website:</strong></td><td>{$row[website]} </td>
</tr>
<tr>
<td><strong>Number of employees:</strong></td><td>{$row[numberofEmployees]} </td>
</tr>
</table>
";

$query = "SELECT
AVG(socialValues),
AVG(professionalism),
AVG(openness),
AVG(encouraging),
AVG(acceptance),
AVG(recognition),
AVG(qualityWorkplace),
AVG(fairness),
AVG(cooperation),
AVG(rewardSystem),
AVG(fairWages),
AVG(qualityBenefits),
AVG(supportEmployees),
AVG(levelStress),
AVG(levelCollegiality),
AVG(levelBureaucracy),
AVG(advancement),
AVG(supportFamily)
FROM rating
where orgId=$orgId";

$result = mysql_query($query);

$row = mysql_fetch_array($result);

$rating1 = number_format($row['AVG(socialValues)'], 2, '.', '');
$rating2 = number_format($row['AVG(professionalism)'], 2, '.', '');
$rating3 = number_format($row['AVG(openness)'], 2, '.', '');
$rating4 = number_format($row['AVG(encouraging)'], 2, '.', '');
$rating5 = number_format($row['AVG(acceptance)'], 2, '.', '');
$rating6 = number_format($row['AVG(recognition)'], 2, '.', '');
$rating7 = number_format($row['AVG(qualityWorkplace)'], 2, '.', '');
$rating8 = number_format($row['AVG(fairness)'], 2, '.', '');
$rating9 = number_format($row['AVG(cooperation)'], 2, '.', '');
$rating10 = number_format($row['AVG(rewardSystem)'], 2, '.', '');
$rating11 = number_format($row['AVG(fairWages)'], 2, '.', '');
$rating12 = number_format($row['AVG(qualityBenefits)'], 2, '.', '');
$rating13 = number_format($row['AVG(supportEmployees)'], 2, '.', '');
$rating14 = number_format($row['AVG(levelStress)'], 2, '.', '');
$rating15 = number_format($row['AVG(levelCollegiality)'], 2, '.', '');
$rating16 = number_format($row['AVG(levelBureaucracy)'], 2, '.', '');
$rating17 = number_format($row['AVG(advancement)'], 2, '.', '');
$rating18 = number_format($row['AVG(supportFamily)'], 2, '.', '');

$averageRating = number_format(($rating1+$rating2+$rating3+$rating4+$rating5+$rating6+$rating7+$rating8+$rating9+$rating10+$rating11+$rating12+$rating13+$rating14+$rating15+$rating16+$rating17+$rating18)/18,2,'.','');

echo "
<h2>Ratings:</h2>
<table border='0' class='listing'>
<tr>
<td><strong>Social values:</strong></td><td>$rating1</td>
</tr>
<tr>
<td><strong>Professionalism of management:</strong></td><td>$rating2</td>
</tr>
<tr>
<td><strong>Openness with staff:</strong></td><td>$rating3</td>
</tr>
<tr>
<td><strong>Encouraging innovation:</strong> </td><td>$rating4</td>
</tr>
<tr>
<td><strong>Acceptance of ideas from workforce:</strong> </td><td>$rating5</td>
</tr>
<tr>
<td><strong>Recognition of achievement:</strong> </td><td>$rating6</td>
</tr>
<tr>
<td><strong>Quality of workplace:</strong> </td><td>$rating7</td>
</tr>
<tr>
<td><strong>Fairness of evaluation:</strong> </td><td>$rating8</td>
</tr>
<tr>
<td><strong>Cooperation among employees:</strong> </td><td>$rating9</td>
</tr>
<tr>
<td><strong>Reward system:</strong> </td><td>$rating10</td>
</tr>
<tr>
<td><strong>Fair wages:</strong> </td><td>$rating11</td>
</tr>
<tr>
<td><strong>Quality of benefits:</strong> </td><td>$rating12</td>
</tr>
<tr>
<td><strong>Support for employees:</strong> </td><td>$rating13</td>
</tr>
<tr>
<td><strong>Level of stress:</strong> </td><td>$rating14</td>
</tr>
<tr>
<td><strong>Level of collegiality:</strong> </td><td>$rating15</td>
</tr>
<tr>
<td><strong>Level of bureaucracy and red tape:</strong> </td><td>$rating16</td>
</tr>
<tr>
<td><strong>Possibility for advancement:</strong> </td><td>$rating17</td>
</tr>
<tr>
<td><strong>Support for family:</strong> </td><td>$rating18</td>
</tr>
<tr>
<td><span class='score'><strong>Average score:</strong></span></td><td><span class='score'>$averageRating</span> / 10</td>
</table>
";
include "../php/closedb.php";
?>
</div>
