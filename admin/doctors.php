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
            <a href="https://instagram.com/docalb.al?igshid=MmJiY2I4NDBkZg==" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/in/diun-olla-192685279" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
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
                <li><a class="nav-link scrollto" href="patient.php">Patients </a></li>
                <li><a class="nav-link scrollto" href="settings.php">Settings </a></li>

                <li><a href="../services/logout.php"><input type="button" value="Log out"
                                                            class="logout-btn btn-primary-soft btn"></a>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->


<main>

    <section>
        <div class="container w-100 h-auto d-grid">

            <div class="row search-div">
                <div class="col-8 text-center">
                    <div class="search">


                        <form action="" method="post">

                            <input type="search" name="search" class="input-text header-searchbar"
                                   placeholder="Search Doctor name or Email" list="doctors">&nbsp;&nbsp;

                            <?php
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
                </div>
                <div class="col-4 text-center">
                    <a href="?action=add&id=none&error=0" class="non-style-link">
                        <button class="login-btn btn-primary btn button-icon"
                                style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">
                            Add New</font></button>
                    </a>

                </div>
            </div>
            <div class="row ">
                <div class="col">

                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Doctors
                        (<?php echo $list11->num_rows; ?>)</p>

                </div>
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

                                    City

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
                                    $city = $row["city"];
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
                                        $name
                                        . '</td>
                                        <td>
                                        ' . $email . '
                                        </td>
                                        <td>
                                            ' . $spcil_name . '
                                        </td>   
                                             <td>
                                            ' . $city . '
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        <a href="?action=edit&id=' . $docid . '&error=0" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Edit</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="?action=view&id=' . $docid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id=' . $docid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Remove</font></button></a>
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
            if ($action == 'drop') {
                $nameget = $_GET["name"];
                echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>(' . substr($id, 0, 40) . ').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-doctor.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="doctors.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
            }
            elseif ($action == 'view') {
                $result = $database->query($sqlmain);
                $row = $result->fetch_assoc();
                $name = $row["name"];
                $email = $row["email"];
                $spe = $row["specialties"];
                $surname = $row["surname"];


                $address = $row["address"];

                $spcil_name =  $database->query("select sname from specialties where id='$spe'")->fetch_assoc()['sname'];
                $clinic = $row['doclinic'];
                $tele = $row['telephone'];
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
        <table width="80%" class="sub-table scrolldown add-doc-form-container" ">
                        
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
        ' . $address . '  , ' . $city . '    <br><br>
        </td>
        </tr> 
     
     
       

    </table>
      </div>
    </center>
    <br><br>
  </div>
</div>'

            
            
            
            ;
            }
            elseif ($action == 'add') {
                $error_1 = $_GET["error"];
                $errorlist = array(
                    '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                    '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                    '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                    '4' => "",
                    '0' => '',

                );
                if ($error_1 != '4') {
                    echo '
            <div id="popup1" class="overlay">
                    <div class="popup overflow-scroll">
                    <center>
                    
                        <a class="close" href="doctors.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">' .
                        $errorlist[$error_1]
                        . '</td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Doctor.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <form action="add-new-doctor.php" method="POST" class="add-new-form">
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label ">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text form-control form-control-lg" placeholder="Doctor Name" required><br>
                                </td>
                                
                            </tr>
                            
                               <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="surname" class="input-text form-control form-control-lg" placeholder="Doctor Surname" required><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="email" name="email" class="input-text form-control form-control-lg" placeholder="Email Address" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Clinic: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="clinic" class="input-text form-control form-control-lg" placeholder="Clinic" required><br>
                                </td>
                            </tr>
                          
                            
                                  <tr>
                                <td class="label-td" colspan="2">
                                    <label for="dep" class="form-label">Contacts: </label>
                                </td>
                            </tr>
                            
                       
                         
                                    <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="address" class="input-text form-control form-control-lg" placeholder="address ps:	
123 Main Street" required><br>
                                </td>
                                
                            </tr>
                            
                            
                           
                            
                               <tr>
                                <td class="label-td" colspan="2">
                                
                                
            <div class="form-outline mb-4">

                <select name="city"  class="box form-control form-control-lg form-select ">
                        <option value="Tirane">Tirane</option>
                        <option value="Durres">Durres</option>
                        <option value="Elbasan">Elbasan</option>
                        <option value="Fier">Fier</option>
                        <option value="Vlore">Vlore</option>
                        <option value="Shkoder">Shkoder</option>
                        <option value="-" selected>------all cities--------</option>
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
                                
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="Tele" class="input-text form-control form-control-lg" placeholder="Telephone Number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Choose specialties: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="spec" id="" class="box box form-control form-control-lg form-select" >';


                    $list11 = $database->query("select  * from  specialties order by sname asc;");

                    for ($y = 0; $y < $list11->num_rows; $y++) {
                        $row00 = $list11->fetch_assoc();
                        $sn = $row00["sname"];
                        $id00 = $row00["id"];
                        echo "<option value=" . $id00 . ">$sn</option><br/>";
                    };


                    echo '       </select><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="password" class="form-label">Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="password" class="input-text form-control form-control-lg " placeholder="Defind a Password" required><br>
                                </td>
                            </tr><tr>
                                <td class="label-td" colspan="2">
                                    <label for="cpassword" class="form-label">Confirm Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="cpassword" class="input-text form-control form-control-lg" placeholder="Confirm Password" required><br>
                                </td>
                            </tr>
                            
                
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                                  
   <input type="submit" name="submit-btn"  value="Add" class="login-btn btn-primary btn btn-block btn-lg gradient-custom-4 text-body">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';

                }
                else {
                    echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            <br><br><br><br>
                                <h2>New Record Added Successfully!</h2>
                                <a class="close" href="doctors.php">&times;</a>
                                <div class="content">
                                    
                                    
                                </div>
                                <div style="display: flex;justify-content: center;">
                                
                                <a href="doctors.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                                </div>
                                <br><br>
                            </center>
                    </div>
                    </div>
        ';
                }

                if (isset($_POST)){
                    header("location: ?action=add&error=4");
                }
            }
            elseif ($action == 'edit') {
                $sqlmain = "select * from doctor where doc_id='$id'";
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
                $dep = $row['telephone'];
            

                $error_1 = $_GET["error"];
                $errorlist = array(
                    '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                    '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                    '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                    '4' => "",
                    '0' => '',

                );

                if ($error_1 != '4') {
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
                          <table width="80%" class="sub-table scrolldown add-doc-form-container" "><tr>
                                        <td class="label-td" colspan="2">' .
                        $errorlist[$error_1]
                        . '</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Doctor Details.</p>
                                        Doctor ID : ' . $id . ' (Auto Generated)<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-doc.php" method="POST" class="add-new-form">
                                            <label for="Email" class="form-label">Email: </label>
                                            <input type="hidden" value="' . $id . '" name="id00">
                                            <input type="hidden" name="oldemail" value="' . $email . '" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="email" name="email" class="input-text" placeholder="Email Address" value="' . $email . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="name" class="input-text" placeholder="Doctor Name" value="' . $name . '" required><br>
                                        </td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="nic" class="form-label">NIC: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="nic" class="input-text" placeholder="NIC Number" value="' . $clinic . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Telephone: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="' . $tele . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">Choose specialties: (Current' . $spcil_name . ')</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="spec" id="" class="box">';


                    $list11 = $database->query("select  * from  specialties;");

                    for ($y = 0; $y < $list11->num_rows; $y++) {
                        $row00 = $list11->fetch_assoc();
                        $sn = $row00["sname"];
                        $id00 = $row00["id"];
                        echo "<option value=" . $id00 . ">$sn</option><br/>";
                    };


                    echo '       </select><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="password" class="form-label">Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="password" class="input-text" placeholder="Defind a Password" ><br>
                                        </td>
                                    </tr><tr>
                                        <td class="label-td" colspan="2">
                                            <label for="cpassword" class="form-label">Confirm Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" ><br>
                                        </td>
                                    </tr>
                                    
                        
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
                                        </td>
                        
                                    </tr>
                                
                                    </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                            </center>
                            <br><br>
                    </div>
                    </div>
                    ';
                } else {
                    echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>Edit Successfully!</h2>
                            <a class="close" href="doctors.php">&times;</a>
                            <div class="content">
                                
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="doctors.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';


                };
            };
        };

        ?>

    </section>
</main>
<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


<?php
include("../pages/footer.php");
?>
<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>

<!-- Vendor JS Files -->
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

</body>

</html>



