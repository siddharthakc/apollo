<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css stylesheets -->
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <!-- title -->
    <title>Doctor</title>
</head>

<body>
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

    // import database connection
    include ("../connection.php");

    // handle form submission
    if ($_POST) {
        // retrieve form data
        $name = $_POST['name'];
        $nic = $_POST['nic'];
        $spec = $_POST['spec'];
        $email = $_POST['email'];
        $tele = $_POST['Tele'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        // check if passwords match
        if ($password == $cpassword) {
            $error = '3';
            // check if email already exists in the database
            $result = $database->query("select * from webuser where email='$email';");
            if ($result->num_rows == 1) {
                // email already exists
                $error = '1';
            } else {
                // insert new doctor details into the database
                $sql1 = "insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
                $sql2 = "insert into webuser values('$email','d')";
                $database->query($sql1);
                $database->query($sql2);

                // doctor added successfully
                $error = '4';
            }
        } else {
            // passwords do not match
            $error = '2';
        }
    } else {
        // form not submitted
        $error = '3';
    }

    // redirect to doctors.php with action=add and error code
    header("location: doctors.php?action=add&error=" . $error);
    ?>
</body>

</html>