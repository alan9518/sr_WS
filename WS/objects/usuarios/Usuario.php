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
        public $id_usuatrio;
        public $nombre_usuario;
        public $pass_usuario;
        public $correo_usuario;
        
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


        function login($correo_usuario, $pass_usuario) {
            // $user_pass = hash('sha256', $pass_usuario);
            $hash_pass = hash('sha256',$pass_usuario);
            $user_pass = md5($hash_pass);

            $stmt = $this->conn->prepare('CALL loginUsuario(:correo_usuario, :pass_usuario)');
            

            $stmt->bindParam(':correo_usuario', $correo_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':pass_usuario', $user_pass, PDO::PARAM_STR);

            // call the stored procedure
            $stmt->execute();
            return $stmt;

        }

    }


?>

