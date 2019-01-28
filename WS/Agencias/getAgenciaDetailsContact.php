<?php
    /* ==========================================================================
    ** Get Agencias Details Web Service
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
    
    $agencias = new Agencia($db);

    // Get Varaibles
        $agencias->id_anuncio = isset($_GET['id_anuncio']) ? $_GET['id_anuncio'] : die();

    // echo $agencias->id_anuncio;

    // read the details of user to be edited
        $stmt = $agencias->getAgenciaDetailsContact($agencias->id_anuncio);
        
        // $stmt = $agencias->getAll();

        $resultsArray = $stmt->fetchall();

        // while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        //     echo $row;
        //     // $resultsArray = $row;
        // }

    // Make JSON Format
        echo (json_encode($resultsArray));

?>