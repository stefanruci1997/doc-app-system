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
                <li><a class="nav-link scrollto " href="doctors.php">Doctors</a></li>
                <li><a class="nav-link scrollto" href="appointment.php">Appointment</a></li>
                <li><a class="nav-link scrollto active" href="settings.php">Settings </a></li>

                <li><a href="../services/logout.php"><input type="button" value="Log out"
                                                            class="logout-btn btn-primary-soft btn"></a>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->
<?php


?>

<center>
    <section class="w-50 text-center m-5">


        <?php

        if (isset($_POST['doc_id'])) {
            $doc_id = $_POST['doc_id'];
        }
        if (isset($_POST['pid'])) {
            $pid = $_POST['pid'];
        }
        if (isset($_POST['date'])) {

            $date = $_POST['date'];

        }

        $sel_doc_appointments = "SELECT s_time FROM appointment WHERE doc_id='$doc_id' and date ='$date';";

        $doc_appoints = $database->query($sel_doc_appointments);


        echo '  
      <div class="container d-grid  text-center   w-75" style="margin-top:100px ">
        <div class="row">
            <div class="col-12">
                <h3> Book Doctor Session  (Doctor ID: ' . $doc_id . ' ) </h3>
            </div>
        </div>


            <form action="add-booking.php" method="POST" class="add-new-form  ">

                <input type="hidden" name="doc_id" value="' . $doc_id . ' ">
                <input type="hidden" name="pid" value="' . $pid . ' ">
                <input type="hidden" name="date" value="' . $date . ' ">

              

                <div class="form-outline mb-4">
                    <label class="form-label" for="time">Choose available time </label>
                    <select name="time" required  class="  box form-control form-control-lg form-select" >
                    
                    ';


        $sessions_res = $database->query("select  * from  session;");
        if ($doc_appoints->num_rows > 0) {
            $bookedSlots = array();
            while ($row = $doc_appoints->fetch_assoc()) {
                $bookedSlots[] = $row["s_time"];
            }
            while ($row = $sessions_res->fetch_assoc()) {
                $ds_time = $row["s_time"];

                if (in_array($ds_time, $bookedSlots)) {
                    continue;
                } else {
                    echo "<option value=\"$ds_time\">$ds_time</option><br/>";
                }
            }


        } else {
            for ($y = 0; $y < $sessions_res->num_rows; $y++) {
                $row00 = $sessions_res->fetch_assoc();
                $s_time = $row00["s_time"];
                echo "<option value=" . $s_time . ">$s_time</option><br/>";
            };
        }

        echo '
    </select>
               
                </div>


   
                   <input type="reset" value="Reset"
                          class="login-btn btn-primary-soft btn">&nbsp;
                   <input type="submit" value="Book"   id="time_form_submit"
                          class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
            </form>
    </div>

      ';

        ?>


    </section>
</center>


<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


<!-- Vendor JS Files -->
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>


<?php
include("../pages/footer.php");
?>
</body>

</html>



