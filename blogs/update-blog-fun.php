<?php
    include_once("../database/Database.php");
    include_once("../models/Blogs.php");
    include_once("../models/Imageupload.php");

    if(isset($_POST['save'])){
        $update        = $_POST['update'];
        $blog_title    = $_POST['blog_title'];
        $blog_language = $_POST['blog_language'];
        $blog_slug     = $_POST['blog_slug'];
        $blog_image    = $_FILES['blog_image'];
        $description   = $_POST['description'];

        $conn = new Database();
        $db = $conn -> connection();
        $blogs = new Blogs($db);
        if(!empty($blog_image['name']) || $blog_image['name'] !== ""){
            $images = new Imageupload($blog_image);
            $image = $images -> uploadImage();
            if($image){
                $blogs -> Blog_Image      = $image;
            }else{
                header("Location: create-blogs.php?edit={$update}&error=Oops! something went wrong with image provided.");
            }
        }else{
            $blogs -> Blog_Image      = "";
        }
        
            $blogs -> id     = $update;
            $blogs -> Blog_Tittle     = $blog_title;
            $blogs -> Blogs_Language  = $blog_language;
            $blogs -> Blog_Slug       = $blog_slug;
            $blogs -> Blogs_Body      = $description;
            $blogs -> Blogs_Read_Time = "2 Minutes Read";
            $blogs -> last_update = date("Y-m-d H:i:s");
            
            $save = $blogs -> updateBlogs();
            if($save){
                header("Location: manage-blogs.php?edit={$update}&success=Blog updated successfully, good day.");
            }else{
                header("Location: manage-blogs.php?edit={$update}&error=Oops! something went wrong, please try again.");
            }
    }

?>