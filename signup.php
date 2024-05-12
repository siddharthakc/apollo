<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css stylesheets -->
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">

    <!-- title -->
    <title>Apollo | Sign Up</title>

</head>

<body>
    <?php
    // start a session
    session_start();
    // initialize session variables
    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // set the new timezone
    date_default_timezone_set('Asia/Kathmandu');
    // get and store current date in session
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;

    // check if form is submitted
    if ($_POST) {
        // store form data in session variable
        $_SESSION["personal"] = array(
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'address' => $_POST['address'],
            'dob' => $_POST['dob']
        );
        // print the stored personal data (for debugging purposes)
        print_r($_SESSION["personal"]);
        // redirect user to create-account.php
        header("location: create-account.php");
    }

    ?>

    <center>
        <div class="container">
            <table border="0">
                <tr>
                    <td colspan="2">
                        <!-- header text -->
                        <p class="header-text">Sign up</p>
                        <p class="sub-text">It's quick and easy.</p>
                    </td>
                </tr>
                <tr>
                    <!-- form for user input -->
                    <form action="" method="POST">
                        <td class="label-td" colspan="2">
                            <label for="name" class="form-label">Name: </label>
                        </td>
                </tr>
                <tr>
                    <!-- input fields for first name and last name -->
                    <td class="label-td">
                        <input type="text" name="fname" class="input-text" placeholder="First Name" required>
                    </td>
                    <td class="label-td">
                        <input type="text" name="lname" class="input-text" placeholder="Sure Name" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="address" class="form-label">Address: </label>
                    </td>
                </tr>
                <tr>
                    <!-- input field for address -->
                    <td class="label-td" colspan="2">
                        <input type="text" name="address" class="input-text" placeholder="Address" required>
                    </td>
                </tr>

                <tr>
                    <td class="label-td" colspan="2">
                        <label for="dob" class="form-label">Date of Birth: </label>
                    </td>
                </tr>
                <tr>
                    <!-- input field for date of birth -->
                    <td class="label-td" colspan="2">
                        <input type="date" name="dob" class="input-text" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                    </td>
                </tr>

                <tr>
                    <td>
                        <!-- button to reset form fields -->
                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                    </td>
                    <td>
                        <!-- button to submit form data -->
                        <input type="submit" value="Next" class="login-btn btn-primary btn">
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <!-- link to login page for users with existing accounts -->
                        <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                        <a href="login.php" class="hover-link1 non-style-link">Login</a>
                        <br><br><br>
                    </td>
                </tr>

                </form>
                </tr>
            </table>

        </div>
    </center>
</body>

</html>
<style>
    .login-btn {
        padding: 10px 25px;
        background-color: transparent;
        color: #ffffff;
        border: 2px solid #ffffff;

        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.4s, color 0.4s, border-color 0.4s;
    }

    /* button hover effect */
    .login-btn:hover {
        background-color: #ffffff;
        /* white background on hover */
        color: #000000;
        /* black text on hover */
    }

    /* button focus style */
    .login-btn:focus {
        outline: none;
    }

    /* button click effect */
    .login-btn:active {
        transform: translateY(1px);
    }
</style>