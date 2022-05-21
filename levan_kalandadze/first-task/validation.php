<?php
    require_once 'image.php';

    $name = "";
    $surname = "";
    
    if(ctype_alpha($_POST['fist_name'])){
        $name = $_POST['fist_name'];
    }

    if(ctype_alpha($_POST['last_name'])){
        $surname = $_POST['last_name'];
    }
   
    $errors = [];

    if(!$_POST['fist_name']){
        $errors[] = 'Name is required';
    }elseif(!ctype_alpha($_POST['fist_name'])){        
        $errors[] = 'Fist name should contains only alphabet characters';
    }
    

    if(!$_POST['last_name']){
        $errors[] = 'Last Name is required';
    }elseif(!ctype_alpha($_POST['last_name'])){
        $errors[] = 'Last name should contains only alphabet characters';
    }

    if(empty($_FILES["file"]["name"])){
        $errors[] = 'Picture is required';
    }elseif ($_FILES["file"]["type"] != "image/jpeg" && $_FILES["file"]["type"] != "image/jpg"
                                                     && $_FILES["file"]["type"] != "image/png"){
        $errors[] = "Only JPG, JPEG, PNG files are allowed";
    }

    if ($_FILES["file"]["size"] > 1000000) {
        $errors[] = "Your file size should be less than 1 MB";
      }
      
?>


    
