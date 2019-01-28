<?php
    /* ==========================================================================
    ** Get Marcas Web Service
    ** 24/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    //header('Access-Control-Allow-Origin: *');
    //header('Content-Type: application/json');
    
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
	header('P3P: CP="CAO PSA OUR"'); // Makes IE to support cookies
	header("Content-Type: application/json; charset=utf-8");

    // get database connection
    include_once '../config/database.php';    
    // instantiate user object
    include_once '../objects/marca/Marca.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $marca = new Marca($db);


    // read the details of user to be edited
    $stmt = $marca->getAll();

    $result = $stmt->fetchAll();

    // Make JSON Format
    echo (json_encode($result));

?>