<?php
    class Products {
        public $product_category;
        public $sub_category;
        public $product_name;
        public $product_quantity;
        public $product_metric;
        public $product_price;
        public $product_image;
        public $description;
        public $id;
        private $conn;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function saveProduct()
        {
            $sql = "INSERT INTO Products(category,sub_category,product_name,product_metric,product_price,product_image,product_description) VALUES(?,?,?,?,?,?,?)";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> product_category,$this -> sub_category,$this -> product_name,$this -> product_metric,$this -> product_price,$this -> product_image,$this -> description]);
            if($query){
                return true;
            }else{
                return false;
            }
        }

        public function getProducts()
        {
            $sql = "SELECT * FROM Products";
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

        public function getProduct()
        {
            $sql = "SELECT * FROM Products WHERE id = ?";
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

        public function updateProducts()
        {
            if(empty($this -> product_image) || $this -> product_image == ""){
                $sql = "UPDATE Products SET category= ?,sub_category = ?,product_name= ?,product_metric = ?,product_price = ?,product_description = ? WHERE id =?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> product_category,$this -> sub_category,$this -> product_name,$this -> product_metric,$this -> product_price,$this -> description]);
            }else{
                $sql = "UPDATE Products SET category= ?,sub_category = ?,product_name= ?,product_metric = ?,product_price = ?,product_image = ?,product_description = ? WHERE id =?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> product_category,$this -> sub_category,$this -> product_name,$this -> product_metric,$this -> product_price,$this -> product_image,$this -> description]);
            }
            if($query){
                return true;
            }else{
                return false;
            }
        }
    }
?>