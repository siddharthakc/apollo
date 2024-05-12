<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS stylesheets -->
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">

    <!-- Title -->
    <title>Apollo | Login</title>
</head>

<body>
    <?php
    // Start or resume a session
    session_start();

    // Initialize session variables
    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Set the new timezone
    date_default_timezone_set('Asia/Kathmandu');
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;

    // Import database connection
    include ("connection.php");

    // Check if form is submitted
    if ($_POST) {
        // Retrieve form data
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];

        // Initialize error message
        $error = '<label for="promter" class="form-label"></label>';

        // Check if the user exists in the database
        $result = $database->query("select * from webuser where email='$email'");
        if ($result->num_rows == 1) {
            // Fetch user type
            $utype = $result->fetch_assoc()['usertype'];
            // Check user type
            if ($utype == 'p') {
                // If user is a patient
                $checker = $database->query("select * from patient where pemail='$email' and ppassword='$password'");
                if ($checker->num_rows == 1) {
                    // Redirect to patient dashboard
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'p';
                    header('location: patient/index.php');
                } else {
                    // Invalid credentials for patient
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
            } elseif ($utype == 'a') {
                // If user is an admin
                $checker = $database->query("select * from admin where aemail='$email' and apassword='$password'");
                if ($checker->num_rows == 1) {
                    // Redirect to admin dashboard
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'a';
                    header('location: admin/index.php');
                } else {
                    // Invalid credentials for admin
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
            } elseif ($utype == 'd') {
                // If user is a doctor
                $checker = $database->query("select * from doctor where docemail='$email' and docpassword='$password'");
                if ($checker->num_rows == 1) {
                    // Redirect to doctor dashboard
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'd';
                    header('location: doctor/index.php');
                } else {
                    // Invalid credentials for doctor
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
            }
        } else {
            // User not found
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
        }
    } else {
        // Form not submitted
        $error = '<label for="promter" class="form-label">&nbsp;</label>';
    }
    ?>

    <!-- Login form -->
    <center>
        <div class="container">
            <table border="0" style="margin: 0;padding: 0;width: 60%;">
                <!-- Header text -->
                <tr>
                    <td>
                        <p class="header-text">Welcome Back!</p>
                    </td>
                </tr>

                <!-- Form fields -->
                <tr>
                    <form action="" method="POST">
                        <td class="label-td">
                            <label for="useremail" class="form-label">Email: </label>
                        </td>
                </tr>
                <!-- More form fields -->
                <tr>
                    <td class="label-td">
                        <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                    </td>
                </tr>
                <!-- Password field -->
                <tr>
                    <td class="label-td">
                        <label for="userpassword" class="form-label">Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td">
                        <input type="Password" name="userpassword" class="input-text" placeholder="Password" required>
                    </td>
                </tr>
                <!-- Error message display -->
                <tr>
                    <td><br>
                        <?php echo $error ?>
                    </td>
                </tr>
                <!-- Login button -->
                <tr>
                    <td>
                        <input type="submit" value="Login" class="login-btn btn-primary btn">
                    </td>
                </tr>
                <!-- Signup link -->
                <tr>
                    <td>
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                        <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a>
                        <br><br><br>
                    </td>
                </tr>
                </form>
            </table>
        </div>
    </center>
</body>

</html>
<style>
    .login-btn {
        padding: 10px 25px;
        background-color: #000000;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: transform 0.4s ease-in-out, background-color 0.4s ease-in-out, color 0.4s ease-in-out;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .login-btn:hover {
        background-color: #ffffff;
        color: #000000;
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.1);
    }

    .login-btn:focus {
        outline: none;
    }

    .login-btn:active {
        transform: translateY(1px);
    }
</style>