<?php
    /* ==========================================================================
    ** Email Creator Object Class
    ** 24/01/2019
    ** Alan Medina Silva
    ** ========================================================================== */
    class Emailer
    {
        var $recipients = array();
        var $EmailTemplate;
        var $EmailContents;
    
        public function __construct($to = false)
        {
            if($to !== false)
            {
                if(is_array($to))
                {
                    foreach($to as $_to){ $this->recipients[$_to] = $_to; }
                }else
                {
                    $this->recipients[$to] = $to; //1 Recip
                }
            }
        }
    
        function SetTemplate(EmailTemplate $EmailTemplate)
        {
            $this->EmailTemplate = $EmailTemplate;            
        }
    
        function send() 
        {
            $this->EmailTemplate->compile();
            //your email send code.

            echo json_encode($this->recipients);


            $to ='alanmedina43@gmail.com';
            $subject = "Test mail";  
            $message = "Hello! This is a simple email message.";  
            $from = "someonelse@example.com";  
            $headers = "From: $from";  
            // mail($to,$subject, $this->EmailTemplate->compile()  ,$headers);  
            mail($to,$subject,$message  ,$headers);  
            echo "Mail Sent.";  
        }
    }


?>