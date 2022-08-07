<?php 
    $name = $lastname = "";
    $nameErr = $lastnameErr =$errorFile= "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
          $nameErr = "Name is required";
        } else {
          $name = $_POST["name"];
          
          if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
          }
        }
        if(empty($_POST["lastname"])){
            $lastnameErr = "Last Name is required";
        } else {
            $lastname = $_POST["lastname"];
            
            if(!preg_match("/^[a-zA-Z-' ]*$/",$lastname)){
                $lastnameErr = "Only letters and white space allowed";
            }
        }
    }
    
    if(isset($_FILES['added_photo'])){
        $target_dir = getcwd() . "/uploads/";
        $porfile_image = basename($_FILES["added_photo"]["name"]);
        $allowed_ext = array("jpg" => "image/jpg",
                            "jpeg" => "image/jpeg",
                            "gif" => "image/gif",
                            "png" => "image/png");
        $profile_image_url = NULL;
        $ext = pathinfo($porfile_image, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed_ext)) {
            $errorFile="please use JPG PNG JPEG GIF PNG";
        }
        if(in_array($_FILES["added_photo"]["type"], $allowed_ext)) {
            if(!file_exists($target_dir)) {
                mkdir($target_dir);
            }
            if(move_uploaded_file($_FILES["added_photo"]["tmp_name"], $target_dir . $porfile_image) ){
                $profile_image_url = $target_dir.$porfile_image;
            }
        }  
        
       
    }
    
            
    ?>