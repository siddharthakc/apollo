<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Appointments</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
    <?php

    // start session
    session_start();

    // check if user is logged in and is an admin
    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            header("location: ../login.php");
        }

    } else {
        header("location: ../login.php");
    }

    // import database
    include ("../connection.php");

    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@gmail.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out"
                                            class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Dashboard</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor ">
                <a href="doctors.php" class="non-style-link-menu ">
                    <div>
                        <p class="menu-text">Doctors</p>
                </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-schedule ">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Schedule</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment menu-active menu-icon-appoinment-active">
            <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active">
                <div>
                    <p class="menu-text">Appointment</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient">
            <a href="patient.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Patients</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="appointment.php"><button class="login-btn btn-primary-soft btn btn-icon-back"
                            style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Appointment Manager</p>

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php

                        date_default_timezone_set('Asia/Kathmandu');

                        $today = date('Y-m-d');
                        echo $today;

                        $list110 = $database->query("select  * from  appointment;");

                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img
                            src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>

            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;">

                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All
                        Appointments (<?php echo $list110->num_rows; ?>)</p>
                </td>

            </tr>
            <tr>
                <td colspan="4" style="padding-top:0px;width: 100%;">
                    <center>
                        <table class="filter-container" border="0">
                            <tr>
                                <td width="10%">

                                </td>
                                <td width="5%" style="text-align: center;">
                                    Date:
                                </td>
                                <td width="30%">
                                    <form action="" method="post">

                                        <input type="date" name="sheduledate" id="date"
                                            class="input-text filter-container-items" style="margin: 0;width: 95%;">

                                </td>
                                <td width="5%" style="text-align: center;">
                                    Doctor:
                                </td>
                                <td width="30%">
                                    <select name="docid" id="" class="box filter-container-items"
                                        style="width:90% ;height: 37px;margin: 0;">
                                        <option value="" disabled selected hidden>Choose Doctor Name from the list
                                        </option><br />

                                        <?php

                                        $list11 = $database->query("select  * from  doctor order by docname asc;");

                                        for ($y = 0; $y < $list11->num_rows; $y++) {
                                            $row00 = $list11->fetch_assoc();
                                            $sn = $row00["docname"];
                                            $id00 = $row00["docid"];
                                            echo "<option value=" . $id00 . ">$sn</option><br/>";
                                        }
                                        ;


                                        ?>

                                    </select>
                                </td>
                                <td width="12%">
                                    <input type="submit" name="filter" value=" Filter"
                                        class=" btn-primary-soft btn button-icon btn-filter"
                                        style="padding: 15px; margin :0;width:100%">
                                    </form>
                                </td>

                            </tr>
                        </table>

                    </center>
                </td>

            </tr>

            <?php
            if ($_POST) {
                //print_r($_POST);
                $sqlpt1 = "";
                if (!empty($_POST["sheduledate"])) {
                    $sheduledate = $_POST["sheduledate"];
                    $sqlpt1 = " schedule.scheduledate='$sheduledate' ";
                }


                $sqlpt2 = "";
                if (!empty($_POST["docid"])) {
                    $docid = $_POST["docid"];
                    $sqlpt2 = " doctor.docid=$docid ";
                }
                //echo $sqlpt2;
                //echo $sqlpt1;
                $sqlmain = "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid";
                $sqllist = array($sqlpt1, $sqlpt2);
                $sqlkeywords = array(" where ", " and ");
                $key2 = 0;
                foreach ($sqllist as $key) {

                    if (!empty($key)) {
                        $sqlmain .= $sqlkeywords[$key2] . $key;
                        $key2++;
                    }
                    ;
                }
                ;
                //echo $sqlmain;
            


                //
            } else {
                $sqlmain = "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  order by schedule.scheduledate desc";

            }



            ?>

            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">
                                            Patient name
                                        </th>
                                        <th class="table-headin">

                                            Appointment number

                                        </th>


                                        <th class="table-headin">
                                            Doctor
                                        </th>
                                        <th class="table-headin">


                                            Session Title

                                        </th>

                                        <th class="table-headin" style="font-size:10px">

                                            Session Date & Time

                                        </th>

                                        <th class="table-headin">

                                            Appointment Date

                                        </th>

                                        <th class="table-headin">

                                            Events

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


                                    $result = $database->query($sqlmain);

                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button></a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';

                                    } else {
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $row = $result->fetch_assoc();
                                            $appoid = $row["appoid"];
                                            $scheduleid = $row["scheduleid"];
                                            $title = $row["title"];
                                            $docname = $row["docname"];
                                            $scheduledate = $row["scheduledate"];
                                            $scheduletime = $row["scheduletime"];
                                            $pname = $row["pname"];
                                            $apponum = $row["apponum"];
                                            $appodate = $row["appodate"];
                                            echo '<tr >
                                        <td style="font-weight:600;"> &nbsp;' .

                                                substr($pname, 0, 25)
                                                . '</td >
                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                        ' . $apponum . '
                                        
                                        </td>
                                        <td>
                                        ' . substr($docname, 0, 25) . '
                                        </td>
                                        <td>
                                        ' . substr($title, 0, 15) . '
                                        </td>
                                        <td style="text-align:center;font-size:12px;">
                                            ' . substr($scheduledate, 0, 10) . ' <br>' . substr($scheduletime, 0, 5) . '
                                        </td>
                                        
                                        <td style="text-align:center;">
                                            ' . $appodate . '
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <!--<a href="?action=view&id=' . $appoid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;-->
                                       <a href="?action=drop&id=' . $appoid . '&name=' . $pname . '&session=' . $title . '&apponum=' . $apponum . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Cancel</font></button></a>
                                       &nbsp;&nbsp;&nbsp;</div>
                                        </td>
                                    </tr>';

                                        }
                                    }

                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </center>
                </td>
            </tr>



        </table>
    </div>
    </div>
    <?php

    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'add-session') {

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                    
                        <a class="close" href="schedule.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">' .
                ""

                . '</td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Session.</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <form action="add-session.php" method="POST" class="add-new-form">
                                    <label for="title" class="form-label">Session Title : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="title" class="input-text" placeholder="Name of this Session" required><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="docid" class="form-label">Select Doctor: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="docid" id="" class="box" >
                                    <option value="" disabled selected hidden>Choose Doctor Name from the list</option><br/>';


            $list11 = $database->query("select  * from  doctor;");

            for ($y = 0; $y < $list11->num_rows; $y++) {
                $row00 = $list11->fetch_assoc();
                $sn = $row00["docname"];
                $id00 = $row00["docid"];
                echo "<option value=" . $id00 . ">$sn</option><br/>";
            }
            ;




            echo '       </select><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nop" class="form-label">Number of Patients/Appointment Numbers : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="number" name="nop" class="input-text" min="0"  placeholder="The final appointment number for this session depends on this number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="date" class="form-label">Session Date: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="date" name="date" class="input-text" min="' . date('Y-m-d') . '" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="time" class="form-label">Schedule Time: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="time" name="time" class="input-text" required><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="submit" name="add-session" class="btn-primary-soft btn" value="Add Session">
                                    </form>
                                </td>
                            </tr>
                        </table></div></div></center>
                    </div>
            </div>';
        } else if ($action == 'view') {
            $result1 = $database->query("select * from appointment where appoid=" . $id . "");
            $row = $result1->fetch_assoc();
            $pname = $row["pname"];
            $docid = $row["docid"];
            $appodate = $row["appodate"];
            $schedid = $row["scheduleid"];
            $appotoken = $row["token"];

            $result2 = $database->query("select * from schedule where scheduleid=" . $schedid . "");
            $row2 = $result2->fetch_assoc();
            $sdate = $row2["scheduledate"];
            $stime = $row2["scheduletime"];

            $result3 = $database->query("select * from doctor where docid=" . $docid . "");
            $row3 = $result3->fetch_assoc();
            $docname = $row3["docname"];

            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                    <a class="close" href="appointment.php">&times;</a> 
                    <div style="display: flex;justify-content: center;">
                    <div class="abc">
                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                    
                        <tr>
                            <td class="label-td" colspan="2">
                                <h2 style="font-weight:600;margin:0;"> Appointment Details</h2><br>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" style="font-weight:500;">Patient Name :</td>
                            <td>' . $pname . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight:500;">Doctor :</td>
                            <td>' . $docname . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight:500;">Date of Appointment :</td>
                            <td>' . $appodate . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight:500;">Session Date :</td>
                            <td>' . $sdate . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight:500;">Session Time :</td>
                            <td>' . $stime . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight:500;">Appointment Token :</td>
                            <td>' . $appotoken . '</td>
                        </tr>
                    </table></div></div></center>
                </div>
        </div>';
        }
    }
    if ($_GET) {
        $id = $_GET["id"];
        $name = $_GET["name"];
        $session = $_GET["session"];
        $apponum = $_GET["apponum"];
        $action = $_GET["action"];
        if ($action == 'drop') {
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <a class="close" href="appointment.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                            <tr>
                                <td class="label-td" colspan="2">
                                    <h2 style="font-weight:600;margin:0;"> Are you sure to cancel this appointment ? </h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:500;">Patient Name :</td>
                                <td>' . $name . '</td>
                            </tr>
                            <tr>
                                <td style="font-weight:500;">Session Title :</td>
                                <td>' . $session . '</td>
                            </tr>
                            <tr>
                                <td style="font-weight:500;">Appointment Number :</td>
                                <td>' . $apponum . '</td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <a href="delete-appointment.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary-soft btn"  style="padding: 15px; margin :0;"> &nbsp; Yes, Cancel this appointment &nbsp;</button></a>
                                    <a href="appointment.php" class="non-style-link"><button  class="btn-primary-soft btn"  style="padding: 15px; margin :0;"> &nbsp; No, Don\'t Cancel &nbsp;</button></a>
                                </td>
                            </tr>
                        </table></div></div>
                    </center>
                </div>
        </div>';
        }
    }

    ?>

</body>

</html>
