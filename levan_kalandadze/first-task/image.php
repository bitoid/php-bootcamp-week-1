<?php
    
    if(!empty($_FILES["file"]["name"])){
        $img_source = null;

        if(!is_dir($image_dir)){
            mkdir("images");
        }
    
        $image_dir = "images/";
        $image_name = $_FILES["file"]["name"];
    
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $image_dir . $image_name)){
            $img_source = $image_dir . $image_name;
        } 
    }

?> 
