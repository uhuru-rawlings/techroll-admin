<?php
    include_once("../models/Registration.php");
    include_once("../database/Database.php");
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $conn = new Database();
        $db = $conn -> connection();
        
        $user = new Registration($db);
        $user -> update = $id;
        $delete = $user -> deleteUser();
        if($delete){
            header("Location: manage-admins.php?success=account deleted successfully.");
        }else{
            header("Location: manage-admins.php?error=Oops! something went wrong, please try again.");
        }
    }
?>