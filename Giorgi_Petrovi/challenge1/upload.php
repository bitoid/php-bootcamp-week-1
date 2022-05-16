<?php
function upload_image($file) {

    if(!file_exists('images/')) {
        mkdir('images', 0777);
    }

    $file_tmp_name = $file['tmp_name'];
    $name = md5_file($file_tmp_name);

    if (!move_uploaded_file($file_tmp_name, __DIR__ . '/images/' . $name . '.jpg')) {
        die('Somethings is wrong!');
    } else {
        return "/images/".$name.'.jpg';
    }  
}

?>
