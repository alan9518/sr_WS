<?php
    /* ==========================================================================
    ** Get Modelos By Marca Web Service
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
    include_once '../objects/modelo/Modelo.php';
    header("Access-Control-Allow-Origin: *");
    
    $database = new Database();
    $db = $database->getConnection();
    
    $modelo = new Modelo($db);


    // set ID property of user to be edited
    $modelo->marca_id = isset($_GET['marca_id']) ? $_GET['marca_id'] : die();
    // $user->password = isset($_GET['password']) ? $_GET['password'] : die();

    // read the details of user to be edited
    $stmt = $modelo->getModelosByMarca($modelo->marca_id);

    $result = $stmt->fetchAll();

    // Make JSON Format
    print_r(json_encode($result));

?>