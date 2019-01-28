<?php
    /* ==========================================================================
    ** Anuncios Object Class
    ** 27/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    class Agencia {
        
        // database connection and table name
        private $conn;
        private $table_name = "agencias";
    
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


        function getAgenciaDetailsContact($id_anuncio) {
            // Call Stored Procedure
            
            $id = $id_anuncio;
            $stmt = $this->conn->prepare('CALL getAgenciaDetailsContact(:id)');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);


            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }


    }


?>