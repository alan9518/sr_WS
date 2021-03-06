<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
    /* ==========================================================================
    ** Anuncios Object Class
    ** 27/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    class Anuncios {
        
        // database connection and table name
        private $conn;
        private $table_name = "anuncios";
    
        // object properties
        public $id_anuncio;
        public $id_tipo_anuncio;
        public $id_vehiculo;
        public $id_vendedor;
        public $id_agencia;
        public $tipo_usuario;
        public $titulo;
        public $precio;
        public $Descripcion;
        public $imagen_destacada;
        public $fecha_creado;
        public $condicion_vehiculo;
        public $estado;
        public $ciudad;
        public $propietarios;
        public $fecha_cierre;
        public $estado_anuncio;
        public $anuncio_pagado;
        public $precio_anuncio_pagado;
        public $metodo_pago;
        public $imagen_anuncio;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }



        // --------------------------------------
        // GET All Anuncios For Debug
        // --------------------------------------

        function getAll() {
            // Call Stored Procedure
            $stmt = $this->conn->prepare("CALL listAnunciosAll()");
            // call the stored procedure
            $stmt->execute();
        
            return $stmt;
        }



        // --------------------------------------
        // Get Anuncios Count
        // --------------------------------------
        function getAnunciosCount( ) {
             // Call Stored Procedure
             $stmt = $this->conn->prepare("CALL getAnunciosCount()");
             // call the stored procedure
             $stmt->execute();
         
             return $stmt;
        }



        // --------------------------------------
        // GET Anuncios Count With Pagination &&
        // All Params
        // --------------------------------------
        function getAnunciosCountWithAllParams($tipo, $modelo, $marca, $ubicacion, $precioBase, $precioTope) {
            // Define Pagination settings
                // $results_per_page = $itemsPerPage;
                // $start_from = ($currentPage-1) * $results_per_page;

            // Set SP

                $stmt = $this->conn->prepare('CALL getAnunciosCountAllParams(:tipo, :modelo, :marca, :estado, :precioBase, :precioTope)');

            // set Tipo Value
                if($tipo === 'Autos')
                    $tipoValue = 'auto';
                else if($tipo === 'motos')
                    $tipoValue = 'moto';
                else
                    $tipoValue = 'clasico';
            

            // Bind Parameters
                $stmt->bindParam(':tipo', $tipoValue, PDO::PARAM_STR);
                $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
                $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
                $stmt->bindParam(':estado', $ubicacion, PDO::PARAM_STR);
                $stmt->bindParam(':precioBase', $precioBase, PDO::PARAM_STR);
                $stmt->bindParam(':precioTope', $precioTope, PDO::PARAM_STR);

            
         
            // Call Stored Procedure
        
                $stmt->execute();

               
         
            return $stmt;
        }



        // --------------------------------------
        // GET Anuncios Count With Pagination &&
        // OPtional  Params
        // http://localhost:8080/SR_seminuevos/backendFinal/WS/Anuncios/getAllAnunciosWithParams.php?tipo=nan&marca=Cadillac&modelo=nan&ubicacion=nan&precioBase=nan&precioTope=nan&page=1&items=6&sortBy=highDate
        // http://localhost:8080/SR_seminuevos/backendFinal/WS/Anuncios/getAnunciosCountAllParams.php?tipo=nan&marca=Cadillac&modelo=nan&ubicacion=nan&precioBase=nan&precioTope=nan
        // --------------------------------------
        function getAnunciosCountOptParams($tipo, $marca, $modelo, $estado, $precioBase, $precioTope) {
            
           
            // if Data has nan transform to null

            
            if($marca == 'nan') 
                $marca = null;
            if($modelo == 'nan') 
                $modelo = null;
            if($marca == 'nan') 
                $marca = null;
            if($estado == 'nan') 
                $estado = null;
            if($precioBase == 'nan') 
                $precioBase = null;
            if($precioTope == 'nan') 
                $precioTope = null;



              // set Tipo Value
                if($tipo === 'Autos')
                    $tipoValue = 'auto';
                else if($tipo == 'nan') 
                    $tipoValue = null;
                else if($tipo === 'motos')
                    $tipoValue = 'moto';
                else
                    $tipoValue = 'clasico';
            

         
            // Call Stored Procedure

            // echo $precioBase;

            $stmt = $this->conn->prepare("CALL getAnunciosCountWithOptionalParams(:tipo, :marca, :modelo, :estado, :precioBase, :precioTope)");
            $stmt->bindParam(':tipo', $tipoValue, PDO::PARAM_STR);
            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
            $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':precioBase', $precioBase, PDO::PARAM_STR);
            $stmt->bindParam(':precioTope', $precioTope, PDO::PARAM_STR);
            


            // var_dump($stmt);
             // call the stored procedure
                $stmt->execute();

               
         
             return $stmt;
        }





        // --------------------------------------
        // GET All Anuncios With Pagination
        // --------------------------------------
        function getAnunciosPagination($currentPage, $itemsPerPage, $sortByOption) {
            // Define Pagination settings
                $results_per_page = $itemsPerPage;
                $start_from = ($currentPage-1) * $results_per_page;

                // echo $start_from;

            // Define OrderBy Filter


                switch($sortByOption) {
                    case  'lowPrice' : 
                    // echo $sortByOption;
                            $stmt = $this->conn->prepare("CALL getAnunciosByLowPrice(:startPage,:endPage)");
                                $stmt->bindParam(':startPage', $start_from, PDO::PARAM_INT);
                                $stmt->bindParam(':endPage', $results_per_page, PDO::PARAM_INT);
                            break;
                    case  'HighPrice' : 
                    // echo $sortByOption;
                            $stmt = $this->conn->prepare("CALL getAnunciosByHighPrice(:startPage,:endPage)");
                                $stmt->bindParam(':startPage', $start_from, PDO::PARAM_INT);
                                $stmt->bindParam(':endPage', $results_per_page, PDO::PARAM_INT);
                            break;
                    default : 
                        // echo $results_per_page;
                        $stmt = $this->conn->prepare("CALL getAnunciosPag(:startPage, :endPage, :sortBy)");
                            $stmt->bindParam(':startPage', $start_from, PDO::PARAM_INT);
                            $stmt->bindParam(':endPage', $results_per_page, PDO::PARAM_INT);
                            $stmt->bindParam(':sortBy', $sortByOption, PDO::PARAM_STR);
              
                }

         
            // Call Stored Procedure
         

             // call the stored procedure
                $stmt->execute();

                // var_dump($stmt);
         
             return $stmt;
        }


        
        // --------------------------------------
        // GET All Anuncios With Pagination BY User
        // --------------------------------------
        function getAnunciosByuser($searchCat, $correo_usuario, $currentPage, $itemsPerPage) {
            // Define Pagination settings
                $results_per_page = $itemsPerPage;
                $start_from = ($currentPage-1) * $results_per_page;

                

                $stmt = $this->conn->prepare("CALL getAnunciosByUser(:searchCat, :mailToSearch,  :startPage, :endPage)");
                $stmt->bindParam(':searchCat', $searchCat, PDO::PARAM_STR);  
                $stmt->bindParam(':mailToSearch', $correo_usuario, PDO::PARAM_STR);
                $stmt->bindParam(':startPage', $start_from, PDO::PARAM_INT);
                $stmt->bindParam(':endPage', $results_per_page, PDO::PARAM_INT);
                            

         
            // Call Stored Procedure
         

             // call the stored procedure
                $stmt->execute();

                // var_dump($stmt);
         
             return $stmt;
        }


        // --------------------------------------
        // GET All Anuncios With Pagination BY User
        // --------------------------------------
        function getAnunciosCountByuser($searchCat, $correo_usuario) {
            

                

                $stmt = $this->conn->prepare("CALL getAnuciosCountByUser(:searchCat, :mailToSearch)");
                $stmt->bindParam(':searchCat', $searchCat, PDO::PARAM_STR);  
                $stmt->bindParam(':mailToSearch', $correo_usuario, PDO::PARAM_STR);
               
                            

         
            // Call Stored Procedure
         

             // call the stored procedure
                $stmt->execute();

                // var_dump($stmt);
         
             return $stmt;
        }




       
        // --------------------------------------
        // GET Anuncios With Estado Filter
        // --------------------------------------
        function getAnunciosWithEstadoFilterAndNoParams($estadosFilter, $marcasFilter, $startYearFilter, $endYearFilter,  $currentPage, $itemsPerPage, $sortByOption) {

             // Define Pagination settings
                $results_per_page = $itemsPerPage;
                $start_from = ($currentPage-1) * $results_per_page;
                $sortedQuery = '';
                $whereClause = '';

            // set Where clause 
                if($estadosFilter !== '' && $marcasFilter !== '' ) {
                    $whereClause = $estadosFilter." AND ". $marcasFilter. " AND vehiculos.year >= {$startYearFilter} AND vehiculos.year <= {$endYearFilter} " ;

                    // echo $whereClause;
                }
                else if($estadosFilter === '' && $marcasFilter !== '') {
                    $whereClause = $marcasFilter. " AND vehiculos.year >= {$startYearFilter} AND vehiculos.year <= {$endYearFilter} " ;
                }

                else if($estadosFilter !== '' && $marcasFilter == '') {
                    $whereClause = $estadosFilter. " AND vehiculos.year >= {$startYearFilter} AND vehiculos.year <= {$endYearFilter} " ;
                }
                else if($estadosFilter == '' && $marcasFilter == '' && $startYearFilter > 0 && $endYearFilter > 0) {
                    $whereClause = "vehiculos.year >= {$startYearFilter} AND vehiculos.year <= {$endYearFilter} " ;

                }

               

            // Set Query
                
                $query = " SELECT anuncios.id as 'id_anuncio', 
                            anuncios.titulo, 
                            tipo_anuncio.tipo_anuncio,
                            anuncios.Descripcion as shortDescription,
                            anuncios.imagen_destacada,
                            anuncios.precio,
                            vehiculos.id,
                            vehiculos.year,
                            vehiculos.kilometraje,
                            vehiculos.equipamento,
                            vehiculos.transmision,
                            vehiculos.estilo_carroceria,
                            anuncios.created_at
                    FROM `anuncios` 
                        INNER JOIN vehiculos 
                            ON vehiculos.id =  anuncios.id_vehiculo
                        INNER JOIN tipo_anuncio
                            ON tipo_anuncio.id = anuncios.id_tipo_anuncio WHERE " .$whereClause."
                        ORDER BY tipo_anuncio.prioridad";
                   
                   
        // Sort Options
                    switch($sortByOption) {
                        case  'tituloAsc' : 
                        // echo $sortByOption;
                                $sortedQuery = $query.", anuncios.titulo LIMIT {$start_from}, {$results_per_page} ";
                                   
                                break;
                        case  'highDate' : 
                        // echo $sortByOption;
                                $sortedQuery = $query.", anuncios.created_at LIMIT {$start_from}, {$results_per_page} ";
                                break;

                        case 'tituloDesc' : 
                        // echo $sortByOption;
                                $sortedQuery = $query.", anuncios.created_at DESC LIMIT {$start_from}, {$results_per_page} ";
                                break;
                        case  'lowPrice' : 
                        // echo $sortByOption;
                                $sortedQuery = $query.",  anuncios.precio ASC LIMIT {$start_from}, {$results_per_page} ";   
                                break;
                        case  'HighPrice' : 
                        // echo $sortByOption;
                                $sortedQuery = $query.",  anuncios.precio DESC LIMIT {$start_from}, {$results_per_page} ";   
                        default : 
                            $sortedQuery = $query.", anuncios.titulo LIMIT {$start_from}, {$results_per_page} ";
                  
                    }

                   
                 
                // echo $sortedQuery;

                // prepare query statement
                $stmt = $this->conn->prepare($sortedQuery);
                // // execute query
                $stmt->execute();
                return $stmt;


                
        }





        // --------------------------------------
        // GET All Anuncios Details
        // --------------------------------------
        function getAnuncioDetails($id_anuncio) {
            // Call Stored Procedure
            $id = $id_anuncio;
            $stmt = $this->conn->prepare('CALL getAnuncioDetails(:id)');
            // $stmt->bindParam(1, 1, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);


            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }



        
        // --------------------------------------
        // GET All Anuncios Details
        // --------------------------------------
        function getAnuncioDetailsEdit($id_anuncio) {
            // Call Stored Procedure
            $id = $id_anuncio;
            $stmt = $this->conn->prepare('CALL getAnuncioDetailsEdit(:id)');
            // $stmt->bindParam(1, 1, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);


            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }


        // --------------------------------------
        // GET All Images BY Anuncio
        // --------------------------------------
        function getImagenesAnuncio($id_anuncio) {
            // Call Stored Procedure
            $id = $id_anuncio;
            $stmt = $this->conn->prepare('CALL getImagenesAnuncio(:id)');
            // $stmt->bindParam(1, 1, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);


            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }

        // --------------------------------------
        // GET Related anuncios By Marca
        // --------------------------------------
        function getRelatedAnunciosByMarca($relatedMarca) {

            

            // Call Stored Procedure
            $stmt = $this->conn->prepare('CALL getRelatedAnunciosByMarca(:relatedMarca)');
            // $stmt->bindParam(1, 1, PDO::PARAM_STR);
            $stmt->bindParam(':relatedMarca', $relatedMarca, PDO::PARAM_INT);


            // call the stored procedure
            $stmt->execute();
            return $stmt;
        }



        /* ==========================================================================
        ** Query With Params
        ** ========================================================================== */

            
        // --------------------------------------
        // GET All Anuncios With Pagination &&
        // All Params
        // --------------------------------------
        function getAnunciosPaginationWithAllParams($tipo, $modelo, $marca, $ubicacion, $precioBase, $precioTope, $currentPage, $itemsPerPage, $sortByOption) {
            // Define Pagination settings
                $results_per_page = $itemsPerPage;
                $start_from = ($currentPage-1) * $results_per_page;

            // Set SP

                $stmt = $this->conn->prepare('CALL getAllAnunciosWithAllParams(:tipo, :modelo, :marca, :estado, :precioBase, :precioTope, :startPage, :endPage, :sortBy)');

            // set Tipo Value
                if($tipo === 'Autos')
                    $tipoValue = 'auto';
                else if($tipo === 'motos')
                    $tipoValue = 'moto';
                else
                    $tipoValue = 'clasico';
            

            // Bind Parameters
                $stmt->bindParam(':tipo', $tipoValue, PDO::PARAM_STR);
                $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
                $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
                $stmt->bindParam(':estado', $ubicacion, PDO::PARAM_STR);
                $stmt->bindParam(':precioBase', $precioBase, PDO::PARAM_STR);
                $stmt->bindParam(':precioTope', $precioTope, PDO::PARAM_STR);

                $stmt->bindParam(':startPage', $start_from, PDO::PARAM_INT);
                $stmt->bindParam(':endPage', $results_per_page, PDO::PARAM_INT);
                $stmt->bindParam(':sortBy', $sortByOption, PDO::PARAM_STR);


                
         
            // Call Stored Procedure
        
                $stmt->execute();

               
         
            return $stmt;
        }


        // --------------------------------------
        // GET All Anuncios With Pagination
        // --------------------------------------
        function getAnunciosPaginationOptParams($tipo, $marca, $modelo, $estado, $precioBase, $precioTope, $currentPage, $itemsPerPage, $sortByOption) {


            // if Data has nan transform to null
                if($marca == 'nan') 
                    $marca = null;
                if($modelo == 'nan') 
                    $modelo = null;
                if($marca == 'nan') 
                    $marca = null;
                if($estado == 'nan') 
                    $estado = null;
                if($precioBase == 'nan') 
                    $precioBase = null;
                if($precioTope == 'nan') 
                    $precioTope = null;



            // set Tipo Value
                if($tipo === 'Autos')
                    $tipoValue = 'auto';
                else if($tipo == 'nan') 
                    $tipoValue = null;
                else if($tipo === 'motos')
                    $tipoValue = 'moto';
                else
                    $tipoValue = 'clasico';
            

            // Define Pagination settings
                $results_per_page = $itemsPerPage;
                $start_from = ($currentPage-1) * $results_per_page;

            

            // Define OrderBy Filter


                switch($sortByOption) {
                    case  'lowPrice' : 
                    // echo $sortByOption;
                            $stmt = $this->conn->prepare("CALL getAnunciosWithOptionalParamsLowPrice(:tipo, :marca, :modelo, :estado, :precioBase, :precioTope, :startPage, :endPage)");
                                $stmt->bindParam(':tipo', $tipoValue, PDO::PARAM_STR);
                                $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
                                $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
                                $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
                                $stmt->bindParam(':precioBase', $precioBase, PDO::PARAM_STR);
                                $stmt->bindParam(':precioTope', $precioTope, PDO::PARAM_STR);
                                $stmt->bindParam(':startPage', $start_from, PDO::PARAM_INT);
                                $stmt->bindParam(':endPage', $results_per_page, PDO::PARAM_INT);
                                
                            break;
                    case  'HighPrice' : 
                    // echo $sortByOption;
                            $stmt = $this->conn->prepare("CALL getAnunciosWithOptionalParamsHighPrice(:tipo, :marca, :modelo, :estado, :precioBase, :precioTope, :startPage, :endPage)");
                            $stmt->bindParam(':tipo', $tipoValue, PDO::PARAM_STR);
                            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
                            $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
                            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
                            $stmt->bindParam(':precioBase', $precioBase, PDO::PARAM_STR);
                            $stmt->bindParam(':precioTope', $precioTope, PDO::PARAM_STR);
                            $stmt->bindParam(':startPage', $start_from, PDO::PARAM_INT);
                            $stmt->bindParam(':endPage', $results_per_page, PDO::PARAM_INT);
                            break;
                    default : 
                            $stmt = $this->conn->prepare("CALL getAnunciosWithOptionalParams(:tipo, :marca, :modelo, :estado, :precioBase, :precioTope, :startPage, :endPage, :sortBy)");
                            $stmt->bindParam(':tipo', $tipoValue, PDO::PARAM_STR);
                            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
                            $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
                            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
                            $stmt->bindParam(':precioBase', $precioBase, PDO::PARAM_STR);
                            $stmt->bindParam(':precioTope', $precioTope, PDO::PARAM_STR);
                            $stmt->bindParam(':startPage', $start_from, PDO::PARAM_INT);
                            $stmt->bindParam(':endPage', $results_per_page, PDO::PARAM_INT);
                            $stmt->bindParam(':sortBy', $sortByOption, PDO::PARAM_STR);
        
                        // echo $results_per_page;
                            // $stmt = $this->conn->prepare("CALL getAnunciosPag(:startPage, :endPage, :sortBy)");
                            // $stmt->bindParam(':startPage', $start_from, PDO::PARAM_INT);
                            // $stmt->bindParam(':endPage', $results_per_page, PDO::PARAM_INT);
                            // $stmt->bindParam(':sortBy', $sortByOption, PDO::PARAM_STR);
              
                }

         
          
            // call the stored procedure
                $stmt->execute();

                
         
             return $stmt;
        }




    /* ==========================================================================
    ** POST Requests
    ** ========================================================================== */


        // --------------------------------------
        // Create new Anuncio
        // --------------------------------------

        function createAnuncio($anuncio) {
            // echo (json_encode($anuncio));


            $stmt = $this->conn->prepare('CALL crear_Anuncio(:id_tipo_anuncio, :id_vehiculo, :id_vendedor, :id_agencia, :estado, :ciudad, :tipo_usuario, :titulo, :precio, :Descripcion, :imagen_destacada, :fecha_creado,:condicion_vehiculo, :propietarios, :fecha_cierre, :estado_anuncio, :anuncio_pagado, :precio_anuncio_pagado, :metodo_pago)');
                                            //  crear_Anuncio`(@p0, @p1, @p2, @p3, @p4, @p5, @p6, @p7, @p8, @p9, @p10, @p11, @p12, @p13, @p14, @p15, @p16, @p17, @p18)
            $stmt->bindParam(':id_tipo_anuncio', $anuncio->id_tipo_anuncio, PDO::PARAM_INT);
            $stmt->bindParam(':id_vehiculo', $anuncio->id_vehiculo, PDO::PARAM_INT);
            $stmt->bindParam(':id_vendedor', $anuncio->id_vendedor, PDO::PARAM_INT);
            $stmt->bindParam(':id_agencia', $anuncio->id_agencia, PDO::PARAM_INT);
            $stmt->bindParam(':estado', $anuncio->estado, PDO::PARAM_INT);
            $stmt->bindParam(':ciudad', $anuncio->ciudad, PDO::PARAM_INT);
            $stmt->bindParam(':tipo_usuario', $anuncio->tipo_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':titulo', $anuncio->titulo, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $anuncio->precio, PDO::PARAM_STR);
            $stmt->bindParam(':Descripcion', $anuncio->Descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':imagen_destacada', $anuncio->imagen_destacada, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_creado', $anuncio->fecha_creado, PDO::PARAM_STR);
            $stmt->bindParam(':condicion_vehiculo', $anuncio->condicion_vehiculo, PDO::PARAM_STR);
            $stmt->bindParam(':propietarios', $anuncio->propietarios, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_cierre', $anuncio->fecha_cierre, PDO::PARAM_STR);
            $stmt->bindParam(':estado_anuncio', $anuncio->estado_anuncio, PDO::PARAM_STR);
            $stmt->bindParam(':anuncio_pagado', $anuncio->anuncio_pagado, PDO::PARAM_STR);
            $stmt->bindParam(':precio_anuncio_pagado', $anuncio->precio_anuncio_pagado, PDO::PARAM_STR);
            $stmt->bindParam(':metodo_pago', $anuncio->metodo_pago, PDO::PARAM_STR);

            


            if($stmt->execute()){
                

                $get_stmt = $this->conn->prepare("CALL getLastAnuncio()");
            
                $get_stmt->execute();
        

                $lastAnuncio = $get_stmt->fetch(PDO::FETCH_ASSOC);

        
                // echo (json_encode($lastAnuncio));
        

                return $lastAnuncio;


                // return true;
            }
            else
                return 0;
        }



        
        // --------------------------------------
        // Create new Anuncio
        // --------------------------------------

        function saveImage($anuncio) {
            // echo (json_encode($anuncio));


            $stmt = $this->conn->prepare('CALL saveAnuncioImages(:id_anuncio, :ruta_imagen)');
                                            
            $stmt->bindParam(':id_anuncio', $anuncio->id_anuncio, PDO::PARAM_INT);
            $stmt->bindParam(':ruta_imagen', $anuncio->imagen_anuncio, PDO::PARAM_STR);

            


            if($stmt->execute()){
                

                // $get_stmt = $this->conn->prepare("CALL saveAnuncioImages(:id_anuncio, :ruta_imagen)");
            
                // $get_stmt->execute();
        

                // $lastAnuncio = $get_stmt->fetch(PDO::FETCH_ASSOC);

        
                // // echo (json_encode($lastAnuncio));
        

                // return $lastAnuncio;


                return true;
            }
            else
                return false;
        }

          
                
    }


    
          
                
    





















       

        


    


?>