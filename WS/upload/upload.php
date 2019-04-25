<?php
    /* ==========================================================================
    ** Upload Dropzone Files
    ** 24/03/2019
    ** Alan Medina Silva
    ** ========================================================================== */

     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
     header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
     header('P3P: CP="CAO PSA OUR"'); // Makes IE to support cookies
    //  header("Content-Type: application/json; charset=utf-8");
    $target_dir = "../../uploads/";

    
    // var_dump ($_GET['file']);

    if(isset($_FILES['file'])){
    // if(isset($_GET['files'])){

        $errors= array();
        $file_name = $_FILES['file']['name'];
        $file_size =$_FILES['file']['size'];
        $file_tmp =$_FILES['file']['tmp_name'];
        $file_type=$_FILES['file']['type'];

        // Get Extension Name
        $tmp = explode('.', $file_name);
        $file_ext = strtolower(end($tmp));


        $target_file = $target_dir . basename($_FILES["file"]["name"]);

       

        $filename = $target_dir.'/'.time().'-'.$_FILES['file']['name'];

       
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 2097152){
           $errors[]='File size must be excately 2 MB';
        }
        
        if(empty($errors)==true){
        
            move_uploaded_file($file_tmp, $filename);
        

            $response=array(
                "status" => "sucess",
                "url" => $target_file
            );
        

            echo (json_encode($response));
        }else{
           print_r($errors);
        }
     }
     else {
         echo "No Image";
     }

     








    // $target_dir = "upload/";

    // var_dump ($_FILES);

    

        // $target_file = $target_dir . basename($_FILES["File"]["name"]);


        // echo $target_file;

        // $uploadOk = 1;
        // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // // echo $imageFileType;

        // // Check if image file is a actual image or fake image
        // // if(isset($_POST["submit"])) {
        //     $check = getimagesize($_FILES["File"]["tmp_name"]);
        //     if($check !== false) {
        //         // echo "File is an image - " . $check["mime"] . ".";
        //         $uploadOk = 1;
        //     } else {
        //         // echo "File is not an image.";
        //         $uploadOk = 0;
        //     }


        //     $tmpFile = $_FILES['file']['tmp_name'];
        //     $filename = $target_dir.'/'.time().'-'. $_FILES['file']['name'];
        //     move_uploaded_file($tmpFile,$filename);
    

        // if( $_FILES['file']['error'] ==0) {
        //     $response=array(
        //         "status" => true,
        //         "message" => "Successfully upload",
        //     );
        //     // echo (json_encode($response));

        //     echo "File is an image - ";
        // }
        // else{
        //     $response=array(
        //         "status" => false,
        //         "message" => "erorr on upload",
        //     );

        //     // echo (json_encode($response));

        //     echo "File is NO image - ";
        // }
        

        // // echo $_FILES['file']['error'];

  
?>