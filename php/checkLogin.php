<?php
	// Set $username and $password to values retrieved from POST
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$_SESSION['error'] = 0;
       
	//Check is session is already set.
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		$username = $_SESSION['username']; //Set username variable to value of $_SESSION Username
		$password = $_SESSION['password']; //Set password variable to value of $_SESSION Password
		static $error = 0; //Declare the error value
		$_SESSION['error'] = $error; //Store this error in $_SESSION Error
                $_SESSION['logged'] = true; //Store the fact that user is logged in in $_SESSION array

	}
       
	//Check is cookies are stored and set them
	elseif(isset($_COOKIE['cName']) && isset($_COOKIE['cPass'])){
			//@session_start();		//Begin the session
			$_SESSION['username'] = $_COOKIE['cName']; //Set the session username to the cookied username
			$_SESSION['password'] = $_COOKIE['cPass']; //Set the session password to the cookied password
	}
	//Check if one of the required fields have been left blank
	elseif(empty($_POST['username']) || empty($_POST['password'])){
		//@session_start(); //Begin the session
		$error = 1; //Declare the error value		
		$_SESSION['error'] = 1; //Store this error in $_SESSION Error
                $_SESSION['logged'] = false; //Store the fact that user is not logged in in $_SESSION array
	}
	//Session is not already set and none of the required fields have been left empty, so go ahead with the validation.
	else{


		$resultsArray = checkUser($username, $password); //Fetch the result of the checkUser php function that uses the perl script user validation

		if($resultsArray[0] == 0){ //If the value of the $loginResult is zero, then the validation was successful
			if(isset($_POST['remember'])){ //If the "remember me" function was selected, we will store cookies
				$_SESSION['writeCookies'] = true;
			}
			//@session_start(); //Begin the session
			$_SESSION['username'] = $username; //Set the Session Username value to that of the $username variable
			$_SESSION['password'] = $password; //Set the Session Password value to that of the $password variable
			$_SESSION['logged'] = true; //Store the fact that user is logged in in $_SESSON array
			$_SESSION['userarray'] = $resultsArray;
		}
		else{ //The $loginResult is not zero, (it is 5), therefore the validation was not successful.
			//@session_start(); //Begin the session
			$error = 2; //Declare the error value
			$_SESSION['error'] = $error; //Store this error in $_SESSION Error
                        $_SESSION['logged'] = false; //Store the fact that user is not logged in in $_SESSION array
		}
		
	}//End else (store login info)
?>
