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
        public $new_pass_usuario;
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


        // ?--------------------------------------
        // ? GET User Details
        // ?--------------------------------------
        function getUserDetails($usermail) {
            // Call Stored Procedure
            // $id = $usermail;

            
            $stmt = $this->conn->prepare('CALL getUserData(:usermail)');
            $stmt->bindParam(':usermail', $usermail, PDO::PARAM_STR);


            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }


    
    /* ==========================================================================
    ** POST Requests
    ** ========================================================================== */


        /* ---------------------------------------------------
        ** New User
        ** --------------------------------------------------- */
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
                // echo $usuario->id_usuario;
                return true;
            }
            else
                return false;
        }


        /* ---------------------------------------------------
        ** Edit User No Password
        ** --------------------------------------------------- */
        function editUserNoPass($usuario) {

          
            
            $stmt = $this->conn->prepare('CALL editUserNoPass(:nombre_usuario, :apellidos_usuario, :tel_usuario, :id_user)');

            $stmt->bindParam(':nombre_usuario', $usuario->nombre_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':apellidos_usuario', $usuario->apellidos_usuario, PDO::PARAM_STR);
            // $stmt->bindParam(':correo_usuario', $usuario->correo_usuario, PDO::PARAM_STR);
            // $stmt->bindParam(':pass_usuario', $user_pass, PDO::PARAM_STR);
            $stmt->bindParam(':tel_usuario', $usuario->tel_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':id_user',  $usuario->id_usuario, PDO::PARAM_INT);
           

            // echo json_encode($usuario);

            // execute query
            if($stmt->execute()){
                // $usuario->id_usuario = $this->conn->lastInsertId();
                // echo $usuario->id_usuario;
                return true;
            }
            else
                return false;

        }


        /* ---------------------------------------------------
        ** Edit User
        ** --------------------------------------------------- */
        function editUser($usuario) {
            
            echo 'eduit';


            $hash_pass = hash('sha256',$usuario->pass_usuario);
            $user_pass = md5($hash_pass);

            $new_user_pass =$hash_pass = hash('sha256',$usuario->pass_usuario);
            $user_pass = md5($hash_pass);


            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $stmt2 = $this->conn->prepare('CALL editUser(:nombre_usuario, :apellidos_usuario, :pass_usuario, :tel_usuario, :id_user)');
    
    
            // echo (json_encode($usuario));
    
            $stmt2->bindParam(':nombre_usuario', $usuario->nombre_usuario, PDO::PARAM_STR);
            $stmt2->bindParam(':apellidos_usuario', $usuario->apellidos_usuario, PDO::PARAM_STR);
            $stmt2->bindParam(':pass_usuario', $user_pass, PDO::PARAM_STR);
            $stmt2->bindParam(':tel_usuario', $usuario->tel_usuario, PDO::PARAM_STR);
            $stmt2->bindParam(':id_user',  $usuario->id_usuario, PDO::PARAM_INT);
    
            var_dump($stmt2);
    
            if($stmt2->execute()){
                // $usuario->id_usuario = $this->conn->lastInsertId();
                echo $usuario->id_usuario;
                // var_dump($stmt2);
                return true;
            }
            else{
                echo $usuario->nombre_usuario;
    
                print_r($stmt2->errorInfo());
    
                return false;
            }
        }



        /* ---------------------------------------------------
        ** Check if PassWords Match
        ** --------------------------------------------------- */
        function checkPass($usuario) {

            $hash_pass = hash('sha256',$usuario->pass_usuario);
            $user_pass = md5($hash_pass);

            $new_user_pass =$hash_pass = hash('sha256',$usuario->pass_usuario);
            $user_pass = md5($hash_pass);

            // echo $user_pass;

            // Check if current password matches the one on the DB

            $stmt =  $this->conn->prepare('CALL comparePass(:currentPassword, :id_user)');
            $stmt->bindParam(':currentPassword', $user_pass, PDO::PARAM_STR);
            $stmt->bindParam(':id_user',  $usuario->id_usuario, PDO::PARAM_INT);

             // execute query
             if($stmt->execute()){


                // $result = $stmt->fetch(PDO::FETCH_ASSOC);
                // print_r($result);
                

                if ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

                    // var_dump($row);

                    $passwordsMatch = json_encode($row);

                    echo $passwordsMatch;


                    // return true;
            
                    if($passwordsMatch) {
                        
                        return true;
                       
                    }
                    else {
                        return false;
                    }
                    // Make JSON Format
                    // echo (json_encode($row));
                }

                // $stmt->closeCursor();
            }


            // $stmt = $this->conn->prepare('CALL editUser(:nombre_usuario, :apellidos_usuario, :correo_usuario, :pass_usuario, :tel_usuario)');

            // $stmt->bindParam(':nombre_usuario', $usuario->nombre_usuario, PDO::PARAM_STR);
            // $stmt->bindParam(':apellidos_usuario', $usuario->apellidos_usuario, PDO::PARAM_STR);
            // $stmt->bindParam(':correo_usuario', $usuario->correo_usuario, PDO::PARAM_STR);
            // $stmt->bindParam(':pass_usuario', $user_pass, PDO::PARAM_STR);
            // $stmt->bindParam(':new_pass_usuario', $new_user_pass, PDO::PARAM_STR);
            // $stmt->bindParam(':tel_usuario', $usuario->tel_usuario, PDO::PARAM_STR);

            // // call the stored procedure
            // // $stmt->execute();
            // // return $stmt;

            // // execute query
            // if($stmt->execute()){
            //     $usuario->id_usuario = $this->conn->lastInsertId();
            //     // echo $usuario->id_usuario;
            //     return true;
            // }
            // else
            //     return false;
        }

    }




  

?>

