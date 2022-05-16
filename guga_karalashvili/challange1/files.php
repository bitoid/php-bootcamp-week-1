<?php
if(!is_dir('images')){
    mkdir('images');
}
$dirs = scandir('./');
    foreach($dirs as $dir){
        if($dir == 'images'){
            $files = glob('images/*');
            foreach($files as $file){
                if($file == $image){
                    unlink($file);
                }
            }
        }
    }
?>