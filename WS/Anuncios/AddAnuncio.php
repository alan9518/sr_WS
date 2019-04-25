<?php
    /* ==========================================================================
    ** Add Anuncios
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

    // Get Varaibles
    // New Car ID -1 To Match DB
    $anuncio->id_tipo_anuncio = isset($_POST['id_tipo_anuncio']) ? $_POST['id_tipo_anuncio'] : die();
    $anuncio->id_vehiculo = isset($_POST['id_vehiculo']) ?( $_POST['id_vehiculo'] - 1) : die();
    $anuncio->id_vendedor = isset($_POST['id_vendedor']) ? $_POST['id_vendedor'] : die();
    $anuncio->id_agencia = isset($_POST['id_agencia']) ? $_POST['id_agencia'] : die();
    $anuncio->tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : die();
    $anuncio->titulo = isset($_POST['titulo']) ? $_POST['titulo'] : die();
    $anuncio->precio = isset($_POST['precio']) ? $_POST['precio'] : die();
    $anuncio->Descripcion = isset($_POST['Descripcion']) ? $_POST['Descripcion'] : die();
    $anuncio->imagen_destacada = isset($_POST['imagen_destacada']) ? $_POST['imagen_destacada'] : die();
    $anuncio->fecha_creado = isset($_POST['fecha_creado']) ? $_POST['fecha_creado'] : die();
    $anuncio->condicion_vehiculo = isset($_POST['condicion_vehiculo']) ? $_POST['condicion_vehiculo'] : die();
    $anuncio->estado = isset($_POST['estado']) ? $_POST['estado'] : die();
    $anuncio->ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : die();
    $anuncio->propietarios = isset($_POST['propietarios']) ? $_POST['propietarios'] : die();
    $anuncio->fecha_cierre = isset($_POST['fecha_cierre']) ? $_POST['fecha_cierre'] : die();
    $anuncio->estado_anuncio = isset($_POST['estado_anuncio']) ? $_POST['estado_anuncio'] : die();
    $anuncio->anuncio_pagado = isset($_POST['anuncio_pagado']) ? $_POST['anuncio_pagado'] : die();
    $anuncio->precio_anuncio_pagado = isset($_POST['precio_anuncio_pagado']) ? $_POST['precio_anuncio_pagado'] : die();
    $anuncio->metodo_pago = isset($_POST['metodo_pago']) ? $_POST['metodo_pago'] : die();


    // echo ($_POST['marca'])

    // echo ("usuariosdaddadsasd");


    // var_dump($_POST);

    // echo json_encode($anuncio);

  
    if($anuncio->createAnuncio($anuncio)){
        $response=array(
            "status" => true,
            "message" => "Anuncio creado"
            
        );
    }
    else{
        $response=array(
            "status" => false,
            "message" => "error al crear el anuncio"
        );
    }

    print_r(json_encode($response));

   

?>