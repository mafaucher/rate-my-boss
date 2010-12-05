<div class="main">
<?php

include "../php/opendb.php";

$query = "SELECT * FROM organization
		where orgId=$orgId";

$result = mysql_query($query);

$row = mysql_fetch_array($result);

echo"
<h2>Add a Rating for {$row[name]}</h2>

<form action='index.php?page=organization&id=$orgId' method='post'>
<p> Enter a score for each category, 10 is outstanding and 1 is dismal.</p>
<table border='0' class='form'>
<tr>
<td><strong>Social values:</strong></td>
<td><input type='radio' name='socialValues' value='1' CHECKED/>1</td>
<td><input type='radio' name='socialValues' value='2'/>2</td>
<td><input type='radio' name='socialValues' value='3'/>3</td>
<td><input type='radio' name='socialValues' value='4'/>4</td>
<td><input type='radio' name='socialValues' value='5'/>5</td>
<td><input type='radio' name='socialValues' value='6'/>6</td>
<td><input type='radio' name='socialValues' value='7'/>7</td>
<td><input type='radio' name='socialValues' value='8'/>8</td>
<td><input type='radio' name='socialValues' value='9'/>9</td>
<td><input type='radio' name='socialValues' value='10'/>10</td>
</tr>
<tr>
<td><strong>Professionalism of management:</strong></td>
<td><input type='radio' name='professionalism' value='1' CHECKED/>1</td>
<td><input type='radio' name='professionalism' value='2'/>2</td>
<td><input type='radio' name='professionalism' value='3'/>3</td>
<td><input type='radio' name='professionalism' value='4'/>4</td>
<td><input type='radio' name='professionalism' value='5'/>5</td>
<td><input type='radio' name='professionalism' value='6'/>6</td>
<td><input type='radio' name='professionalism' value='7'/>7</td>
<td><input type='radio' name='professionalism' value='8'/>8</td>
<td><input type='radio' name='professionalism' value='9'/>9</td>
<td><input type='radio' name='professionalism' value='10'/>10</td>
</tr>
<tr>
<td><strong>Openness with staff:</strong></td>
<td><input type='radio' name='openness' value='1' CHECKED/>1</td>
<td><input type='radio' name='openness' value='2'/>2</td>
<td><input type='radio' name='openness' value='3'/>3</td>
<td><input type='radio' name='openness' value='4'/>4</td>
<td><input type='radio' name='openness' value='5'/>5</td>
<td><input type='radio' name='openness' value='6'/>6</td>
<td><input type='radio' name='openness' value='7'/>7</td>
<td><input type='radio' name='openness' value='8'/>8</td>
<td><input type='radio' name='openness' value='9'/>9</td>
<td><input type='radio' name='openness' value='10'/>10</td>
</tr>
<tr>
<td><strong>Encouraging innovation:</strong></td>
<td><input type='radio' name='encouraging' value='1' CHECKED/>1</td>
<td><input type='radio' name='encouraging' value='2'/>2</td>
<td><input type='radio' name='encouraging' value='3'/>3</td>
<td><input type='radio' name='encouraging' value='4'/>4</td>
<td><input type='radio' name='encouraging' value='5'/>5</td>
<td><input type='radio' name='encouraging' value='6'/>6</td>
<td><input type='radio' name='encouraging' value='7'/>7</td>
<td><input type='radio' name='encouraging' value='8'/>8</td>
<td><input type='radio' name='encouraging' value='9'/>9</td>
<td><input type='radio' name='encouraging' value='10'/>10</td>
</tr>
<tr>
<td><strong>Acceptance of ideas from workforce:</strong></td>
<td><input type='radio' name='acceptance' value='1' CHECKED/>1</td>
<td><input type='radio' name='acceptance' value='2'/>2</td>
<td><input type='radio' name='acceptance' value='3'/>3</td>
<td><input type='radio' name='acceptance' value='4'/>4</td>
<td><input type='radio' name='acceptance' value='5'/>5</td>
<td><input type='radio' name='acceptance' value='6'/>6</td>
<td><input type='radio' name='acceptance' value='7'/>7</td>
<td><input type='radio' name='acceptance' value='8'/>8</td>
<td><input type='radio' name='acceptance' value='9'/>9</td>
<td><input type='radio' name='acceptance' value='10'/>10</td>
</tr>
<tr>
<td><strong>Recognition of achievement:</strong></td>
<td><input type='radio' name='recognition' value='1' CHECKED/>1</td>
<td><input type='radio' name='recognition' value='2'/>2</td>
<td><input type='radio' name='recognition' value='3'/>3</td>
<td><input type='radio' name='recognition' value='4'/>4</td>
<td><input type='radio' name='recognition' value='5'/>5</td>
<td><input type='radio' name='recognition' value='6'/>6</td>
<td><input type='radio' name='recognition' value='7'/>7</td>
<td><input type='radio' name='recognition' value='8'/>8</td>
<td><input type='radio' name='recognition' value='9'/>9</td>
<td><input type='radio' name='recognition' value='10'/>10</td>
</tr>
<tr>
<td><strong>Quality of workplace:</strong></td>
<td><input type='radio' name='qualityWorkplace' value='1' CHECKED/>1</td>
<td><input type='radio' name='qualityWorkplace' value='2'/>2</td>
<td><input type='radio' name='qualityWorkplace' value='3'/>3</td>
<td><input type='radio' name='qualityWorkplace' value='4'/>4</td>
<td><input type='radio' name='qualityWorkplace' value='5'/>5</td>
<td><input type='radio' name='qualityWorkplace' value='6'/>6</td>
<td><input type='radio' name='qualityWorkplace' value='7'/>7</td>
<td><input type='radio' name='qualityWorkplace' value='8'/>8</td>
<td><input type='radio' name='qualityWorkplace' value='9'/>9</td>
<td><input type='radio' name='qualityWorkplace' value='10'/>10</td>
</tr>
<tr>
<td><strong>Fairness of evaluation:</strong></td>
<td><input type='radio' name='fairness' value='1' CHECKED/>1</td>
<td><input type='radio' name='fairness' value='2'/>2</td>
<td><input type='radio' name='fairness' value='3'/>3</td>
<td><input type='radio' name='fairness' value='4'/>4</td>
<td><input type='radio' name='fairness' value='5'/>5</td>
<td><input type='radio' name='fairness' value='6'/>6</td>
<td><input type='radio' name='fairness' value='7'/>7</td>
<td><input type='radio' name='fairness' value='8'/>8</td>
<td><input type='radio' name='fairness' value='9'/>9</td>
<td><input type='radio' name='fairness' value='10'/>10</td>
</tr>
<tr>
<td><strong>Cooperation among employees:</strong></td>
<td><input type='radio' name='cooperation' value='1' CHECKED/>1</td>
<td><input type='radio' name='cooperation' value='2'/>2</td>
<td><input type='radio' name='cooperation' value='3'/>3</td>
<td><input type='radio' name='cooperation' value='4'/>4</td>
<td><input type='radio' name='cooperation' value='5'/>5</td>
<td><input type='radio' name='cooperation' value='6'/>6</td>
<td><input type='radio' name='cooperation' value='7'/>7</td>
<td><input type='radio' name='cooperation' value='8'/>8</td>
<td><input type='radio' name='cooperation' value='9'/>9</td>
<td><input type='radio' name='cooperation' value='10'/>10</td>
</tr>
<tr>
<td><strong>Reward system:</strong></td>
<td><input type='radio' name='rewardSystem' value='1' CHECKED/>1</td>
<td><input type='radio' name='rewardSystem' value='2'/>2</td>
<td><input type='radio' name='rewardSystem' value='3'/>3</td>
<td><input type='radio' name='rewardSystem' value='4'/>4</td>
<td><input type='radio' name='rewardSystem' value='5'/>5</td>
<td><input type='radio' name='rewardSystem' value='6'/>6</td>
<td><input type='radio' name='rewardSystem' value='7'/>7</td>
<td><input type='radio' name='rewardSystem' value='8'/>8</td>
<td><input type='radio' name='rewardSystem' value='9'/>9</td>
<td><input type='radio' name='rewardSystem' value='10'/>10</td>
</tr>
<tr>
<td><strong>Fair wages:</strong></td>
<td><input type='radio' name='fairWages' value='1' CHECKED/>1</td>
<td><input type='radio' name='fairWages' value='2'/>2</td>
<td><input type='radio' name='fairWages' value='3'/>3</td>
<td><input type='radio' name='fairWages' value='4'/>4</td>
<td><input type='radio' name='fairWages' value='5'/>5</td>
<td><input type='radio' name='fairWages' value='6'/>6</td>
<td><input type='radio' name='fairWages' value='7'/>7</td>
<td><input type='radio' name='fairWages' value='8'/>8</td>
<td><input type='radio' name='fairWages' value='9'/>9</td>
<td><input type='radio' name='fairWages' value='10'/>10</td>
</tr>
<tr>
<td><strong>Quality of benefits:</strong></td>
<td><input type='radio' name='qualityBenefits' value='1' CHECKED/>1</td>
<td><input type='radio' name='qualityBenefits' value='2'/>2</td>
<td><input type='radio' name='qualityBenefits' value='3'/>3</td>
<td><input type='radio' name='qualityBenefits' value='4'/>4</td>
<td><input type='radio' name='qualityBenefits' value='5'/>5</td>
<td><input type='radio' name='qualityBenefits' value='6'/>6</td>
<td><input type='radio' name='qualityBenefits' value='7'/>7</td>
<td><input type='radio' name='qualityBenefits' value='8'/>8</td>
<td><input type='radio' name='qualityBenefits' value='9'/>9</td>
<td><input type='radio' name='qualityBenefits' value='10'/>10</td>
</tr>
<tr>
<td><strong>Support for employees:</strong></td>
<td><input type='radio' name='supportEmployees' value='1' CHECKED/>1</td>
<td><input type='radio' name='supportEmployees' value='2'/>2</td>
<td><input type='radio' name='supportEmployees' value='3'/>3</td>
<td><input type='radio' name='supportEmployees' value='4'/>4</td>
<td><input type='radio' name='supportEmployees' value='5'/>5</td>
<td><input type='radio' name='supportEmployees' value='6'/>6</td>
<td><input type='radio' name='supportEmployees' value='7'/>7</td>
<td><input type='radio' name='supportEmployees' value='8'/>8</td>
<td><input type='radio' name='supportEmployees' value='9'/>9</td>
<td><input type='radio' name='supportEmployees' value='10'/>10</td>
</tr>
<tr>
<td><strong>Level of stress:</strong></td>
<td><input type='radio' name='levelStress' value='1' CHECKED/>1</td>
<td><input type='radio' name='levelStress' value='2'/>2</td>
<td><input type='radio' name='levelStress' value='3'/>3</td>
<td><input type='radio' name='levelStress' value='4'/>4</td>
<td><input type='radio' name='levelStress' value='5'/>5</td>
<td><input type='radio' name='levelStress' value='6'/>6</td>
<td><input type='radio' name='levelStress' value='7'/>7</td>
<td><input type='radio' name='levelStress' value='8'/>8</td>
<td><input type='radio' name='levelStress' value='9'/>9</td>
<td><input type='radio' name='levelStress' value='10'/>10</td>
</tr>
<tr>
<td><strong>Level of collegiality:</strong></td>
<td><input type='radio' name='levelCollegiality' value='1' CHECKED/>1</td>
<td><input type='radio' name='levelCollegiality' value='2'/>2</td>
<td><input type='radio' name='levelCollegiality' value='3'/>3</td>
<td><input type='radio' name='levelCollegiality' value='4'/>4</td>
<td><input type='radio' name='levelCollegiality' value='5'/>5</td>
<td><input type='radio' name='levelCollegiality' value='6'/>6</td>
<td><input type='radio' name='levelCollegiality' value='7'/>7</td>
<td><input type='radio' name='levelCollegiality' value='8'/>8</td>
<td><input type='radio' name='levelCollegiality' value='9'/>9</td>
<td><input type='radio' name='levelCollegiality' value='10'/>10</td>
</tr>
<tr>
<td><strong>Level of bureaucracy and red tape:</strong></td>
<td><input type='radio' name='levelBureaucracy' value='1' CHECKED/>1</td>
<td><input type='radio' name='levelBureaucracy' value='2'/>2</td>
<td><input type='radio' name='levelBureaucracy' value='3'/>3</td>
<td><input type='radio' name='levelBureaucracy' value='4'/>4</td>
<td><input type='radio' name='levelBureaucracy' value='5'/>5</td>
<td><input type='radio' name='levelBureaucracy' value='6'/>6</td>
<td><input type='radio' name='levelBureaucracy' value='7'/>7</td>
<td><input type='radio' name='levelBureaucracy' value='8'/>8</td>
<td><input type='radio' name='levelBureaucracy' value='9'/>9</td>
<td><input type='radio' name='levelBureaucracy' value='10'/>10</td>
</tr>
<tr>
<td><strong>Possibility for advancement:</strong></td>
<td><input type='radio' name='advancement' value='1' CHECKED/>1</td>
<td><input type='radio' name='advancement' value='2'/>2</td>
<td><input type='radio' name='advancement' value='3'/>3</td>
<td><input type='radio' name='advancement' value='4'/>4</td>
<td><input type='radio' name='advancement' value='5'/>5</td>
<td><input type='radio' name='advancement' value='6'/>6</td>
<td><input type='radio' name='advancement' value='7'/>7</td>
<td><input type='radio' name='advancement' value='8'/>8</td>
<td><input type='radio' name='advancement' value='9'/>9</td>
<td><input type='radio' name='advancement' value='10'/>10</td>
</tr>
<tr>
<td><strong>Support for family:</strong></td>
<td><input type='radio' name='supportFamily' value='1' CHECKED/>1</td>
<td><input type='radio' name='supportFamily' value='2'/>2</td>
<td><input type='radio' name='supportFamily' value='3'/>3</td>
<td><input type='radio' name='supportFamily' value='4'/>4</td>
<td><input type='radio' name='supportFamily' value='5'/>5</td>
<td><input type='radio' name='supportFamily' value='6'/>6</td>
<td><input type='radio' name='supportFamily' value='7'/>7</td>
<td><input type='radio' name='supportFamily' value='8'/>8</td>
<td><input type='radio' name='supportFamily' value='9'/>9</td>
<td><input type='radio' name='supportFamily' value='10'/>10</td>
</tr>
</table>
<br />
<input type='submit' name='submitRating' value='Submit Rating' />
";

include "../php/closedb.php";
?>

</div>
