
<?php
$firstname = $lastname = "";

$name_error = $last_error = $file_error = "";



if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(empty($_POST["firstname"])){
        $name_error = "Please fill in the name field";
    }
        else{
            $firstname = $_POST["firstname"];

            if(!ctype_alpha($_POST['firstname'])){
                $name_error ="it is an invalid firstname";
            }
        }
       
        if(empty($_POST["firstname"])){
          $last_error = "Please fill in the lastname field";
      }
          else{
              $firstname = $_POST["firstname"];
  
              if(!ctype_alpha($_POST['lastname'])){
                  $name_error ="it is an invalid lastname";
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
                    $file_error="please choose image";
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


    
    