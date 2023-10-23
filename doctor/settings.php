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
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
        header("location: ../pages/login.php");
    }

} else {
    header("location: ../pages/login.php");
}

include('../db/dbconfig.php')
?>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            &nbsp &nbsp
            <i class="bi bi-person-circle"></i> Doctor Page &nbsp &nbsp
            <i class="bi bi-envelope-at"></i> <?php echo $_SESSION['user'];
            ?> <i class="bi bi-phone"></i> +355 224 554 55
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


<?php
$email = $_SESSION["user"];
$sql = "SELECT * FROM doctor where email='$email';";
$result = $database->query($sql);
$row = $result->fetch_assoc();
$id = $row["doc_id"];
$name = $row["name"];
$surname = $row["surname"];
$email = $row["email"];
$tel = $row["telephone"];
$address = $row["address"];
$city = $row["city"];
$specialties_id = $row["specialties"];
$result = $database->query("SELECT * FROM specialties where id='$specialties_id';");
$specialties = $result->fetch_assoc()["sname"];
$doclinic = $row["doclinic"];

?>
<section>
    <div class="container d-grid    w-25" style="margin-top:100px ">
        <div class="row">
            <div class="col-12">
                <h3> My information (ID: <?php echo $id; ?>) </h3>
            </div>
        </div>


        <form action="edit-settings.php" method="POST" class="add-new-form">

            <input type="hidden" name="oldemail" value="<?php echo $email ?>">

            <div class="form-outline mb-4">
                <input type="text" name="name" class="form-control form-control-lg" value="<?php echo $name ?>"/>
                <label class="form-label" for="name">Your Name</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" name="surname" class="form-control form-control-lg" value="<?php echo $surname ?>"/>
                <label class="form-label" for="surname">Your Surname</label>
            </div>

            <div class="form-outline mb-4">
                <input type="email" name="email" value="<?php echo $email ?>" class="form-control form-control-lg"/>
                <label class="form-label" for="email">Your Email</label>
            </div>


            <div class="form-outline mb-4">

            <select name="specialties" id="" class="box form-control form-control-lg form-select">';
                <?php


                echo "<option value=" . $specialties_id . " selected >$specialties</option><br/>";

                $list11 = $database->query("select  * from  specialties;");

                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $sn = $row00["sname"];
                    $id00 = $row00["id"];
                    echo "<option value=" . $id00 . ">$sn</option><br/>";
                };


                ?>
            </select>
            </div>

                <label class="form-label" for="specialties">Your specialities</label>

                <br>
                <br>
                <div class="form-outline mb-4">
                    <input type="text" name="doclinic" class="form-control form-control-lg"
                           value="<?php echo $doclinic ?>"/>
                    <label class="form-label" for="doclinic">Your Clinic</label>
                </div>
                <div class="form-outline mb-4">
                    <input type="text" name="address" class="form-control form-control-lg"
                           value="<?php echo $address ?>"/>
                    <label class="form-label" for="address">Your address</label>
                </div>



                <div class="form-outline mb-4">
                    <input type="text" name="city" class="form-control form-control-lg" value="<?php echo $city ?>"/>
                    <label class="form-label" for="city">City</label>
                </div>
                <div class="form-outline mb-4">
                    <input type="tel" name="telephone" class="form-control form-control-lg"
                           placeholder="ex: 0694455666" value="<?php echo $tel ?>"/>
                    <label class="form-label" for="telephone">Telephone</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="password"
                           class="form-control form-control-lg"/>
                    <label class="form-label" for="new_password">Password</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="cpassword"
                           class="form-control form-control-lg"/>
                    <label class="form-label" for="c_password">Repeat your password</label>
                </div>


                <input type="reset" value="Reset"
                       class="login-btn btn-primary-soft btn">&nbsp;
                <input type="submit" value="Save"
                       class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
        </form>

        <a href="?action=drop&id=' <?php  echo  $id?> .'" class="non-style-link"><button  class="btn btn-danger btn-block btn-lg gradient-custom-4 text-body btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Delete my account</font></button></a>

        <?php
        if ($_GET) {
            $id = $_GET["id"];
            $action = $_GET["action"];
            if ($action == 'drop') {
                echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            You want to delete your account?
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-doctor.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
            }

        }
            ?>
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



