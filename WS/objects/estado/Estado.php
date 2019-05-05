<?php
    /* ==========================================================================
    ** Estado Object Class
    ** 24/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    class Estado {
        
        // database connection and table name
        private $conn;
        private $table_name = "estados";
    
        // object properties
        public $id;
        public $nombre;


        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }



        function getAll() {
            // Set Query
            $query = " SELECT id, nombre
                        FROM
                        " . $this->table_name;
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            return $stmt;
        }



        function getEstadosWithAnuncios() {
            $stmt = $this->conn->prepare('CALL getEstadosWithAnuncios()');
            


            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }




    }


?>