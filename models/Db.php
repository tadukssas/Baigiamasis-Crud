<?php
    class DB{
        public $conn;
        
        public function __construct() {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "datab";
            $this->conn = new mysqli($host, $user, $pass, $db);
        }   
    }



?>

