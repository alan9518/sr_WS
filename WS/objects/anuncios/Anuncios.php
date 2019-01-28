<?php
    /* ==========================================================================
    ** Anuncios Object Class
    ** 27/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    class Anuncios {
        
        // database connection and table name
        private $conn;
        private $table_name = "anuncios";
    
        // object properties
        public $id_anuncio;


        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }



        function getAll() {
            // Call Stored Procedure

            $stmt = $this->conn->prepare("CALL listAnunciosAll()");

            // call the stored procedure
            $stmt->execute();
        
            return $stmt;
        }


        function getAnuncioDetails($id_anuncio) {
            // Call Stored Procedure
            $id = $id_anuncio;
            $stmt = $this->conn->prepare('CALL getAnuncioDetails(:id)');
            // $stmt->bindParam(1, 1, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);


            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }


        function getImagenesAnuncio($id_anuncio) {
            // Call Stored Procedure
            $id = $id_anuncio;
            $stmt = $this->conn->prepare('CALL getImagenesAnuncio(:id)');
            // $stmt->bindParam(1, 1, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);


            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }


    }


?>