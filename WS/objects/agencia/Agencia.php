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
        public $id_agencia;
        public $nombre_agencia;
        public $pass_usuario;
        public $correo_usuario;


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



        function login($nombre_agencia, $correo_usuario, $pass_usuario) {
            // echo "login";
            $hash_pass = hash('sha256',$pass_usuario);
            $user_pass = md5($hash_pass);

            // echo $user_pass;

            $stmt = $this->conn->prepare('CALL loginAgencia(:nombre_agencia, :correo_usuario, :pass_usuario)');
            
            $stmt->bindParam(':nombre_agencia', $nombre_agencia, PDO::PARAM_STR);
            $stmt->bindParam(':correo_usuario', $correo_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':pass_usuario', $user_pass, PDO::PARAM_STR);

            // call the stored procedure
            $stmt->execute();
            return $stmt;

        }


    }


?>