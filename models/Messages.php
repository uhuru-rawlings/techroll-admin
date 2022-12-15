<?php
    class Messages {
        private $conn;
        public $id;
        public $status = "Unread";

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function getMessages()
        {
            $sql = "SELECT * FROM contact WHERE `status` = ? ORDER BY id DESC";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> status]);
            $rows = $query -> rowCount();
            if($query){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return $results;
                }
            }else{
                return false;
            }
        }

        public function markRead()
        {
            $status = "Read";
            $sql = "UPDATE contact SET `status` = ? WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$status, $this -> id]);
            if($query){
                return true;
            }else{
                return false;
            }
        }
    }
?>