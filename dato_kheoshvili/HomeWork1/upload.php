<?php

    //variables for validations and erros.
    $name_errors = [
        "nameEmpty" => "Name should be min 2 character",
        "azAZ" => "No numbers or special characters allowed",
        "name_size" => "Maximum 50 character allowed"
    ];
    
    $email_errors = [
        "emailEmpty" => "Email is required",
        "format" => "Please, check your spelling and follow this format example@example.ex",
        "email_size" => "Maximum 50 character allowed"
    ];

    //variables for name and email
    $name = "";
    $email = "";
    //print_r arrays looking better in browser
    function prnt($array){
        echo '<pre>';
        print_r($array);
        echo '<pre>';
    }

    //takes array of errors as parameter. Checks validations for'name' elements and returns array of actual erros.
    //if all validation finished succesfuly returns empty array. 
    function name_validations($name_errors){
        $tmp_errors = [];
        
        if(strlen($_POST["name"]) < 2){
            array_push($tmp_errors, $name_errors["nameEmpty"]);
        } else if(strlen($_POST["name"]) > 50){
            array_push($tmp_errors, $name_errors["name_size"]);

        } else if(!preg_match("/^[a-z]{2,}$/i", $_POST["name"])){
            array_push($tmp_errors, $name_errors["azAZ"]);
        }

        return $tmp_errors;
    }
    
    function email_validations($email_errors){
        $tmp_errors = [];
        
        if(strlen($_POST["email"]) < 1){
            array_push($tmp_errors, $email_errors["emailEmpty"]);
        } else if(strlen($_POST["email"]) > 50){
            array_push($tmp_errors, $email_errors["email_size"]);

        } else if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $_POST["email"])){
            array_push($tmp_errors, $email_errors["format"]);
        }
        return $tmp_errors;
    }
    
    function pic_validations(){
        $tmp_errors = [];
        $errorMatch = match($_FILES["pic"]["error"]){
            0 => "",
            1 => "File can not be larger than 100mb",
            2 => "File can not be larger than 10mb",
            3 => "The uploaded file was only partially uploaded.",
            4 => "No file was uploaded.",
            //5 => "The file uploaded with success.",
            6 => "Missing a temporary folder.",
            7 => "Failed to write file to disk."
        };
        if($errorMatch){
            array_push($tmp_errors, $errorMatch);
        } else if(!(preg_match("/\.jpg$/", $_FILES["pic"]['name']) || preg_match("/\.jpeg$/", $_FILES["pic"]['name']))){
            array_push($tmp_errors, "No allowed file extension");
        }
        
        return $tmp_errors;
    }
    

    //prnt(name_validations($name_errors));
    //prnt(email_validations($email_errors));
    //prnt(pic_validations());
    $error_list = [];
    $error_list = array_merge(name_validations($name_errors),email_validations($email_errors),pic_validations());
    
    
    
    

?>