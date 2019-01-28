<?php
    /* ==========================================================================
    ** Get Anuncio Details Web Service
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
    $usuario->id_anuncio = isset($_GET['id_anuncio']) ? $_GET['id_anuncio'] : die();

    // echo $usuario->id_anuncio;

    // read the details of user to be edited
    $stmt = $usuario->getVendedorDetailsContact($usuario->id_anuncio);

    // $stmt = $usuarios->getAll();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $resultsArray = $row;
    }

    // Make JSON Format
    echo (json_encode($resultsArray));

?>