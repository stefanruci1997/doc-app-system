<?php
include("../db/dbconfig.php");

global $database;

if ($_POST) {

    $email = $_POST["email"];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $tel = $_POST['telephone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $oldemail = $_POST["oldemail"];


    if ($password == $cpassword && $cpassword != "") {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Update with password
        $sql1 = "UPDATE patient SET name=?, surname=?, email=?, address=?, country=?, city=?, ptel=?, password=? WHERE email=?";
        $stmt1 = $database->prepare($sql1);

        if ($stmt1) {
            $stmt1->bind_param("sssssssss", $name, $surname, $email, $address, $country, $city, $tel, $hashedPassword, $oldemail);
            $stmt1->execute();

            $sql2 = "UPDATE user SET email=? WHERE email=?";
            $stmt2 = $database->prepare($sql2);

            if ($stmt2) {
                $stmt2->bind_param("ss", $email, $oldemail);
                $stmt2->execute();
                $stmt2->close();
            } else {
                echo "Error preparing user update statement: " . $database->error;
            }

            $stmt1->close();
        } else {
            echo "Error preparing patient update statement: " . $database->error;
        }

    } else {
        $sql1 = "UPDATE patient SET name=?, surname=?, email=?, address=?, city=?, ptel=? WHERE email=?";
        $stmt1 = $database->prepare($sql1);

        if ($stmt1) {
            $stmt1->bind_param("sssssss", $name, $surname, $email, $address,  $city, $tel, $oldemail);
            $stmt1->execute();

            $sql2 = "UPDATE user SET email=? WHERE email=?";
            $stmt2 = $database->prepare($sql2);

            if ($stmt2) {
                $stmt2->bind_param("ss", $email, $oldemail);
                $stmt2->execute();
                $stmt2->close();
            } else {
                echo "Error preparing user update statement: " . $database->error;
            }

            $stmt1->close();
        } else {
            echo "Error preparing patient update statement: " . $database->error;
        }

    }


    header("location: settings.php");
}
?>


?>
