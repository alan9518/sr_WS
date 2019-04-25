<?php
    /* ==========================================================================
    ** Send Contact Mail to Vendedor
    ** 24/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */

    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
	header('P3P: CP="CAO PSA OUR"'); // Makes IE to support cookies
	header("Content-Type: application/json; charset=utf-8");

    //Import the PHPMailer class into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;

    require '../vendor/autoload.php';


//Create a new PHPMailer instance
    $mail = new PHPMailer;

        
        $data[ 'nombreVendedor' ] = isset($_POST['nombreVendedor']) ? $_POST['nombreVendedor'] : die();
        $data[ 'mailVendedor' ] =  isset($_POST['mailVendedor']) ? $_POST['mailVendedor'] : die();
        $data[ 'nombreCliente' ] = isset($_POST['nombreCliente']) ? $_POST['nombreCliente'] : die();
        $data[ 'emailCliente' ] = isset($_POST['emailCliente']) ? $_POST['emailCliente'] : die(); 
        $data[ 'telCliente' ] = isset($_POST['telCliente']) ? $_POST['telCliente'] : die();  
        $data[ 'message' ] = isset($_POST['message']) ? $_POST['message'] : die();  
        $data[ 'anuncio' ] = isset($_POST['anuncio']) ? $_POST['anuncio'] : die();  

      
        
        
        // $mail->Subject = 'Anuncio Creado';
        $mail->setFrom('info@srseminuevos.com', 'Sr Seminuevos'); 
        $mail->addAddress( $data[ 'mailVendedor' ],   $data[ 'nombreVendedor' ]);
        
        $mail->Subject = 'Solicitud de Contacto Anuncio '.$data['anuncio'];


        // var_dump($mail);

        $mail->msgHTML( renderTemplate( '../emailTemplate/srseminuevos-email-contactarvendedor.php', $data ), dirname( __FILE__ ) );
        $mail->AltBody = 'Thank you for contacting us';
        
        if ( ! $mail->send() ) {

            $resultsArray = array();
            $resultsArray['message'] =  "Mailer Error: " . $mail->ErrorInfo;
            
            // print_r(json_encode($resultsArray));
            
        } else {
            $resultsArray = array();
            $resultsArray['message'] =  'Email Sent';

            // print_r(json_encode($resultsArray));

        }

        print_r(json_encode($resultsArray));
        



    /* ==========================================================================
    ** Read Email Template And Variables
    ** ========================================================================== */
        function renderTemplate( $file, $data ) {
            if ( ! file_exists( $file ) ) {
                trigger_error( 'renderTemplate: file does not exist' );
                exit;
            }
        
            extract( $data );
        
            ob_start();
        
            include($file);
        
            $content = ob_get_clean();
        
            return $content;
        }