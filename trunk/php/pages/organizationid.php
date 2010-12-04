<div class="main">

<?php
include "../php/opendb.php";

//Set orgId for the session to allow for menu items
$_SESSION["orgId"] = $_GET[id];
$orgId = $_GET[id];

// Selects organization based on id sent by organization page
$query = "SELECT * FROM organization
		where orgId=$orgId";

$result = mysql_query($query);

$row = mysql_fetch_array($result);

echo "

<h2>{$row[name]}</h2>
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
<td><span class='score'><strong>Average score:</strong></span></td><td><span class='score'>$averageRating / 10</span></td>
</table>
";

//ADD A RATING



// ratings

// supervisors

// documents

include "../php/closedb.php";
?>
</div>
