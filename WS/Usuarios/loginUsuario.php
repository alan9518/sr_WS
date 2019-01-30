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
    include_once '../objects/usuarios/Usuario.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $usuario = new Usuario($db);

    // Get Varaibles
    $usuario->correo_usuario = isset($_GET['correo_usuario']) ? $_GET['correo_usuario'] : die();
    $usuario->pass_usuario = isset($_GET['pass_usuario']) ? $_GET['pass_usuario'] : die();

    // echo $usuario->id_anuncio;

    // read the details of user to be edited
    $stmt = $usuario->login($usuario->correo_usuario, $usuario->pass_usuario);

    // $stmt = $usuario->getAll();

    $resultsArray = $stmt->fetch(PDO::FETCH_ASSOC);

    if($resultsArray !== false)
        echo (json_encode($resultsArray));
    else
        echo '{"error":{"text":"Bad request wrong username and password"}}';


?>