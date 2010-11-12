<?php
      include("../php/checkLogin.php"); //Include the php function that will perform the user and password validation

      if(!isset($_SESSION['username']) && (!isset($_SESSION['error']) || $_SESSION['error'] == 0)){ //If session is not set and there is no error, display default form.
        echo("<div class=\"login\">\n");
        echo("<form action=\"\" method=\"post\">\n");
        echo("      <p>Username:<input class=\"loginBox\" type=\"text\" name=\"username\" /></p>\n");
        echo("      <p>Password:&nbsp;<input class=\"loginBox\" type=\"password\" name=\"password\" /></p>\n");
        echo("      <p>Remember me&nbsp;<input type=\"checkbox\" name=\"remember\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"sublogin\" value=\"Login\" /></p>\n");
        echo("</form>\n");
        echo("</div>\n");
      }
      elseif(!isset($_SESSION['username']) && $_SESSION['error'] == 1){ //If session is not set and error is 1, display required field error + form
        echo("<div class=\"login\">\n");
        echo("<form action=\"\" method=\"post\">\n");
 	echo("      <p>Username:<input class=\"loginBox\" type=\"text\" name=\"username\" /></p>\n");
        echo("      <p>Password:&nbsp;<input class=\"loginBox\" type=\"password\" name=\"password\" /></p>\n");
        echo("      <p>Remember me&nbsp;<input type=\"checkbox\" name=\"remember\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"sublogin\" value=\"Login\" /></p>\n");
        echo("</form>\n");
	echo("<p>You have left a required field empty</p>");
        echo("</div>\n");	
      }
      elseif(!isset($_SESSION['username']) && $_SESSION['error'] == 2){ //If session is not set and error is 2, display validation error + form
        echo("<div class=\"login\">\n");
        echo("<form action=\"\" method=\"post\">\n");
 	echo("      <p>Username:<input class=\"loginBox\" type=\"text\" name=\"username\" /></p>\n");
        echo("      <p>Password:&nbsp;<input class=\"loginBox\" type=\"password\" name=\"password\" /></p>\n");
        echo("      <p>Remember me&nbsp;<input type=\"checkbox\" name=\"remember\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"sublogin\" value=\"Login\" /></p>\n");
        echo("</form>\n");
	echo("<p>Username or Password incorrect</p>");
        echo("</div>\n");	
      }		
      elseif($_SESSION['username']){ //If session is set, display welcome message with logout button.
      	echo("<div class=\"login\">\n");
      	echo "Welcome <strong>".$_SESSION['userarray'][2]."</strong>, you are logged in.\n";
	echo "<a href=\"../php/logout.php\">Logout</a>\n"; 
      	echo("</div>\n");
      }
      
?>
