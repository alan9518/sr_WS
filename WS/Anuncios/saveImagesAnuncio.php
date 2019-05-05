<?php
    /* ==========================================================================
    ** Save anuncion Images
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
    
    $anuncio = new Anuncios($db);


    // get variables

   
    $anuncio->id_anuncio = isset($_POST['id_anuncio']) ? $_POST['id_anuncio'] : die();
    $anuncio->imagen_anuncio = isset($_POST['ruta_imagen']) ? $_POST['ruta_imagen'] : die();




    $imagenGuardada = $anuncio->saveImage($anuncio);

    if($imagenGuardada) {
        $response=array(
            "status" => true,
            "message" => "Imagen Guardada"
            // "last_Anuncio"=>  $imagenGuardada
        );
    }
    else {
        $response=array(
            "status" => false,
            "message" => "error al guardar la imagen"
            // "last_Anuncio"=>  0
        );
    }

  
    // if($anuncio->createAnuncio($anuncio)){

      
            
    //     $response=array(
    //         "status" => true,
    //         "message" => "Anuncio creado",
    //         "last_Anuncio"=>  $imagenGuardada
            
    //     );
    // }
    // else{
    //     $response=array(
    //         "status" => false,
    //         "message" => "error al crear el anuncio"
    //     );
    // }

    print_r(json_encode($response));

   

?>