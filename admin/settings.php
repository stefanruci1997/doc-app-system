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
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        header("location: ../pages/login.php");
    }

} else {
    header("location: ../pages/login.php");
}

include("../db/dbconfig.php");

?>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            &nbsp &nbsp
            <i class="bi bi-person-circle"></i> Administrator &nbsp &nbsp
            <i class="bi bi-envelope-at"></i> admin@edoc.com
            <i class="bi bi-phone"></i> +355 224 554 55
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
                <li><a class="nav-link scrollto" href="patient.php">Patients </a></li>
                <li><a class="nav-link scrollto active" href="settings.php">Settings </a></li>

                <li><a href="../services/logout.php"><input type="button" value="Log out"
                                                            class="logout-btn btn-primary-soft btn"></a>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->





<section id="counts" class="counts">
<?php
$email=$_SESSION["user"];



?>
    <div class="container d-grid    w-25"   style="margin-top:100px ">
        <div class="row">
            <div class="col-12">
                <h3> My information </h3>
            </div>
            <form action="edit-settings.php" method="POST" class="add-new-form ">


                <div class="row">
                    <div class="col-12">
                        <input type="hidden" name="oldemail" value="<?php echo  $email ?>" >

                        <p> Email:   </p>
                        <input type="email" name="email" class="input-text form-control form-control-lg"
                               placeholder="Email Address" value="<?php echo  $email ?>"
                               required><br>
                    </div>
                    <div class="row">
                        <div class="col-12">

                            <p> Password:   </p>
                            <input type="password" name="password" class="input-text form-control form-control-lg"
                                   placeholder="Defind a Password"><br>

                        </div>
                        <div class="row">
                            <div class="col-12">

                                <p> Confirm Password:   </p>
                                <input type="password" name="cpassword" class="input-text form-control form-control-lg"
                                       placeholder="Confirm Password"><br>

                            </div>

                            <br><br><br><br>

                            <div class="row">
                                <div class="col-12">

                                                    <input type="reset" value="Reset"
                                                           class="login-btn btn-primary-soft btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <input type="submit" value="Save"                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">

                                </div>

                            </div>

                                        </form>

</section>
<?php
include("../pages/footer.php");
?>

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



