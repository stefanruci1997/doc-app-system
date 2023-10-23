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


</head>

<body>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i> <a href="mailto:info@doc-alb.com">info@doc-alb.com</a>
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
        <h1 class="logo me-auto"><a href="../">

                DocAlb</a></h1>


    </div>
</header><!-- End Header -->


<?php


session_start();

$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set the new timezone
date_default_timezone_set('Europe/Amsterdam');
$date = date('Y-m-d');

$_SESSION["date"] = $date;


//import database
include("../db/dbconfig.php");


if ($_POST) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $error = '<label for="promter" class="form-label"></label>';

    $result = $database->query("select * from user where email='$email'");
    $rowCount = $result->num_rows;
    echo $rowCount;

    if ($rowCount == 1) {
        $utype = $result->fetch_assoc()['usertype'];
        if ($utype == 'p') {
            $checker = $database->query("select password from patient where email='$email';");

            if ($checker) {
                $row = $checker->fetch_assoc();
                $hashedPassword = $row['password'];
                if (password_verify($password, $hashedPassword)) {

                    //   Patient dashbord
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'p';

                    header('location: ../patient/index.php');

                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
            }


        } elseif ($utype == 'a') {

            $checker = $database->query("select password from admin where email='$email';");

            if ($checker) {
                $row = $checker->fetch_assoc();
                $hashedPassword = $row['password'];
                if (password_verify($password, $hashedPassword)) {


                    //   Admin dashbord
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'a';

                    header('location: ../admin/index.php');

                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
            }


        } elseif ($utype == 'd') {
            $checker = $database->query("select password from doctor where email='$email';");
            if ($checker) {
                $row = $checker->fetch_assoc();
                $hashedPassword = $row['password'];
                if (password_verify($password, $hashedPassword)) {



                    //   doctor dashbord
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'd';
                    header('location: ../doctor/index.php');

                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
            }


        }

    } else {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
    }


} else {
    $error = '<label for="promter" class="form-label">&nbsp;</label>';
}
$database->close();
?>


<main id="main">

    <section class="breadcrumbs">

        <center>
            <div class="container" style="margin: 20px;padding: 20px;">
                <table border="0" style="margin: 0;padding: 0;width: 60%;" class="text-center>
            <tr>
                <td>
               <h2 class=" text-uppercase text-center mb-5
                ">Log In!</h2>

                </td>
                </tr>
                <div class="form-body text-center">
                    <tr>
                        <td>
                            <p class="sub-text text-center">Login with your email to continue</p>
                        </td>
                    </tr>
                    <tr>
                        <form action="" method="POST">
                            <td class="label-td">
                                <label for="email" class="form-label">Email: </label>
                            </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <input type="email" name="email" class=" w-auto  form-control" placeholder="Email Address"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <label for="password" class="form-label w-auto">Password: </label>
                        </td>
                    </tr>

                    <tr>
                        <td class="label-td text-center">
                            <input type="Password" name="password" class="w-auto form-control" placeholder="Password"
                                   required>
                        </td>
                    </tr>


                    <tr>
                        <td><br>
                            <?php echo $error ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" value="Login" class="login-btn btn-primary btn">
                        </td>
                    </tr>
                </div>
                <tr>
                    <td>
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                        <a href="register.php" class="hover-link1 non-style-link">Sign Up</a>
                        <br><br><br>
                    </td>
                </tr>


                </form>
                </table>

            </div>
        </center>

    </section><!-- End Breadcrumbs Section -->


</main><!-- End #main -->


<?php

include("footer.php");
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

</body>

</html>