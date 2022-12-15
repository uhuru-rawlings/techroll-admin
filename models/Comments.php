<?php
    class Comments {
        private $conn;
        public $id;
        public $status = "Unread";

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function getComments()
        {
            $sql = "SELECT * FROM comments ORDER BY id DESC";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();
            $rows = $query -> rowCount();
            if($query){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return $results;
                }
            }else{
                return false;
            }
        }

        public function approveComments()
        {
            $status = "Yes";
            $sql = "UPDATE comments SET `is_approved` = ? WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$status, $this -> id]);
            if($query){
                return true;
            }else{
                return false;
            }
        }

        public function deleteComments()
        {
            $sql = "DELETE FROM comments WHERE id = ?";
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