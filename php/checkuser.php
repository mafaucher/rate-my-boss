<?php

// This is hardcoded, but will have to retrieve info from the database
$userpassword = array (
	"aaa" => "aaa",
	"bbb" => "bbb",
	"ccc" => "ccc",
	"ddd" => "ddd",
)

$usertype = array (
	"aaa" => "sysadmin",
	"bbb" => "finadmin",
	"ccc" => "user",
	"ddd" => "agent",
)

function checkUser($usr, $psw) {
	if array_key_exists($usr, $userpassword) {
		if ($userpassword[$usr] == $psw) {
			return true;
		}
	return false;
}

?>
