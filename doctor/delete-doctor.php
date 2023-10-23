<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
        header("location: ../login.php");
    }

} else {
    header("location: ../login.php");
}


if ($_GET) {
    //import database
    include("../db/dbconfig.php");
    $id = $_GET["id"];




    $result001 = $database->query("select * from doctor where doc_id=$id;");
    $email = ($result001->fetch_assoc())["email"];
    $sql = $database->query("delete from user where email='$email';");
    $sql = $database->query("delete from doctor where email='$email';");
    //print_r($email);

    $myappointments = $database->query("select * from appointment ");

    while($myappointments->fetch_assoc()){
        deleteDoctorById($id);
    
    
    }
    
 
      

    header("location: ../index.php");
}
   function deleteDoctorById($id) {
        // Assuming you have a database connection established
        include("../db/dbconfig.php");
    
        // Escape the id to prevent SQL injection
        $sql = $database->query("delete  from appointment where doc_id=$id;");
      }

?>