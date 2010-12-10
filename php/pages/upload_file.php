<div class="main">
<?php
include "../php/opendb.php";
if (($_FILES["file"]["type"] == "application/pdf") && ($_FILES["file"]["size"] < 300000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
	//If the does not already exist in the folder store it in documents and update database
    if (file_exists("documents/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      	move_uploaded_file($_FILES["file"]["tmp_name"],
      	"documents/" . $_FILES["file"]["name"]);
    	  
		//get data from post
		$title = $_POST['title'];
		$filename = $_FILES["file"]["name"];
	
		$sql="insert into document (orgId, title, filename, reported) values
		($orgId, '$title', '$filename', 0)";

		// post document to database
		mysql_query($sql);
		unset($_POST['title']);
	  
	  //Print information
	  
	      echo "<h2>Thanks for uploading a document.</h2>";
  		  echo "<strong>Details:</strong> <br />";
  		  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  		  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  		  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  		  echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
  		  echo "Stored in: " . "documents/" . $_FILES["file"]["name"];
	  }
    }
  }
else
  {
  echo "<span class='score'>Invalid file</span>
  		<br />
  		<p> Please choose a pdf under 300 Kb</p>";
  }
  include "../php/closedb.php";
?>
<br />
<p><a href='index.php?page=document'><button type='button'>Return to Documents Page</button></a> </p></div>
