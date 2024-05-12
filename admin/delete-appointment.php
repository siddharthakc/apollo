<?php
// Start session to manage user sessions
session_start();

// Check if user is logged in and is an administrator
if (isset($_SESSION["user"])) {
    // Check if the user is logged in and has administrator privileges
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        // Redirect to login page if not logged in as admin
        header("location: ../login.php");
    }
} else {
    // Redirect to login page if session is not set
    header("location: ../login.php");
}

// Check if GET request is received (presumably for deleting an appointment)
if ($_GET) {
    // Import database connection file
    include ("../connection.php");

    // Retrieve appointment ID from GET parameters
    $id = $_GET["id"];

    // Execute SQL query to delete appointment with the specified ID
    $sql = $database->query("delete from appointment where appoid='$id';");

    // Redirect back to the appointments page after deletion
    header("location: appointment.php");
}
?>