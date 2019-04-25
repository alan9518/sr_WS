<?php
    /* ==========================================================================
    ** Get Municipios Web Service
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
    include_once '../objects/municipio/Municipio.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $municipios = new Municipio($db);

    // Get Varaibles
        $estado_id = isset($_GET['id_estado']) ? $_GET['id_estado'] : die();

    // echo $estado_id;

    // read the details of user to be edited
        $stmt = $municipios->getMunicipiosByEstado($estado_id);
        
        
        // $stmt = $municipios->getAll();

        // $resultsArray = $stmt->fetchall();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            // echo $row;
            $resultsArray[] = $row;
        }

    // Make JSON Format
        echo (json_encode($resultsArray));

?>