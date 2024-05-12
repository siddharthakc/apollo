<?php

// start session
session_start();

// check if user is logged in and is an admin
if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        // redirect to login page if not logged in or not an admin
        header("location: ../login.php");
    }

} else {
    // redirect to login page if session user is not set
    header("location: ../login.php");
}


// check if get request is present
if ($_GET) {
    // import database connection
    include ("../connection.php");
    // get the id parameter from get request
    $id = $_GET["id"];
    //$result001= $database->query("select * from schedule where scheduleid=$id;");
    //$email=($result001->fetch_assoc())["docemail"];
    // sql query to delete appointment by id
    $sql = $database->query("delete from appointment where appoid='$id';");
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    //$sql= $database->query("delete from doctor where docemail='$email';");
    //print_r($email);
    // redirect to appointment page after deleting appointment
    header("location: appointment.php");
}


?>