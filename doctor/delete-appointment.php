<?php
// start session
session_start();

// check if user is logged in
if (isset($_SESSION["user"])) {
    // check if user is an admin
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        // redirect to login page if user is not logged in or is not an admin
        header("location: ../login.php");
    }
} else {
    // redirect to login page if user is not logged in
    header("location: ../login.php");
}

// check if GET request is received
if ($_GET) {
    // import database connection
    include ("../connection.php");
    $id = $_GET["id"];
    // delete appointment with the provided ID from the database
    $sql = $database->query("delete from appointment where appoid='$id';");
    // redirect back to the appointments page
    header("location: appointment.php");
}
?>