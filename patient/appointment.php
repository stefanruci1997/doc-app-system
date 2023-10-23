<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>DocAlb</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/DocAlb-logo.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/adm.css" rel="stylesheet">


</head>

<body>
<?php

//learn from w3schools.com

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../pages/login.php");
    }

} else {
    header("location: ../pages/login.php");
}
include("../db/dbconfig.php");



$email=$_SESSION["user"];
$patientrow1 = $database->query("select ptel  from  patient where email='$email';")->fetch_assoc();

?>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            &nbsp &nbsp
            <i class="bi bi-person-circle"></i> Patient Page &nbsp &nbsp
            <i class="bi bi-envelope-at"></i> <?php echo $_SESSION['user'];
            ?> <i class="bi bi-phone"></i> <?php echo $patientrow1["ptel"]  ; ?>
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <img src="../assets/img/DocAlb-logo.png" width="60px" height="60px">
        <h1 class="logo me-auto"><a href="index.php">

                DocAlb</a></h1>


        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto " href="index.php">Home</a></li>
                <li><a class="nav-link scrollto" href="doctors.php">Doctors</a></li>
                <li><a class="nav-link scrollto active" href="appointment.php">Appointment</a></li>
                <li><a class="nav-link scrollto" href="settings.php">Settings </a></li>

                <li><a href="../services/logout.php"><input type="button" value="Log out"
                                                            class="logout-btn btn-primary-soft btn"></a>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->

<section class="w-100 m-5">
    <div class="container w-100 h-auto d-grid m-5">

        <div class="row ">
            <div class="col-12">

                <p class="" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My Appointments
                    (<?php
                    $pid = $database->query("select  * from  patient where email='$_SESSION[user]';")->fetch_assoc()["pid"];
                    $appointments_query_result = $database->query("select  * from  appointment where pid='$pid';");


                    echo $appointments_query_result->num_rows; ?>)</p>

            </div>
        </div>


        <div class="row ">

            <div class="col ">


                <div class="abc scroll">
                    <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                            <th class="table-headin">


                                APP number

                            </th>
                            <th class="table-headin">


                                Doctor Name

                            </th>
                            <th class="table-headin">
                                Patient name
                            </th>
                            <th class="table-headin">

                                Specialties

                            </th>
                            <th class="table-headin">

                                Appointment Date

                            </th>
                            <th class="table-headin">

                                Appointment Time

                            </th>
                            <th class="table-headin">

                                Events

                        </tr>
                        </thead>
                        <tbody>

                        <?php



                        if ($appointments_query_result->num_rows == 0) {
                            echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../assets/img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all appointments &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';

                        } else {
                            for ($x = 0; $x < $appointments_query_result->num_rows; $x++) {
                                $row = $appointments_query_result->fetch_assoc();
                                $doc_id = $row["doc_id"];
                                $pid = $row["pid"];
                                $date = $row["date"];
                                $app_nr = $row["app_id"];
                                $s_time = $row["s_time"];

                                $mysqli_result_p = $database->query("select  * from  patient where pid='$pid';");

                                $mysqli_result_d = $database->query("select  * from  doctor where doc_id='$doc_id';");
                                $p_row = $mysqli_result_p->fetch_assoc();
                                $d_row = $mysqli_result_d->fetch_assoc();


                                $dname = $d_row["name"];
                                $pname = $p_row["name"];
                                $spe = $d_row["specialties"];


                                $spcil_res = $database->query("select sname from specialties where id='$spe'");
                                $spcil_array = $spcil_res->fetch_assoc();
                                $spcil_name = $spcil_array["sname"];


//                                    $spcil_res = $database->query("select sname from specialties where name='$spe'");
//                                    $spcil_array = $spcil_res->fetch_assoc();
//                                    $spcil_name = $spcil_array["sname"];
                                echo '<tr>
                                        <td> &nbsp;' .
                                    $app_nr . '</td>
                                              <td> &nbsp;' .
                                    $dname . '</td>
                                        
                                        <td>
                                        ' . $pname . '
                                        </td>
                                        <td>
                                            ' . $spcil_name . '
                                        </td> <td>
                                            ' . $date . '
                                        </td><td>
                                            ' . $s_time . '
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        <a href="?action=drop&id=' . $app_nr . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Delete</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        </div>
                                        </td>
                                    </tr>';

                            }
                        }

                        if ($_GET) {
                            $id = $_GET["id"];
                            $action = $_GET["action"];
                            if ($action == 'drop') {
                                $nameget = $_GET["name"];
                                echo '
                            <div id="popup1" class="overlay">
                                    <div class="popup">
                                    <center>
                                        <h2>Are you sure?</h2>
                                        <a class="close" href="appointment.php">&times;</a>
                                        <div class="content">
                                            You want to delete this record<br>(' . substr($id, 0, 40) . ').
                                            
                                        </div>
                                        <div style="display: flex;justify-content: center;">
                                        <a href="delete-appointment.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>
                
                                        </div>
                                    </center>
                            </div>
                            </div>
                            ';
                            }
                           
                        }



                        ?>

                        </tbody>

                    </table>
                </div>
            </div>

        </div>
</section>


<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>
<?php
include("../pages/footer.php");
?>
</body>

</html>



