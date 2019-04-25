<?php
    /* ==========================================================================
    ** Add Agencia
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
    include_once '../objects/agencia/Agencia.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $agencia = new Agencia($db);

    // Get Varaibles
    $agencia->nombre_usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : die();
    $agencia->nombre_agencia = isset($_POST['nombre_agencia']) ? $_POST['nombre_agencia'] : die();
    $agencia->apellidos_usuario = isset($_POST['apellidos_usuario']) ? $_POST['apellidos_usuario'] : die();
    $agencia->correo_usuario = isset($_POST['correo_usuario']) ? $_POST['correo_usuario'] : die();
    $agencia->pass_usuario = isset($_POST['pass_usuario']) ? $_POST['pass_usuario'] : die();
    $agencia->tel_usuario = isset($_POST['tel_usuario']) ? $_POST['tel_usuario'] : die();


    // echo json_encode($agencia);


    // echo json_encode($agencia);

    // read the details of user to be edited
    // $stmt = $agencia->addUser($agencia);

    if($agencia->addUser($agencia)){
        $user_arr=array(
            "status" => true,
            "message" => "Successfully Signup!",
            "id_agencia" => $agencia->id_agencia
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