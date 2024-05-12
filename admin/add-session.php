<?php
// start session
session_start();

// check if user is logged in and is an admin
if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        // redirect to login page if user is not logged in or is not an admin
        header("location: ../login.php");
    }
} else {
    // redirect to login page if user is not logged in
    header("location: ../login.php");
}

// handle form submission
if ($_POST) {
    // import database connection
    include ("../connection.php");

    // retrieve form data
    $title = $_POST["title"];
    $docid = $_POST["docid"];
    $nop = $_POST["nop"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // construct SQL query to insert session into schedule table
    $sql = "INSERT INTO schedule (docid, title, scheduledate, scheduletime, nop) VALUES ($docid, '$title', '$date', '$time', $nop);";

    // execute SQL query
    $result = $database->query($sql);

    // redirect to schedule.php with action=session-added and session title
    header("location: schedule.php?action=session-added&title=$title");
}
?>