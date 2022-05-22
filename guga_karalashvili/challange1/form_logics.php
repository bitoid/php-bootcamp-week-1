<?php
$first_name = '';
$last_name = '';
$profile_photo =[];
$errors = [
    'first_name_empty'=>null,
    'last_name_empty'=>null,
    'first_name_validation'=>null,
    'last_name_validation'=>null,
    'image_empty'=>null
];
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $first_name = $_POST['first_name'];
    $last_name =$_POST['last_name'];
    $profile_photo = $_FILES['profile_photo'];
    if($profile_photo['error'] == 0){
        if(!file_exists('images')){
            mkdir('images');
        }
        move_uploaded_file($profile_photo['tmp_name'],'images/' . $profile_photo['name']);
        $profile_photo_url = './images/' . $profile_photo['name'];
    }else {
        $errors['image_empty'] = "Please upload image";
        if($first_name && $last_name){
            $_POST = null;
        }
    }
}

function check_validation($str)
{
    if(preg_match('/[^A-Za-z]/',$str)){
        return true;
    }
}

if((!$first_name || !$last_name) && $_POST != null){
    if($first_name == null){
        $errors["first_name_empty"]= "First name is required";
    }
    if($last_name == null){
        $errors["last_name_empty"]= "Last name is required";
    }
    $_POST = null;
}
if(check_validation($first_name)){
    $errors["first_name_validation"]= "Your First name must contains only alphabet characters!!!";
    $first_name = '';
    $_POST = null;
}
if(check_validation($last_name)){
    $errors["last_name_validation"]= "Your Last name must contains only alphabet characters!!!";
    $last_name = '';
    $_POST = null;
}
?>