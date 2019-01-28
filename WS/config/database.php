
<?php

    /* ==========================================================================
    ** Database Connection FIle
    ** 24/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    class Database{
    
        // specify your own database credentials
        private $host = "localhost";
        private $db_name = "seminuevos";
        private $username = "root";
        private $password = "";
        // private $db_name = "srseminu_DB";
        // private $username = "srseminu_dbMaste";
        // private $password = "srMaster!#";
        public $conn;
    
        // get the database connection
        public function getConnection(){
    
            $this->conn = null;
    
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
    
            return $this->conn;
        }
    }
?>