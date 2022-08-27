<?php
$name = $lastname = "";

$nameErr = $lastnameErr = $errorFile = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(empty($_POST["firstname"])){
        $nameErr = "required";
    }
        else{
            $name = $_POST["firstname"];

            if(!preg_match("/^[a-zA-Z-' ]*$/", $name)){
                $nameErr ="only letters";
            }
        }
       
        
     if(empty($_POST["lastname"])){
            $lastnameErr = "required";
        }
        else{
                $lastname = $_POST["lastname"];
    
            if(!preg_match("/^[a-zA-Z-' ]*$/", $name)){
                    $lastnameErr ="only letters";
                }
            }
     

            if(isset($_FILES['profileimage'])){
                $target_dir = getcwd() . "/uploads/";
                $porfile_image = basename($_FILES["profileimage"]["name"]);
                $allowed_ext = array("jpg" => "image/jpg",
                                    "jpeg" => "image/jpeg",
                                    "gif" => "image/gif",
                                    "png" => "image/png");
                $profile_image_url = NULL;
                $ext = pathinfo($porfile_image, PATHINFO_EXTENSION);
                if (!array_key_exists($ext, $allowed_ext)) {
                    $errorFile="please use JPG PNG JPEG GIF PNG";
                }
                if(in_array($_FILES["profileimage"]["type"], $allowed_ext)) {
                    if(!file_exists($target_dir)) {
                        mkdir($target_dir);
                    }
                    if(move_uploaded_file($_FILES["profileimage"]["tmp_name"], $target_dir . $porfile_image) ){
                        $profile_image_url = $target_dir.$porfile_image;
                    }
                } 
             }
            
}


    
    
    

	



?>
 




