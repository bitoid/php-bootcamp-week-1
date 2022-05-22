<?php

validate_text("first_name");
validate_text("last_name");
validate_picture();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validate_text($name) {
    global $errors;
    if(empty($_POST[$name])) {
        $errors[$name] = "This field is required";
    } else if (!preg_match("/^[a-zA-Z]*$/",$_POST[$name])) {
        $errors[$name] = "Only English letters allowed";
    } else {
        $_POST[$name] = test_input($_POST[$name]);
    }
}

function create_directory($dir_name) {
    if (!is_dir($dir_name)) {
        $oldmask = umask(0);
        mkdir($dir_name, 0777);
        umask($oldmask);
    }
}

function validate_picture() {
    global $errors, $target_file;
    if(empty($_FILES["userpic"]["name"])) {
        $errors["picture"][] = "Picture required";
    } else {
        create_directory("uploads");
        $target_file = "uploads/" . basename($_FILES["userpic"]["name"]);
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if(getimagesize($_FILES["userpic"]["tmp_name"]) === false) {
            $errors["picture"][] = "File is not an image";
        } 
        if ($_FILES["userpic"]["size"] > 5242880) {
            $errors["picture"][] = "File is too large";
        }
        if($image_file_type !="jpg" && $image_file_type !="png" && $image_file_type !="jpeg" && $image_file_type !="gif"){
            $errors["picture"][] = "Only JPG, JPEG, PNG & GIF files are allowed";
        }
    }
    if(empty($errors)) {
        $picture_moved = move_uploaded_file($_FILES["userpic"]["tmp_name"], $target_file);
        if(!$picture_moved){
            $errors["picture"][] = "There was an error uploading your file";
        }
    }
    if(isset($errors["picture"])) {
        $errors["picture"] = implode(". ", $errors["picture"]);
    }
}
?>
