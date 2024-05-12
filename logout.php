<!-- clears the session data, destroys the session,
deletes the session cookie, 
and then redirects the user to the login page 
with a logout action. -->

<?php
// start or resume a session
session_start();

// clear all session variables
$_SESSION = [];

// check if the session cookie exists
if (isset($_COOKIE[session_name()])) {
	// delete the session cookie by setting its expiration time to a past value
	setcookie(session_name(), '', time() - 86400, '/');
}

// destroy the session
session_destroy();

// redirect the user to the login page with logout action
header('Location: login.php?action=logout');
?>