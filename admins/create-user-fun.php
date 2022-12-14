<?php
    if(isset($_POST['save'])){
        
        include_once("../database/Database.php");
        include_once("../models/Registration.php");
        $first_name     = $_POST['first_name'];
        $last_name      = $_POST['last_name'];
        $email_address  = $_POST['email_address'];
        $phone_number   = $_POST['phone_number'];
        $password       = $_POST['password'];

        // echo $password;
        $conn = new Database();
        $db   = $conn -> connection();
        $user = new Registration($db);
        $user -> Fname = $first_name;
        $user -> Lname = $last_name;
        $user -> Email = $email_address;
        $user -> Phone = $phone_number;
        $user -> Password = $password;
        $save = $user -> saveUser();
        if($save){
            header("Location: create-admins.php?success=Account created successfully.");
        }else{
            header("Location: create-admins.php?error=Oops! something went wrong, please try again.");
        }
    }
?>