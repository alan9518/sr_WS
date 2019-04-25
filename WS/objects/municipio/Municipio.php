<?php
    /* ==========================================================================
    ** Municipio Object Class
    ** 24/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    class Municipio {
        
        // database connection and table name
        private $conn;
        private $table_name = "municipios";
    
        // object properties
        public $id;
        public $nombre;


        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }



        function getMunicipiosByEstado($id_estado) {
            // Call Stored Procedure
            $estado_id = $id_estado;
            $stmt = $this->conn->prepare('CALL getMunicipiosByEstado(:estado_id)');
            
            // $stmt->bindParam(1, 1, PDO::PARAM_STR);
            $stmt->bindParam(':estado_id', $estado_id, PDO::PARAM_INT);
 
 
            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }




    }


?>