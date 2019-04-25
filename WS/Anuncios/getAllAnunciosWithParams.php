<?php
    /* ==========================================================================
    ** Get Anuncios With Search Params Web Service
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
    include_once '../objects/anuncios/Anuncios.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $anuncios = new Anuncios($db);

    // Get Pagination Varaibles
    $currentPage = isset($_GET['page']) ? $_GET['page'] : die();
    $itemsPerPage = 6;
    $sortByOption = isset($_GET['sortBy']) ? $_GET['sortBy'] : die();

    // Get Query Variables
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : die();
    $marca = isset($_GET['marca']) ? $_GET['marca'] : die();
    $modelo = isset($_GET['modelo']) ? $_GET['modelo'] : die();
    $ubicacion = isset($_GET['ubicacion']) ? $_GET['ubicacion'] : die();
    $precioBase = isset($_GET['precioBase']) ? $_GET['precioBase'] : die();
    $precioTope = isset($_GET['precioTope']) ? $_GET['precioTope'] : die();


  

    // Set Query to use
    if($tipo !== 'nan'  && $marca !== 'nan'  && $modelo !== 'nan'   && $ubicacion !== 'nan' && $precioBase !== 'nan' && $precioTope !== 'nan' ) {
        $stmt = $anuncios->getAnunciosPaginationWithAllParams($tipo, $marca, $modelo, $ubicacion, $precioBase, $precioTope, $currentPage, $itemsPerPage, $sortByOption);
    }
    else 
        $stmt = $anuncios->getAnunciosPagination($currentPage, $itemsPerPage, $sortByOption);


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        
        $resultsArray[] = $row;
    }

    

    

    if(isset($resultsArray))
        echo (json_encode($resultsArray));
    else
        echo (json_encode([]));
?>