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

// Check if GET request is received (presumably for deleting a doctor)
if ($_GET) {
    // Import database connection file
    include ("../connection.php");

    // Retrieve doctor's ID from GET parameters
    $id = $_GET["id"];

    // Retrieve doctor's email using their ID
    $result001 = $database->query("select * from doctor where docid=$id;");
    $email = ($result001->fetch_assoc())["docemail"];

    // Delete the doctor's account from the webuser table using their email
    $sql = $database->query("delete from webuser where email='$email';");

    // Delete the doctor's record from the doctor table using their email
    $sql = $database->query("delete from doctor where docemail='$email';");

    // Redirect back to the doctors page after deletion
    header("location: doctors.php");
}
?>