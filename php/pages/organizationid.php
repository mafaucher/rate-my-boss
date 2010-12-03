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
<p class='listing'>
<strong>Type of industry:</strong> {$row[industryType]} <br />
<strong>City:</strong> {$row[city]} <br />
<strong>Province:</strong> {$row[province]} <br />
<strong>Website:</strong> {$row[website]} <br />
<strong>Number of employees:</strong> {$row[numberofEmployees]} <br />
</p>
<h2>Ratings:</h2>
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

echo "
<strong>Social values:</strong> $rating1<br />
<strong>Professionalism of management:</strong> $rating2<br />
<strong>Openness with staff:</strong> $rating3<br />
<strong>Encouraging innovation:</strong> $rating4<br />
<strong>Acceptance of ideas from workforce:</strong> $rating5<br />
<strong>Recognition of achievement:</strong> $rating6<br />
<strong>Quality of workplace:</strong> $rating7<br />
<strong>Fairness of evaluation:</strong> $rating8<br />
<strong>Cooperation among employees:</strong> $rating9<br />
<strong>Reward system:</strong> $rating10<br />
<strong>Fair wages:</strong> $rating11<br />
<strong>Quality of benefits:</strong> $rating12<br />
<strong>Support for employees:</strong> $rating13<br />
<strong>Level of stress:</strong> $rating14<br />
<strong>Level of collegiality:</strong> $rating15<br />
<strong>Level of bureaucracy and red tape:</strong> $rating16<br />
<strong>Possibility for advancement:</strong> $rating17<br />
<strong>Support for family:</strong> $rating18<br />
";

//ADD A RATING



// ratings

// supervisors

// documents

include "../php/closedb.php";
?>
</div>
