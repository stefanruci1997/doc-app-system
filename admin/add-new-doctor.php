<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Doctor</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>
<?php

//learn from w3schools.com

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
    }

} else {
    header("location: ../login.php");
}


//import database
include("../db/dbconfig.php");


if ($_POST) {
    //print_r($_POST);
    $result = $database->query("select * from user");
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $clinic = $_POST['clinic'];
    $email = $_POST['email'];
    $spec = $_POST['spec'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $tele = $_POST['Tele'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];


    if ($password == $cpassword) {
        $result = $database->query("select * from user where email='$email';");
        if ($result->num_rows == 1) {
            $error = '1';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql2 = "insert into user values('$email','d')";

            $sql = "INSERT INTO doctor (email, doclinic, password, name, surname, address, specialties, telephone,  city) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $database->prepare($sql);
            $stmt->bind_param("sssssssss", $email, $clinic, $hashedPassword, $name, $surname, $address, $spec, $tele, $city);

            if ($stmt->execute()) {
                echo "Data inserted successfully!";
            } else {
                echo "Error inserting data: " . $stmt->error;
            }



//            $database->query($sql1);
            $database->query($sql2);
            $stmt->close();

            $database->close();

            //echo $sql1;
            //echo $sql2;

        }

    }


} else {
    //header('location: signup.php');
    $error = '3';
}


header("location: doctors.php?action=add&error=" . $error);
?>


</body>
</html>