<?php
    class Registration {
        public $Fname;
        public $Lname;
        public $Email;
        public $Phone;
        public $Password;
        public $status = "Active";
        public $update;
        private $conn;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function userLogin()
        {
            $sql   = "SELECT * FROM registration WHERE useremail = ?";
            $query = $this-> conn -> prepare($sql);
            $query -> execute([$this -> Email]);
            if($query -> rowCount() > 0){
                while($results = $query -> fetch(PDO::FETCH_ASSOC)){
                    $res = $results['passwords'];
                    if(password_verify($this -> Password, $res)){
                        $sql = "UPDATE registration SET `last_login` = ? WHERE useremail = ?";
                        $query = $this -> conn -> prepare($sql);
                        $dates = date("Y-m-d H:i:s");
                        $query -> execute([$dates,$this -> Email]);
                        if($query){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }
            }else{
                return false;
            }
        }


        public function saveUser()
        {
            $sql   = "SELECT * FROM registration WHERE useremail = ?";
            $query = $this-> conn -> prepare($sql);
            $query -> execute([$this -> Email]);
            if($query -> rowCount() > 0){
                return false;
            }else{
                $sql = "INSERT INTO registration(`Fname`,`Lname`,`useremail`,`Phone`,`passwords`,`status`) VALUES(?,?,?,?,?,?)";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Fname,$this -> Lname,$this -> Email,$this -> Phone,password_hash($this -> Password, PASSWORD_DEFAULT),$this -> status]);
                if($query){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function getUsers()
        {
            $sql = "SELECT * FROM registration";
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

        public function getUser()
        {
            $sql = "SELECT * FROM registration WHERE id = ?";
            $query = $this ->conn -> prepare($sql);
            $query -> execute([$this -> update]);
            if($query -> rowCount() > 0){
                while($results = $query -> fetch(PDO::FETCH_ASSOC)){
                    return $results;
                }
            }else{
                return false;
            }
        }

        public function getUserProfile()
        {
            $sql = "SELECT * FROM registration WHERE useremail = ?";
            $query = $this ->conn -> prepare($sql);
            $query -> execute([$this -> Email]);
            if($query -> rowCount() > 0){
                while($results = $query -> fetch(PDO::FETCH_ASSOC)){
                    return $results;
                }
            }else{
                return false;
            }
        }

        public function updateUser()
        {
            $sql = "SELECT * FROM registration WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> update]);
            $rows = $query -> rowCount();
            if($rows > 0){
                if(empty($this -> Password) || $this -> Password == ""){
                    $sql = "UPDATE registration SET Fname = ?,Lname = ?, Email =?, Phone = ? WHERE id = ?";
                    $query = $this -> conn -> prepare($sql);
                    $query -> execute([$this -> Fname,$this -> Lname,$this -> Email,$this -> Phone,$this -> update]);
                    if($query){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    $sql = "UPDATE registration SET Fname = ?,Lname = ?, Email =?, Phone = ?,Password = ? WHERE id = ?";
                    $query = $this -> conn -> prepare($sql);
                    $query -> execute([$this -> Fname,$this -> Lname,$this -> Email,$this -> Phone,password_hash($this -> Phone,PASSWORD_DEFAULT),$this -> update]);
                    if($query){
                        return true;
                    }else{
                        return false;
                    }
                }
            }else{
                return false;
            }
        }

        public function deleteUser()
        {
            $sql = "DELETE FROM registration WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> update]);
            if($query){
                return true;
            }else{
                return false;
            }
        }
    }
?>