<?php
    include_once("../database/Database.php");
    include_once("../models/Blogs.php");
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $conn = new Database();
        $db = $conn -> connection();
        $blogs = new Blogs($db);
        $blogs -> id = $id;
        $delete = $blogs -> deleteBlogs();
        if($delete){
            header("Location: list-blogs.php?success=Blog deleted successfully");
        }else{
            header("Location: list-blogs.php?error=Oops! something went wrong, please try again");
        }
    }
?>