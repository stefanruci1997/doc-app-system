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
include("../db/dbconfig.php");


?>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            &nbsp &nbsp
            <i class="bi bi-person-circle"></i> Doctor Page &nbsp &nbsp
            <i class="bi bi-envelope-at"></i> <?php echo $_SESSION['user'];
            ?>
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
                <li><a class="nav-link scrollto" href="appointment.php">Appointments</a></li>
                <li><a class="nav-link scrollto active" href="patient.php">Patients </a></li>
                <li><a class="nav-link scrollto" href="settings.php">Settings </a></li>

                <li><a href="../services/logout.php"><input type="button" value="Log out"
                                                            class="logout-btn btn-primary-soft btn"></a>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->

<section  class="my-patients">
    <div class="container w-100 h-auto d-grid">

        <div class="row search-div">
            <div class="col-8 text-center">
                <div class="search">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My Patients
                        (<?php

$email= $_SESSION["user"];
$doc_id=  $database->query("select  doc_id from  doctor where email= '$email';")->fetch_assoc()["doc_id"];

$list11 = $database->query("select patient.* from patient JOIN appointment ON appointment.pid=patient.pid where doc_id='$doc_id';");



                        // $id = $database->query("select  * from  doctor where email='$_SESSION[user]';")->fetch_assoc()["doc_id"];

                        // $list11 = $database->query("SELECT DISTINCT patient.*
                        //    FROM patient
                        //    JOIN appointment ON appointment.pid = patient.pid
                        //    WHERE appointment.doc_id='$id'");

                        echo $list11->num_rows; ?>)</p>
                    <form action="" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar"
                               placeholder="Search Patient name or Email" list="patient">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="patient">';

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

                </div>
            </div>
        </div>
        <div class="row search-div">


            <?php
            if ($_POST) {
                $keyword = $_POST["search"];

                $sqlmain = "select patient.* from patient JOIN appointment ON appointment.pid=patient.pid where doc_id='$doc_id' and email='$keyword' or name='$keyword' or name like '$keyword%' or name like '%$keyword' or name like '%$keyword%' ";
            } else {
                $sqlmain = "select patient.* from patient JOIN appointment ON appointment.pid=patient.pid where doc_id='$doc_id';";

            }?>
        </div>

        <div class="row search-div">

            <div class="abc scroll">
                <table width="93%" class="sub-table scrolldown" style="border-spacing:0;">
                    <thead>
                    <tr>
                        <th class="table-headin">


                            Name

                        </th>
                        <th class="table-headin">


                            Surname

                        </th>

                        <th class="table-headin">
                            Email
                        </th>
                        <th class="table-headin">


                            Telephone

                        </th>
                        <th class="table-headin">


                            Address

                        </th>
                        <th class="table-headin">


                            Registration Date

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
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';

                    } else {
                        for ($x = 0; $x < $result->num_rows; $x++) {
                            $row = $result->fetch_assoc();
                            $pid = $row["pid"];
                            $name = $row["name"];
                            $surname = $row["surname"];
                            $email = $row["email"];
                            $tel = $row["ptel"];
                            $address = $row["address"];
                            $city= $row["city"];
                            $country= $row["country"];
                            $reg_date= $row["reg_date"];


                            echo '<tr>
                                        <td> &nbsp;' .
                                substr($name, 0, 35)
                                . '</td>
                                        <td>
                                        ' . substr($surname, 0, 20) . '
                                        </td>
                                     
                                        <td>
                                        ' . substr($email, 0, 20) . '
                                         </td> 
                                           <td>
                                            ' . substr($tel, 0, 20) . '
                                        </td>
                                        <td>
                                        ' . $address . ', ' . $city . ', ' . $country . '
                                        </td>
                                           <td>
                                        ' . $reg_date . '
                                        </td>
                                        <td >
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id=' . $pid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                       
                                        </div>
                                        </td>
                                    </tr>';

                        }
                    }

                    ?>

                    <?php
                    if ($_GET) {

                        $id = $_GET["id"];
                        $action = $_GET["action"];



                        if ($action == 'view') {


                            $sqlmain = "select * from patient where pid='$id'";
                            $result1 = $database->query($sqlmain);
                            $row = $result1->fetch_assoc();
                            $name = $row["name"];
                            $surname = $row["surname"];
                            $email = $row["email"];
                            $tel = $row["ptel"];
                            $address = $row["address"];
                            $city= $row["city"];
                            $country= $row["country"];
                            $reg_date= $row["reg_date"];



                            echo '  <div class=" popup overlay-75 border border-primary ">
 
                    <div class=" h-auto">
                    <center>
                        <a class="close" href="patient.php">&times;</a>

                        <div style="display: flex;justify-content: center;" class=" container d-grid h-auto">         
                           <div width="80%" class="row" >
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                          </div>
                            <div width="80%" class="row>
                                    <label for="name" class="form-label">Patient ID: </label>
                          </div>
                           <div width="80%" class="row" >
                              <div width="80%" class="col-12" >

                                    Pid-' . $id . '<br><br>
                          </div></div>
                            
                           <div  width="80%" class="row" >
                                                      <div width="80%" class="col-12" >


                                    <label for="name" class="form-label">Name: </label>
                         </div></div>
                         
                            <div width="80%" class="row" >                           <div width="80%" class="col-12" >


                                    ' . $name . '    ' . $surname . '<br><br>
                          </div>              
</div>
                          
                       
                            <div width="80%" class="row" >
                           <div width="80%" class="col-12" >


                                    <label for="Email" class="form-label">Email: </label>
                            </div></div>
                          
                            <div width="80%" class="row" >                           <div width="80%" class="col-12" >


                                ' . $email . '<br><br>
                          </div></div>
                         
                   
                              <div width="80%" class="row" >                           <div width="80%" class="col-12" >


                                    <label for="Tele" class="form-label">Telephone: </label>
                              </div></div>
                              <div width="80%" class="row" >                           <div width="80%" class="col-12" >


                                ' . $tel . '<br><br>
                            </div></div>
                          <div width="80%" class="row" >                           <div width="80%" class="col-12" >


                                    <label for="spec" class="form-label">Address: </label>
                        </div></div>
                           <div width="80%" class="row" >                           <div width="80%" class="col-12" >


                            ' . $address . ' , ' . $city . ' , ' . $country . '<br><br></div>
                     </div>
                                                                                      <div width="80%" class="row" >

                                    <label for="name" class="form-label">Registration Date: </label>
                          </div>
                             <div width="80%" class="row" >                           <div width="80%" class="col-12" >


                                    ' . $reg_date . '<br><br></div>
                         </div>
                                 <div width="80%" class="row" >                           <div width="80%" class="col-12" >


                                    <a href="patient.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                           </div>
                                </div>
                          
                             </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
                        }
                        elseif ($action == 'drop')
                        {
                            $nameget = $_GET["name"];
                            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>(' . substr($nameget, 0, 40) . ').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-patient.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="patient.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

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



