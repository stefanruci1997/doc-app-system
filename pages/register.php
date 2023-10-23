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

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $paddress = $_POST['address'];
    $city = $_POST['city'];
    $reg_date = date('Y-m-d');
    $ptel = $_POST['telephone'];
    $newpassword = $_POST['new_password'];
    $cpassword = $_POST['c_password'];

    if ($newpassword == $cpassword) {

        $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);

        $sqlmain = "select * from user where email=?;";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
        } else {
            $database->query("insert into patient (name, surname, email, address, country, city, reg_date, ptel, password) VALUES ('$name', '$surname', '$email', '$paddress', '$country', '$city', '$reg_date', '$ptel', '$hashedPassword');");
            $database->query("insert into user (email, usertype) values('$email','p');");

            //print_r("insert into patient values($pid,'$email','$fname','$lname','$newpassword','$address','$nic','$dob','$tele');");
            $_SESSION["user"] = $email;
            $_SESSION["usertype"] = "p";
            $_SESSION["username"] = $name;

            header('Location: ../patient/index.php');
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
        }

    } else {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>';
    }


} else {
    //header('location: signup.php');
    $error = '<label for="promter" class="form-label"></label>';
}

?>


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
        <h1 class="logo me-auto"><a href="index.html">

                DocAlb</a></h1>


    </div>
</header><!-- End Header -->


<main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">

        <section class="vh-auto bg-image"
                 style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5">Create an patient account</h2>

                                    <form action="" method="POST">

                                        <div class="form-outline mb-4">
                                            <input type="text" name="name" class="form-control form-control-lg"/>
                                            <label class="form-label" for="name">Your Name</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" name="surname" class="form-control form-control-lg"/>
                                            <label class="form-label" for="surname">Your Surname</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" class="form-control form-control-lg"/>
                                            <label class="form-label" for="email">Your Email</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" name="address" class="form-control form-control-lg"/>
                                            <label class="form-label" for="address">Your Address</label>
                                        </div>

                                    


                                        <div class="form-outline mb-4">

                                            <select name="city" class="box form-control form-control-lg form-select">
                                                <option value="Tirane">Tirane</option>
                                                <option value="Durres">Durres</option>
                                                <option value="Elbasan">Elbasan</option>
                                                <option value="Fier">Fier</option>
                                                <option value="Vlore">Vlore</option>
                                                <option value="Shkoder">Shkoder</option>
                                                <option value="-" selected>-----all cities--------</option>
                                                <option value="Berat">Berat</option>
                                                <option value="Bulqize">Bulqize</option>
                                                <option value="Delvine">Delvine</option>
                                                <option value="Devoll">Devoll</option>
                                                <option value="Diber">Diber</option>
                                                <option value="Durres ">Durres</option>
                                                <option value="Gjiri Lalezit">Durres Gjiri Lalezit / Hamallaj</option>
                                                <option value="Plazh-Durres">Durres Plazh</option>
                                                <option value="Shkembi Kavajes">Shkembi Kavajes</option>
                                                <option value="Kavaje">Kavaje</option>
                                                <option value="Golem">Kavaje Golem</option>
                                                <option value="Mali Robit">Kavaje Mali Robit</option>
                                                <option value="Qerret">Kavaje Qerret</option>
                                                <option value="Spille">Kavaje Spille</option>
                                                <option value="Elbasan ">Elbasan</option>
                                                <option value="Fier ">Fier</option>
                                                <option value="Gjirokaster">Gjirokaster</option>
                                                <option value="Gramsh">Gramsh</option>
                                                <option value="Has">Has</option>
                                                <option value="Kolonje">Kolonje</option>
                                                <option value="Korce">Korce</option>
                                                <option value="Kruje">Kruje</option>
                                                <option value="Fushe Kruje">Fushe Kruje</option>
                                                <option value="Kucove">Kucove</option>
                                                <option value="Kukes">Kukes</option>
                                                <option value="Kurbin">Kurbin</option>
                                                <option value="Lezhe">Lezhe</option>
                                                <option value="Shengjin">Lezhe Shengjin</option>
                                                <option value="Librazhd">Librazhd</option>
                                                <option value="Lushnje">Lushnje</option>
                                                <option value="Divjake">Lushnje Divjake</option>
                                                <option value="Malesi e Madhe">Malesi e Madhe</option>
                                                <option value="Mallakaster">Mallakaster</option>
                                                <option value="Mat">Mat</option>
                                                <option value="Mirdite">Mirdite</option>
                                                <option value="Peqin">Peqin</option>
                                                <option value="Permet">Permet</option>
                                                <option value="Peshkopi">Peshkopi</option>
                                                <option value="Pogradec">Pogradec</option>
                                                <option value="Puke">Puke</option>
                                                <option value="Rreshen">Rreshen</option>
                                                <option value="Rrogozhine">Rrogozhine</option>
                                                <option value="Sarande">Sarande</option>
                                                <option value="Ksamil">Sarande Ksamil</option>
                                                <option value="Shkoder ">Shkoder</option>
                                                <option value="Velipoje">Shkoder Velipoje</option>
                                                <option value="Skrapar">Skrapar</option>
                                                <option value="Tirane ">Tirane</option>
                                                <option value="Tepelene">Tepelene</option>
                                                <option value="Tropoje">Tropoje</option>
                                                <option value="Vlore ">Vlore</option>
                                                <option value="Lungomare">Vlore - Lungomare - Uji i Ftohte</option>
                                                <option value="Orikum">Vlore Orikum</option>
                                                <option value="Dhermi">Vlore Dhermi</option>
                                                <option value="Himare">Vlore Himare</option>

                                            </select>
                                            <label class="form-label" for="city">Chose the city</label>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="tel" name="telephone" class="form-control form-control-lg"
                                                   placeholder="ex: 0694455666"/>
                                            <label class="form-label" for="telephone">Telephone</label>
                                        </div>


                                        <div class="form-outline mb-4">
                                            <input type="password" name="new_password"
                                                   class="form-control form-control-lg"/>
                                            <label class="form-label" for="new_password">Password</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="c_password"
                                                   class="form-control form-control-lg"/>
                                            <label class="form-label" for="c_password">Repeat your password</label>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="terms" required/>
                                            <label class="form-check-label" for="terms">
                                                I agree all statements in <a href="#" class="text-body"><u>Terms of
                                                        service</u></a>
                                            </label>
                                        </div>
                                        <label class="form-label" for="error">
                                            <?php echo $error ?></label>
                                        <div class="d-flex justify-content-center">
                                            <input type="submit" value="Register"
                                                   class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                        </div>


                                        <p class="text-center text-muted mt-5 mb-0">Have already an account? <a
                                                    href="login.php"
                                                    class="fw-bold text-body"><u>Login here</u></a></p>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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