<?php
    session_start();
    if(isset($_SESSION['adminuser'])){
        session_unset($_SESSION['adminuser']);
        unset($_SESSION['adminuser']);
        header("Location: index.php?error=You have been logged out, please login to proceed.");
    }else{
        header("Location: index.php?error=You are not logged in, please login to proceed.");
    }
?>