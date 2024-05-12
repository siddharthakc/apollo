<?php

// start session
session_start();

// check if user is logged in and is a patient
if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        // redirect to login page if not logged in or not a patient
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }

} else {
    // redirect to login page if session user is not set
    header("location: ../login.php");
}


// import database connection
include ("../connection.php");
// sql query to fetch patient details by email
$sqlmain = "select * from patient where pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["pid"];
$username = $userfetch["pname"];


// check if get request is present
if ($_GET) {
    // import database connection
    include ("../connection.php");
    // get the id parameter from get request
    $id = $_GET["id"];
    // sql query to fetch patient details by id
    $sqlmain = "select * from patient where pid=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result001 = $stmt->get_result();
    // get the email of the patient
    $email = ($result001->fetch_assoc())["pemail"];

    // sql query to delete patient from webuser table
    $sqlmain = "delete from webuser where email=?;";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // sql query to delete patient from patient table
    $sqlmain = "delete from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // redirect to logout page after deleting patient
    header("location: ../logout.php");
}


?>