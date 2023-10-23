<?php


//import database
include("../db/dbconfig.php");


if ($_POST) {
    //print_r($_POST);
    $result = $database->query("select * from user");
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $oldemail = $_POST["oldemail"];
    $spec = $_POST['spec'];
    $email = $_POST['email'];
    $tele = $_POST['Tele'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $id = $_POST['id00'];
    if ($password == $cpassword) {
//        $error = '3';
//        $result = $database->query("select doctor.doc_id from doctor inner join user on doctor.email=user.email where user.email='$email';");
//        //$resultqq= $database->query("select * from doctor where docid='$id';");
//        if ($result->num_rows == 1) {
//            $id2 = $result->fetch_assoc()["doc_id"];
//        } else {
//            $id2 = $id;
//        }
//
//        echo $id2 . "jdfjdfdh";
//        if ($id2 != $id) {
//            $error = '1';
//
//        } else {

            if($password!=""){

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



                //$sql1="insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
            $sql1 = "update doctor set email='$email',name='$name',password='$hashedPassword',doclinic='$nic',telephone='$tele',specialties=$spec where doc_id=$id ;";
            $database->query($sql1);

            $sql1 = "update user set email='$email' where email='$oldemail' ;";
            $database->query($sql1);
            //echo $sql1;
            //echo $sql2;
            $error = '4';}
            else{
                $sql1 = "update doctor set email='$email',name='$name',doclinic='$nic',telephone='$tele',specialties=$spec where doc_id=$id ;";
                $database->query($sql1);

                $sql1 = "update user set email='$email' where email='$oldemail' ;";
                $database->query($sql1);
            }
            header("location: doctors.php");
//        }

    }
    else {
        $error = '2';

 }

} else {
    //header('location: signup.php');
    $error = '3';
}


//header("location: doctors.php?action=edit&error=" . $error . "&id=" . $id);
//?>


</body>
</html>