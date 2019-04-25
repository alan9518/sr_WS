<?php
    /* ==========================================================================
    ** Add Usuario
    ** 24/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    
    
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
	header('P3P: CP="CAO PSA OUR"'); // Makes IE to support cookies
	header("Content-Type: application/json; charset=utf-8");

    // get database connection
    include_once '../config/database.php';    
    // instantiate user object
    include_once '../objects/usuarios/Usuario.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $usuario = new Usuario($db);

    // Get Varaibles
    $usuario->nombre_usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : die();
    $usuario->apellidos_usuario = isset($_POST['apellidos_usuario']) ? $_POST['apellidos_usuario'] : die();
    $usuario->correo_usuario = isset($_POST['correo_usuario']) ? $_POST['correo_usuario'] : die();
    $usuario->pass_usuario = isset($_POST['pass_usuario']) ? $_POST['pass_usuario'] : die();
    $usuario->tel_usuario = isset($_POST['tel_usuario']) ? $_POST['tel_usuario'] : die();

    // echo ($_POST['nombre_usuario'])

    // echo ("usuario");


    echo json_encode($usuario);

    // read the details of user to be edited
    $stmt = $usuario->addUser($usuario);

    if($usuario->addUser($usuario)){
        $user_arr=array(
            "status" => true,
            "message" => "Successfully Signup!",
            "id_usuario" => $usuario->id_usuario
        );
    }
    else{
        $user_arr=array(
            "status" => false,
            "message" => "Username already exists!"
        );
    }

    print_r(json_encode($user_arr));



    // $resultsArray = $stmt->fetch(PDO::FETCH_ASSOC);

    // if($resultsArray !== false)
    //     echo (json_encode($resultsArray));
    // else
    //     echo '{"error":{"text":"Bad request wrong username and password"}}';


?>