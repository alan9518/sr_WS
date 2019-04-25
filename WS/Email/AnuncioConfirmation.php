<?php
    /* ==========================================================================
    ** Send Contact Mail to Vendedor
    ** 24/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */

    //Import the PHPMailer class into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;

    require '../vendor/autoload.php';


//Create a new PHPMailer instance
    $mail = new PHPMailer;



        
        

        $email = 'alanmedina437@gmail.com';
        
        
        // $data[ 'nombreCliente' ] = $_POST[ 'nombreCliente' ];
        // $data[ 'emailCliente' ] = $_POST[ 'emailCliente' ]; 
        

        
        $data[ 'anuncio' ]  = 'anuncio';
        $data[ 'emailCliente' ]  = 'alanmedina437@gmail.com' ; 
        
        
        
        
        // $mail->Subject = 'Anuncio Creado';
        $mail->setFrom('info@srseminuevos.com', 'Sr Seminuevos'); 
        $mail->addAddress('alanmedina437@gmail.com', 'Alan Medina');
        
        $mail->Subject = 'Anuncio '.$data['anuncio']. ' Creado.';


        // var_dump($mail);

        $mail->msgHTML( renderTemplate( '../emailTemplate/srseminuevos-email-confirmacion.php', $data ), dirname( __FILE__ ) );
        $mail->AltBody = 'Tu anuncio '.$data['anuncio']. 'Ha sido Creado con Éxito.';
        
        if ( ! $mail->send() ) {

            $resultsArray = array();
            $resultsArray['message'] =  "Mailer Error: " . $mail->ErrorInfo;
            
            echo (json_encode($resultsArray));
            
        } else {
            $resultsArray = array();
            $resultsArray['message'] =  'Email Sent';

            echo (json_encode($resultsArray));
        }
        



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