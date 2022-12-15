<?php
    class Imageupload {
        public $image;

        public function __construct($files)
        {
            $this -> image = $files;
        }

        public function uploadImage()
        {
            $filename = $this -> image['name'];
            $file_tmp_name = $this -> image['tmp_name'];
            $filesize = $this -> image['size'];

            $file_name = explode(".",$filename);
            $accepted = array("jpg","png","jpeg");
            if(in_array(strtolower(end($file_name)),$accepted)){
                $new_name = rand(1000,99999).$filename;
                $location = "../uploads/".$new_name;
                $move = move_uploaded_file($file_tmp_name,$location);
                if($move){
                    return $new_name;
                }else{
                    return false;
                }
            }
        }
    }
?>