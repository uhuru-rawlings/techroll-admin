<?php
    include_once("../database/Database.php");
    include_once("../models/Messages.php");
    if(isset($_GET['message'])){
     $conn = new Database();
     $db = $conn -> connection();
     $messages = new Messages($db);
     $messages -> id = $_GET['message'];
     $save = $messages -> markRead();
     if($save){
        header("Location: manage.messages.php?success=Message marked as read");
     }else{
        header("Location: manage.messages.php?error=Oops! something went wrong, please try again.");
     }
    }
?>