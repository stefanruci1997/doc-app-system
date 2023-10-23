<?php
include("../db/dbconfig.php");


if ($_POST) {


    $doc_id = $_POST['doc_id'];
    $pid = $_POST['pid'];
    $date = $_POST['date'];
    $time = $_POST['time'];

// Your insert query
    $sql = "INSERT INTO appointment (doc_id,pid,date,s_time) VALUES (?,?,?,?)";

// Prepare the query
    $stmt = $database->prepare($sql);

// Bind the parameters
    $stmt->bind_param("ssss", $doc_id,$pid,$date,$time);


// Execute the query
    $result = $stmt->execute();

// Check if the insert was successful
    if ($result) {
        // Insertion successful
        echo "<center><h1>Appointment booked  successfully.</h1> <a href='appointment.php' ><button class='btn-success'>OK</button></a></center>";


    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }

// Close the statement
    $stmt->close();



}

?>
