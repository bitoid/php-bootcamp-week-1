<?php

$displeyInputs = true;

if(isset($_POST['submit'])) {
    if(preg_match("/^[A-Z]+$/", $_POST['name'].$_POST['lastname']) == 1) {
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $displeyInputs = false;
    } else {
        $erorr =  "you must to input letters that contains A-Z";
    }

    $fileName = $_FILES['image']['name'];   
    $fileTmpName = $_FILES['image']['tmp_name'];    

    move_uploaded_file($fileTmpName, 'image/'.$fileName);
}


