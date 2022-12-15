<?php
    include_once("../database/Database.php");
    include_once("../models/Blogs.php");
    include_once("../models/Imageupload.php");

    if(isset($_POST['save'])){
        $blog_title    = $_POST['blog_title'];
        $blog_language = $_POST['blog_language'];
        $blog_slug     = $_POST['blog_slug'];
        $blog_image    = $_FILES['blog_image'];
        $description   = $_POST['description'];

        $conn = new Database();
        $db = $conn -> connection();
        $blogs = new Blogs($db);
        $images = new Imageupload($blog_image);
        $image = $images -> uploadImage();
        if($image){
            $blogs -> Blog_Tittle     = $blog_title;
            $blogs -> Blogs_Language  = $blog_language;
            $blogs -> Blog_Slug       = $blog_slug;
            $blogs -> Blog_Image      = $image;
            $blogs -> Blogs_Body      = $description;
            $blogs -> Blogs_Read_Time = "2 Minutes Read";
            $save = $blogs -> saveBlog();
            if($save){
                header("Location: create-blogs.php?success=Blog posted successfully, good day.");
            }else{
                header("Location: create-blogs.php?error=Oops! something went wrong, please try again.");
            }
        }else{
            header("Location: create-blogs.php?error=Oops! something went wrong with image provided.");
        }
    }

?>