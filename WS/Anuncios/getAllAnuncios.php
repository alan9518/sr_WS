<?php
    /* ==========================================================================
    ** Get Anuncios Web Service
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

    // Get Varaibles
    $currentPage = isset($_GET['page']) ? $_GET['page'] : die();
    $itemsPerPage = isset($_GET['items']) ? $_GET['items'] : die();
    // $itemsPerPage = 12;
    $sortByOption = isset($_GET['sortBy']) ? $_GET['sortBy'] : die();

    // echo $currentPage;

    // read the details of user to be edited
    $stmt = $anuncios->getAnunciosPagination($currentPage, $itemsPerPage, $sortByOption);



    // $stmt = $anuncios->	getAnunciosWithOptionalParams(null, null, null, null, 0, 100000000, 1, 6, 'tituloDesc');

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        // echo $row;
        $resultsArray[] = $row;
    }
    

    if(isset($resultsArray))
        echo (json_encode($resultsArray));
    else
        echo (json_encode([]));

?>