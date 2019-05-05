<?php
    /* ==========================================================================
    ** Vehiculos Object Class
    ** 27/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    class Vehiculo {
        
        // database connection and table name
        private $conn;
        private $table_name = "vehiculos";
    
        // object properties
        // public $id_anuncio;
        // public $id_agencia;
        // public $nombre_agencia;
        // public $pass_usuario;
        // public $correo_usuario;
        public $id_vehiculo;


        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }



        // --------------------------------------
        // GET All Vehiculos
        // --------------------------------------
        function getAll() {
            // Call Stored Procedure

            $stmt = $this->conn->prepare("CALL getAllVehiculos()");

            // call the stored procedure
            $stmt->execute();
        
            return $stmt;
        }


      

        // --------------------------------------
        // Inser Vehiculo
        // --------------------------------------
        function addVehiculo($vehiculo) {

            // $hash_pass = hash('sha256',$vehiculo->pass_usuario);
            // $user_pass = md5($hash_pass);


            // echo json_encode($vehiculo);

            $stmt = $this->conn->prepare('CALL addVehiculo(:marca, :modelo, :tipo, :year, :kilometraje,:carroceria, :transmision, :tipo_manejo, :combustible, :color, :vestiduras, :equipamento)');

            $stmt->bindParam(':marca', $vehiculo->marca, PDO::PARAM_INT);
            $stmt->bindParam(':modelo', $vehiculo->modelo, PDO::PARAM_INT);
            $stmt->bindParam(':tipo', $vehiculo->tipo, PDO::PARAM_INT);
            $stmt->bindParam(':year', $vehiculo->year, PDO::PARAM_STR);
            $stmt->bindParam(':kilometraje', $vehiculo->kilometraje, PDO::PARAM_STR);
            $stmt->bindParam(':carroceria', $vehiculo->carroceria, PDO::PARAM_STR);
            $stmt->bindParam(':transmision', $vehiculo->transmision, PDO::PARAM_STR);
            $stmt->bindParam(':tipo_manejo', $vehiculo->tipo_manejo, PDO::PARAM_STR);
            $stmt->bindParam(':combustible', $vehiculo->combustible, PDO::PARAM_STR);
            $stmt->bindParam(':color', $vehiculo->color, PDO::PARAM_STR);
            $stmt->bindParam(':vestiduras', $vehiculo->vestiduras, PDO::PARAM_STR);
            $stmt->bindParam(':equipamento', $vehiculo->equipamento, PDO::PARAM_STR);
            

            // execute query
            if($stmt->execute()){
                
                echo $vehiculo->id_vehiculo;
                

                

                $get_stmt = $this->conn->prepare("CALL getLastVehiculo()");
            
                $get_stmt->execute();
    

                $resultsArray = $get_stmt->fetch(PDO::FETCH_ASSOC);

                

                echo (json_encode($resultsArray));


              
            }
            else
                return false;
        }


        // function getAgenciaDetailsContact($id_anuncio) {
        //     // Call Stored Procedure
            
        //     $id = $id_anuncio;
        //     $stmt = $this->conn->prepare('CALL getAgenciaDetailsContact(:id)');
        //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);


        //     // call the stored procedure
        //     $stmt->execute();
        //     return $stmt;
        // }



        // function login($nombre_agencia, $correo_usuario, $pass_usuario) {
        //     // echo "login";
        //     $hash_pass = hash('sha256',$pass_usuario);
        //     $user_pass = md5($hash_pass);

        //     // echo $user_pass;

        //     $stmt = $this->conn->prepare('CALL loginAgencia(:nombre_agencia, :correo_usuario, :pass_usuario)');
            
        //     $stmt->bindParam(':nombre_agencia', $nombre_agencia, PDO::PARAM_STR);
        //     $stmt->bindParam(':correo_usuario', $correo_usuario, PDO::PARAM_STR);
        //     $stmt->bindParam(':pass_usuario', $user_pass, PDO::PARAM_STR);

        //     // call the stored procedure
        //     $stmt->execute();
        //     return $stmt;

        // }


    }


?>