<?php
    if(isset($_POST['username'])){
        include_once("database/Database.php");
        include_once("models/Registration.php");

        $conn = new Database();
        $db = $conn -> connection();
        $users = new Registration($db);
        $users -> Email = $_POST['username'];
        $users -> Password = $_POST['password'];
        $login = $users -> userLogin();
        if($login){
            $_SESSION['adminuser'] = $_POST['username'];
            header("Location: dashboard.php");
        }else{
            header("Location: index.php?error=Oops! wrong username or password.");
        }
    }
?>