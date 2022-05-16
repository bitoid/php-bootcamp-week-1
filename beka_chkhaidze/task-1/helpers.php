<?php

$UPLOADS_FOLDER = "./uploads/";
$img_path = null;

function is_not_empty($str): bool {
    return isset($str) && !empty($str);
}

function is_alpha($str): bool {
    return preg_match("/^[A-Za-z0-9]*$/", $str);
}


function upload_img($img) {
    global $UPLOADS_FOLDER;
    global $img_path;

    // [$size, $name, $tmp_name ] = $img;

    $name = $img['name'];
    $tmp_name = $img['tmp_name'];
    $new_path = $UPLOADS_FOLDER . $name;

    if(!file_exists($UPLOADS_FOLDER))
        mkdir($UPLOADS_FOLDER,0755);

    if(move_uploaded_file($tmp_name, $new_path)) {
        $img_path = $new_path;
    }
}

function validate_image($sent,$img) {
    if (!$sent) return;
    if ($img['error']) {
        echo "<span class='form__error'>ატვირთეთ სურათი</span>";
        return;
    }

    $is_img_valid = (bool)getimagesize($img["tmp_name"]);

    if (!$is_img_valid)
        echo "<span class='form__error'>ატვირთეთ ვალიდური სურათი</span>";
    else upload_img($img);
}



function is_array_valid(array $data): bool {
    if (!is_array($data)) return false;

    $valid = false;


    foreach($data as $item) {
        $valid = is_not_empty($item) && is_alpha($item);

        if (!$valid) return false;
    }   

    return $valid;
}

function validate_input($sent,$string,$name = "სახელი") {
    if (!$sent) return;
    
    if (!is_not_empty($string))
        echo "<span class='form__error'>$name ცარიელია</span>";

    if (!is_alpha($string))
        echo "<span class='form__error'>$name უნდა შეიცავდეს მხოლოდ ასო-ბგებერს</span>";
}


?>