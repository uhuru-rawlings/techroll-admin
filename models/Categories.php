<?php
    class Categories {
        public $category;
        public $id;
        private $conn;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function createCategory()
        {
            $sql = "SELECT * FROM Categories WHERE Category_Name= ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> category]);
            $rows = $query -> rowCount();
            if($rows > 0){
                return false;
            }else{
                $sql = "INSERT INTO Categories(Category_Name) VALUES(?)";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> category]);
                if($query){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function getCategories()
        {
            $sql = "SELECT * FROM Categories";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();
            $rows = $query -> rowCount();
            if($rows > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return $results;
                }
            }else{
                return false;
            }
        }

        public function getCategory()
        {
            $sql = "SELECT * FROM Categories WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> id]);
            $rows = $query -> rowCount();
            if($rows > 0){
                while($results = $query -> fetch(PDO::FETCH_ASSOC)){
                    return $results;
                }
            }else{
                return false;
            }
        }

        public function updateCategory()
        {
            $sql = "SELECT * FROM Categories WHERE id= ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> id]);
            $rows = $query -> rowCount();
            if($rows > 0){
                $sql = "UPDATE Categories SET Category_Name =? WHERE id = ?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> category,$this -> id]);
                if($query){
                    $time = date("Y-m-d H:i:s");
                    $sql = "UPDATE Categories SET last_update =? WHERE id = ?";
                    $query = $this -> conn -> prepare($sql);
                    $query -> execute([$time,$this -> id]);
                    if($query){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function deleteCategory()
        {
            $sql = "SELECT * FROM Categories WHERE id= ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> id]);
            $rows = $query -> rowCount();
            if($rows > 0){
                $sql = "DELETE FROM Categories WHERE id =?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> id]);
                if($query){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
?>