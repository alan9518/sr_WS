<?php
    /* ==========================================================================
    ** Get Anuncios Count for Paginatin Web Service
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
    // $currentPage = isset($_GET['page']) ? $_GET['page'] : die();

    // echo $currentPage;

    // read the details of user to be edited
    $stmt = $anuncios->getAnunciosCount();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $anunciosCount = $row['count'];

        // Make JSON Format
        echo (json_encode($row));
    }


  

?>