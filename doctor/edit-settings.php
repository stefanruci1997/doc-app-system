<?php
include("../db/dbconfig.php");

global $database;

if ($_POST) {
    $oldemail = $_POST["oldemail"];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST["email"];
    $tel = $_POST['telephone'];
    $specialties = $_POST['specialties'];
    $doclinic = $_POST['doclinic'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];


    if ($password == $cpassword && $cpassword != "") {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Update with password
        $sql1 = "UPDATE doctor SET name=?, surname=?, email=?, address=?, city=?, telephone=?, password=?,  specialties=?, doclinic=?  WHERE email=?";
        $stmt1 = $database->prepare($sql1);

        if ($stmt1) {
            $stmt1->bind_param("ssssssssss", $name, $surname, $email, $address, $city, $tel, $hashedPassword,$specialties,$doclinic, $oldemail);
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
        $sql1 = "UPDATE doctor SET name=?, surname=?, email=?, address=?,  city=?, telephone=?,  specialties=?, doclinic=?  WHERE email=?";
        $stmt1 = $database->prepare($sql1);

        if ($stmt1) {
            $stmt1->bind_param("sssssssss", $name, $surname, $email, $address, $city, $tel,$specialties,$doclinic, $oldemail);
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
