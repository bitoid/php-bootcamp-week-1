<?php


    function emptyInput($name,$lastname,$image){
        $result = false;
        if(empty($name) || empty($lastname) || empty($image) ){
            $result = true; 
        } 
        else {
            $result = false;
        } 
        return $result;
    }
    function invalidName($name){
        $result = false;
        if(empty($name) || !preg_match("/^[a-zA-Z0-9]*$/", $name)){
            $result = true; 
        } 
        else {
            $result = false;
        } 
        return $result;
    }
    function invalidLastName($lastname){
        $result = false;
        if(empty($lastname) || !preg_match("/^[a-zA-Z0-9]*$/", $lastname)){
            $result = true; 
        } 
        else {
            $result = false;
        } 
        return $result;
    }
    
    
 