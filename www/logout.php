<?php

/* Log user logout */

/* Negate the cookies, destroy the session, redirect to index.php. */
setcookie("username", $username, time()-60*60*24*100, "/");
setcookie("password", $password, time()-60*60*24*100, "/");
setcookie("usertype", $usertype, time()-60*60*24*100, "/");
setcookie("userid", $userid, time()-60*60*24*100, "/");
@session_start();
@session_destroy();
@header("Location: index.php");

?>
