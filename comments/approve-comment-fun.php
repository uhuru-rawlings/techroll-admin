<?php
    include_once("../database/Database.php");
    include_once("../models/Comments.php");
    if(isset($_GET['comment'])){
     $conn = new Database();
     $db = $conn -> connection();
     $comment = new Comments($db);
     $comment -> id = $_GET['comment'];
     $save = $comment -> approveComments();
     if($save){
        header("Location: manage-comments.php?success=comment approval was successful");
     }else{
        header("Location: manage-comments.php?error=Oops! something went wrong, please try again.");
     }
    }
?>