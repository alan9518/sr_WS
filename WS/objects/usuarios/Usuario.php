<?php
    /* ==========================================================================
    ** Anuncios Object Class
    ** 27/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    class Usuario {
        
        // database connection and table name
        private $conn;
        private $table_name = "usuarios";
    
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


        function getVendedorDetailsContact($id_anuncio) {
            // Call Stored Procedure
            $id = $id_anuncio;
            $stmt = $this->conn->prepare('CALL getVendedorDetailsContact(:id)');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);


            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }

    }


?>