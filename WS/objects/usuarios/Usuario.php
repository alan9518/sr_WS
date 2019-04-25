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
        public $id_usuario;
        public $nombre_usuario;
        public $apellidos_usuario;
        public $correo_usuario;
        public $pass_usuario;
        public $tel_usuario;
        
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


        function addUser($usuario) {

            $hash_pass = hash('sha256',$usuario->pass_usuario);
            $user_pass = md5($hash_pass);

            $stmt = $this->conn->prepare('CALL addUser(:nombre_usuario, :apellidos_usuario, :correo_usuario, :pass_usuario, :tel_usuario)');

            $stmt->bindParam(':nombre_usuario', $usuario->nombre_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':apellidos_usuario', $usuario->apellidos_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':correo_usuario', $usuario->correo_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':pass_usuario', $user_pass, PDO::PARAM_STR);
            $stmt->bindParam(':tel_usuario', $usuario->tel_usuario, PDO::PARAM_STR);

            // call the stored procedure
            // $stmt->execute();
            // return $stmt;

            // execute query
            if($stmt->execute()){
                $usuario->id_usuario = $this->conn->lastInsertId();
                echo $usuario->id_usuario;
                return true;
            }
            else
                return false;
        }

    }

?>

