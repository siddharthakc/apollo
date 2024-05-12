<?php
// import database connection
include ("../connection.php");

// check if POST request is received
if ($_POST) {
    // retrieve all web users from the database
    $result = $database->query("select * from webuser");
    // retrieve form data
    $name = $_POST['name'];
    $oldemail = $_POST["oldemail"];
    $nic = $_POST['nic'];
    $spec = $_POST['spec'];
    $email = $_POST['email'];
    $tele = $_POST['Tele'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $id = $_POST['id00'];

    // check if passwords match
    if ($password == $cpassword) {
        $error = '3';
        // retrieve doctor ID associated with the provided email
        $result = $database->query("select doctor.docid from doctor inner join webuser on doctor.docemail=webuser.email where webuser.email='$email';");
        if ($result->num_rows == 1) {
            $id2 = $result->fetch_assoc()["docid"];
        } else {
            $id2 = $id;
        }

        // check if the retrieved doctor ID is different from the provided ID
        if ($id2 != $id) {
            $error = '1';
        } else {
            // update doctor and web user information in the database
            $sql1 = "update doctor set docemail='$email',docname='$name',docpassword='$password',docnic='$nic',doctel='$tele',specialties=$spec where docid=$id ;";
            $database->query($sql1);

            $sql1 = "update webuser set email='$email' where email='$oldemail' ;";
            $database->query($sql1);

            $error = '4';
        }

    } else {
        $error = '2';
    }
} else {
    // no POST request received
    $error = '3';
}

// redirect back to the settings page with error and ID parameters
header("location: settings.php?action=edit&error=" . $error . "&id=" . $id);
?>