<?php
    /* ==========================================================================
    ** Add Vehiculo
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
    include_once '../objects/vehiculos/Vehiculo.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    $vehiculo = new Vehiculo($db);

    // Get Varaibles
    $vehiculo->marca = isset($_POST['marca']) ? $_POST['marca'] : die();
    $vehiculo->modelo = isset($_POST['modelo']) ? $_POST['modelo'] : die();
    $vehiculo->tipo = isset($_POST['tipo']) ? $_POST['tipo'] : die();
    $vehiculo->year = isset($_POST['year']) ? $_POST['year'] : die();
    $vehiculo->kilometraje = isset($_POST['kilometraje']) ? $_POST['kilometraje'] : die();
    $vehiculo->carroceria = isset($_POST['carroceria']) ? $_POST['carroceria'] : die();
    $vehiculo->transmision = isset($_POST['transmision']) ? $_POST['transmision'] : die();
    $vehiculo->tipo_manejo = isset($_POST['tipo_manejo']) ? $_POST['tipo_manejo'] : die();
    $vehiculo->combustible = isset($_POST['combustible']) ? $_POST['combustible'] : die();
    $vehiculo->color = isset($_POST['color']) ? $_POST['color'] : die();
    $vehiculo->vestiduras = isset($_POST['vestiduras']) ? $_POST['vestiduras'] : die();
    $vehiculo->equipamento = isset($_POST['equipamento']) ? $_POST['equipamento'] : die();

    // echo ($_POST['marca'])

    // echo ("usuariosdaddadsasd");


    // var_dump($_POST);

    // echo json_encode($vehiculo);

    // read the details of user to be edited
    // $stmt = $vehiculo->ad    dUser($vehiculo);

    if($vehiculo->addVehiculo($vehiculo) === false){
        // echo $vehiculo
        // $response=array(
        //     "status" => true,
        //     "message" => "Successfully Signup!",
        //     "id_vehiculo" => $vehiculo->id_vehiculo
        // );
    // }
    // else{
        $response=array(
            "status" => false,
            "message" => "Couldnt Create Vehiculo!"
        );
    // print_r(json_encode($response));

    }




    // $resultsArray = $stmt->fetch(PDO::FETCH_ASSOC);

    // if($resultsArray !== false)
    //     echo (json_encode($resultsArray));
    // else
    //     echo '{"error":{"text":"Bad request wrong username and password"}}';


?>