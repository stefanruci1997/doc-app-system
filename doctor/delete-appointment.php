<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    }

} else {
    header("location: ../login.php");
}


if ($_GET) {
    //import database
    include("../db/dbconfig.php");
    $id = $_GET["id"];
 ;
    $sql = $database->query("delete  from appointment where app_id=$id;");
    //print_r($email);
    header("location: appointment.php");
}


?>