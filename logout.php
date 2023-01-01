<?php
    session_start();
    // ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    if(isset($_SESSION['adminuser'])){
        session_unset();
        unset($_SESSION['adminuser']);
        header("Location: index.php?error=You have been logged out, please login to proceed.");
    }else{
        header("Location: index.php?error=You are not logged in, please login to proceed.");
    }

?>

