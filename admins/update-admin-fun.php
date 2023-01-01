<?php
    if(isset($_POST['save'])){
        include_once("../database/Database.php");
        include_once("../models/Registration.php");
        $update         = $_POST['update'];
        $first_name     = $_POST['first_name'];
        $last_name      = $_POST['last_name'];
        $email_address  = $_POST['email_address'];
        $phone_number   = $_POST['phone_number'];

        $conn = new Database();
        $db   = $conn -> connection();
        $user = new Registration($db);
        $user -> Fname = $first_name;
        $user -> Lname = $last_name;
        $user -> Email = $email_address;
        $user -> Phone = $phone_number;
        if(empty($_POST['password']) || $_POST['password'] == ""){
            $user -> Password = "";
        }else{
            $user -> Password = $password;
        }
        $user -> update = $update;
        $save = $user -> updateUser();
        if($save){
            header("Location: update-admins.php?edit={$update}&success=Account updated successfully.");
        }else{
            header("Location: update-admins.php?edit={$update}&error=Oops! something went wrong, please try again.");
        }
    }
?>