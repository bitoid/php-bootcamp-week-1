<?php
        $filename=$_FILES['file']["name"];
        $tempname=$_FILES['file']["tmp_name"];
        $firstname=$_POST['FirstName'];
        $lastname=$_POST['lastName'];

        if(!is_dir("img")){
            mkdir("img");
        }
        $folder="img/".$filename;
        move_uploaded_file($tempname, $folder);