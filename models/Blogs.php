<?php
    class Blogs {
        public $Blog_Tittle;
        public $Blogs_Language;
        public $Blog_Slug;
        public $Blog_Image;
        public $Blogs_Body;
        public $Blogs_Read_Time;
        public $id;
        public $last_update;
        private $conn;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function saveBlog()
        {
            $sql = "INSERT INTO blog_post(`blog_title`,`Blog_Slug`,`language`,`blog_image_name`,`blog_content`,`read_time`) VALUES(?,?,?,?,?,?)";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Blog_Tittle,$this -> Blog_Slug,$this -> Blogs_Language,$this -> Blog_Image,$this -> Blogs_Body,$this -> Blogs_Read_Time]);
            if($query){
                return true;
            }else{
                return false;
            }
        }

        public function getBlogs()
        {
            $sql = "SELECT * FROM blog_post ORDER BY id DESC";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();
            if($row = $query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return $results;
                }
            }else{
                return false;
            }
        }

        public function latestBlogs()
        {
            $sql = "SELECT * FROM blog_post ORDER BY id DESC LIMIT 2";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();
            if($row = $query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return $results;
                }
            }else{
                return false;
            }
        }

        public function getBlog()
        {
            $sql = "SELECT * FROM blog_post WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> id]);
            if($row = $query -> rowCount() > 0){
                while($results = $query -> fetch(PDO::FETCH_ASSOC)){
                    return $results;
                }
            }else{
                return false;
            }
        }

        public function updateBlogs()
        {
            if(empty($this -> Blog_Image) || $this -> Blog_Image == ""){
                $sql = "UPDATE blog_post SET blog_title= ?,`language` = ?,Blog_Slug= ?,blog_content = ?,read_time = ?,Last_Update = ? WHERE id =?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Blog_Tittle,$this -> Blogs_Language,$this -> Blog_Slug,$this -> Blogs_Body,$this -> Blogs_Read_Time,$this ->last_update, $this -> id]);
            }else{
                $sql = "UPDATE blog_post SET blog_title= ?,`language` = ?,Blog_Slug= ?,blog_image_name = ?,blog_content = ?,read_time = ? ,Last_Update = ? WHERE id =?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Blog_Tittle,$this -> Blogs_Language,$this -> Blog_Slug,$this -> Blog_Image,$this -> Blogs_Body,$this -> Blogs_Read_Time,$this ->last_update,$this -> id]);
            }
            if($query){
                return true;
            }else{
                return false;
            }
        }

        public function deleteBlogs()
        {
            $sql = "DELETE FROM blog_post WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> id]);
            if($query){
                return true;
            }else{
                return false;
            }
        }
    }
?>