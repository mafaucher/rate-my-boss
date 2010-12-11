<?php
if (isset($_POST['edittype'])) {

	include "../php/opendb.php";

	$query = "SELECT * FROM {$_POST[edittype]} WHERE uString='{$_POST[uString]}'";
	$result = mysql_query($query);
	
	include "../php/closedb.php";

	if ($result && $row = mysql_fetch_array($result)) {
		$orgId = $row['orgId'];
		
		switch($_POST['edittype']) {
		case "rating":
			$_SESSION['editId'] = $row['ratingId'];
			include "../php/pages/ratingform.php";
			break;
		case "orgEvaluation":
			$_SESSION['editId'] = $row['orgEvalId'];
			$_SESSION['editType'] = "org";
			$_SESSION['defaultTitle'] = $row['title'];
			$_SESSION['defaultContent'] = $row['text'];
			include "../php/pages/evaluationform.php";
			break;
		case "orgComment":
			$_SESSION['editId'] = $row['orgCommentId'];
			$_SESSION['editEvalId'] = $row['orgEvalId'];
			$_SESSION['editType'] = "org";
			$_SESSION['defaultContent'] = $row['text'];
			include "../php/pages/evaluationid.php";
			break;
		case "superEvaluation":
			$_SESSION['editId'] = $row['superEvalId'];
			$_SESSION['editType'] = "super";
			$_SESSION['defaultTitle'] = $row['title'];
			$_SESSION['defaultContent'] = $row['text'];
			include "../php/pages/evaluationform.php";			
			break;
		case "superComment":
			$_SESSION['editId'] = $row['superCommentId'];
			$_SESSION['editEvalId'] = $row['superEvalId'];
			$_SESSION['editType'] = "super";
			$_SESSION['defaultContent'] = $row['text'];
			include "../php/pages/evaluationid.php";
			break;
		case "docComment":
			$_SESSION['editId'] = $row['docCommentId'];
			$_SESSION['editDocId'] = $row['docId'];
			$_SESSION['defaultContent'] = $row['text'];
			include "../php/pages/documentid.php";
			break;
		}
		unset($_POST['edittype']);
	} 

	else {
		unset($_POST['edittype']);
		echo "<div class='main'><h2>None found.</h2></div>";
		include "../php/pages/editmenu.php";
	}
}

else {
	include "../php/pages/editmenu.php";
}

?>
