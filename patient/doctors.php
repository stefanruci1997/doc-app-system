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
                <li><a class="nav-link scrollto active" href="doctors.php">Doctors</a></li>
                <li><a class="nav-link scrollto" href="appointment.php">Appointment</a></li>
                <li><a class="nav-link scrollto" href="settings.php">Settings </a></li>

                <li><a href="../services/logout.php"><input type="button" value="Log out"
                                                            class="logout-btn btn-primary-soft btn"></a>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->

<section>
    <div class="container w-100 h-auto  m-5 d-grid">


        <div class="row ">
            <div class="col-12">

                <p class="heading-main12" style=" margin-top:70px;margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Doctors
                    (<?php
                                                $list11 = $database->query("select  name,email from  doctor;");

                    
                    echo $list11->num_rows; ?>)</p>

            </div>
        </div>


        <div class="row search-div">
            <div class="col-8 text-center">
                <div class="search">


                    <form action="" method="post">

                        <input type="search" name="search" class="input-text header-searchbar"
                               placeholder="Search Doctor name or Email" list="doctors">&nbsp;&nbsp;

                        <?php


                        include("../db/dbconfig.php");

                        echo '<datalist id="doctors">';
                        $list11 = $database->query("select  name,email from  doctor;");

                        for ($y = 0; $y < $list11->num_rows; $y++) {
                            $row00 = $list11->fetch_assoc();
                            $d = $row00["name"];
                            $c = $row00["email"];
                            echo "<option value='$d'><br/>";
                            echo "<option value='$c'><br/>";
                        };

                        echo ' </datalist>';
                        ?>


                        <input type="Submit" value="Search" class="login-btn btn-primary btn"
                               style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                    </form>
                    <br>

                </div>

                <?php
                if ($_POST) {
                    $keyword = $_POST["search"];

                    $sqlmain = "select * from doctor where email='$keyword' or name='$keyword' or name like '$keyword%' or name like '%$keyword' or name like '%$keyword%'";
                } else {
                    $sqlmain = "select * from doctor order by doc_id desc";

                }


                ?>

                <div class="row ">

                    <div class="col ">


                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0">
                                <thead>
                                <tr>
                                    <th class="table-headin">


                                        Doctor Name

                                    </th>
                                    <th class="table-headin">
                                        Email
                                    </th>
                                    <th class="table-headin">

                                        Specialties

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
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../assets/img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="doctors.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';

                                } else {
                                    for ($x = 0; $x < $result->num_rows; $x++) {
                                        $row = $result->fetch_assoc();
                                        $docid = $row["doc_id"];
                                        $name = $row["name"];
                                        $email = $row["email"];
                                        $spe = $row["specialties"];

                                        $spcil_res = $database->query("select sname from specialties where id='$spe'");
                                        $spcil_array = $spcil_res->fetch_assoc();
                                        $spcil_name = $spcil_array["sname"];


//                                    $spcil_res = $database->query("select sname from specialties where name='$spe'");
//                                    $spcil_array = $spcil_res->fetch_assoc();
//                                    $spcil_name = $spcil_array["sname"];
                                        echo '<tr>
                                        <td> &nbsp;' .
                                            substr($name, 0, 30)
                                            . '</td>
                                        <td>
                                        ' . substr($email, 0, 20) . '
                                        </td>
                                        <td>
                                            ' . substr($spcil_name, 0, 20) . '
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        <a href="booking.php?id=' . $docid . '&error=0" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Book</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="?action=view&id=' . $docid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                        </div>
                                        </td>
                                    </tr>';

                                    }
                                }

                                ?>

                                </tbody>

                            </table>
                        </div>
                    </div>


                </div>
            </div>


            <?php
            if ($_GET) {
                $id = $_GET["id"];
                $action = $_GET["action"];
                if ($action == 'view') {
                    $result = $database->query($sqlmain);
                    $row = $result->fetch_assoc();
                    $name = $row["name"];
                    $email = $row["email"];
                    $spe = $row["specialties"];
                    $surname = $row["surname"];
                    $address = $row["address"];
                    $spcil_name = $spe;
                    $clinic = $row['doclinic'];
                    $tele = $row['telephone'];
                    $dep = $row['department'];
                    $fb = $row['facebook'];
                    $ig = $row['instagram'];
                    $county = $row['country'];
                    $city = $row['city'];


                    echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            Doc-Alb Web App<br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $name . '<br><br>
                                </td>
                                
                            </tr>  
                                <tr>
                          
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Surname: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $surname . '<br><br>
                            </td>
                            </tr>  
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $email . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Clinic: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $clinic . '<br><br>
                                </td>
                            </tr>    
                                  
                                  <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Speciality: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $spcil_name . '<br><br>
                                </td>
                            </tr>
                            
                            
                            
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $tele . '<br><br>
                                </td>
                            </tr>
                          
                          
                          
                          
                      
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Address: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $address . '  , ' . $city . ' , ' . $county . '   <br><br>
                            </td>
                            </tr> 
                         
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
                }
//        elseif ($action == 'book') {
//            $sqlmain = "select * from doctor where doc_id='$id'";
//            $result = $database->query($sqlmain);
//            $row = $result->fetch_assoc();
//            $name = $row["name"];
//            $email = $row["email"];
//            $spe = $row["specialties"];
//            $surname = $row["surname"];
//            $address = $row["address"];
//            $spcil_name = $spe;
//            $clinic = $row['doclinic'];
//            $tele = $row['telephone'];
//            $dep = $row['telephone'];
//            $fb = $row['facebook'];
//            $ig = $row['instagram'];
//
//            $error_1 = $_GET["error"];
//            $errorlist = array(
//                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
//                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
//                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
//                '4' => "",
//                '0' => '',
//
//            );
//
//            if ($error_1 != '4') {
//                echo '
//                    <div id="popup1" class="overlay">
//                            <div class="popup">
//                            <center>
//                            <h1>  Book Doctor  Todo</h1>
//                                <a class="close" href="doctors.php">&times;</a>
//                                <div style="display: flex;justify-content: center;">
//                                <div class="abc">
//                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
//                                <tr>
//                                        <td class="label-td" colspan="2">' .
//                    $errorlist[$error_1]
//                    . '</td>
//                                    </tr>
//                                    <tr>
//                                        <td>
//                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Doctor Details.</p>
//                                        Doctor ID : ' . $id . ' (Auto Generated)<br><br>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <form action="edit-doc.php" method="POST" class="add-new-form">
//                                            <label for="Email" class="form-label">Email: </label>
//                                            <input type="hidden" value="' . $id . '" name="id00">
//                                            <input type="hidden" name="oldemail" value="' . $email . '" >
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                        <input type="email" name="email" class="input-text" placeholder="Email Address" value="' . $email . '" required><br>
//                                        </td>
//                                    </tr>
//                                    <tr>
//
//                                        <td class="label-td" colspan="2">
//                                            <label for="name" class="form-label">Name: </label>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <input type="text" name="name" class="input-text" placeholder="Doctor Name" value="' . $name . '" required><br>
//                                        </td>
//
//                                    </tr>
//
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <label for="nic" class="form-label">NIC: </label>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <input type="text" name="nic" class="input-text" placeholder="NIC Number" value="' . $clinic . '" required><br>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <label for="Tele" class="form-label">Telephone: </label>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="' . $tele . '" required><br>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <label for="spec" class="form-label">Choose specialties: (Current' . $spcil_name . ')</label>
//
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <select name="spec" id="" class="box">';
//
//
//                $list11 = $database->query("select  * from  specialties;");
//
//                for ($y = 0; $y < $list11->num_rows; $y++) {
//                    $row00 = $list11->fetch_assoc();
//                    $sn = $row00["sname"];
//                    $id00 = $row00["id"];
//                    echo "<option value=" . $id00 . ">$sn</option><br/>";
//                };
//
//
//                echo '       </select><br><br>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <label for="password" class="form-label">Password: </label>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <input type="password" name="password" class="input-text" placeholder="Defind a Password" ><br>
//                                        </td>
//                                    </tr><tr>
//                                        <td class="label-td" colspan="2">
//                                            <label for="cpassword" class="form-label">Confirm Password: </label>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td class="label-td" colspan="2">
//                                            <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" ><br>
//                                        </td>
//                                    </tr>
//
//
//                                    <tr>
//                                        <td colspan="2">
//                                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
//
//                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
//                                        </td>
//
//                                    </tr>
//
//                                    </form>
//                                    </tr>
//                                </table>
//                                </div>
//                                </div>
//                            </center>
//                            <br><br>
//                    </div>
//                    </div>
//                    ';
//            } else {
//                echo '
//                <div id="popup1" class="overlay">
//                        <div class="popup">
//                        <center>
//                        <br><br><br><br>
//                            <h2>Edit Successfully!</h2>
//                            <a class="close" href="doctors.php">&times;</a>
//                            <div class="content">
//
//
//                            </div>
//                            <div style="display: flex;justify-content: center;">
//
//                            <a href="doctors.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
//
//                            </div>
//                            <br><br>
//                        </center>
//                </div>
//                </div>
//    ';
//
//
//            };
//        };
            };

            ?>

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



