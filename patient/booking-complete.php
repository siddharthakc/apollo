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


// check if post request is present
if ($_POST) {
    // check if the form is submitted to book an appointment
    if (isset($_POST["booknow"])) {
        $apponum = $_POST["apponum"];
        $scheduleid = $_POST["scheduleid"];
        $date = $_POST["date"];
        $scheduleid = $_POST["scheduleid"];
        // sql query to insert appointment
        $sql2 = "insert into appointment(pid,apponum,scheduleid,appodate) values ($userid,$apponum,$scheduleid,'$date')";
        $result = $database->query($sql2);
        // redirect to appointment page after adding appointment
        header("location: appointment.php?action=booking-added&id=" . $apponum . "&titleget=none");

    }
}
?>