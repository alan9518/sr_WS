<?php

    /* ==========================================================================
        ** Marca Object Class
        ** 24/01/2019
        ** Alan Medina Silva
        ** ========================================================================== */
    class Modelo {
        
        // database connection and table name
        private $conn;
        private $table_name = "modelos";
    
        // object properties
        public $id;
        public $marca_id;
        public $nombre;


        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }



        function getModelosByMarca($marca_id) {

            $query = "SELECT modelos.id, modelos.nombre, modelos.year FROM `modelos` INNER JOIN marcas ON modelos.marca_id = marcas.id WHERE modelos.marca_id = {$marca_id} GROUP BY modelos.nombre";
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            return $stmt;
        }



        function getModelos() {
            // Set Query
            $query =  " SELECT modelos.id, modelos.nombre, modelos.year 
                        FROM `modelos` INNER JOIN marcas ON modelos.marca_id = marcas.id  ";
                        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            return $stmt;
        }




    }


?>