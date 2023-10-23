<?php
include("../db/dbconfig.php");


if ($_POST) {

    $email=$_POST["email"];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $oldemail = $_POST["oldemail"];



    if ($password == $cpassword and $cpassword!="" ) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $sql1 = "update admin set email='$email',password='$password' where email=$oldemail ;";
            $database->query($sql1);
            $sql2 = "update user set email='$email' where email='$oldemail' ;";
            $database->query($sql2);

            $error = '4';}
        else{

            $sql1 = "update admin set email='$email' where email=$oldemail ;";
            $database->query($sql1);
            $sql2 = "update user set email='$email' where email='$oldemail' ;";
            $database->query($sql2);
        }
        header("location: doctors.php");
    }
?>


?>
