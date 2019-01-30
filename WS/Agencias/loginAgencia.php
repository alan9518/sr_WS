<?php
    /* ==========================================================================
    ** Login
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
    $agencia->nombre_agencia = isset($_GET['nombre_agencia']) ? $_GET['nombre_agencia'] : die();
    $agencia->correo_usuario = isset($_GET['correo_usuario']) ? $_GET['correo_usuario'] : die();
    $agencia->pass_usuario = isset($_GET['pass_usuario']) ? $_GET['pass_usuario'] : die();


    // read the details of user to be edited
    $stmt = $agencia->login($agencia->nombre_agencia,  $agencia->correo_usuario, $agencia->pass_usuario);

    $resultsArray = $stmt->fetch(PDO::FETCH_ASSOC);

    if($resultsArray !== false)
        echo (json_encode($resultsArray));
    else
        echo '{"error":{"text":"Bad request wrong username and password"}}';

?>