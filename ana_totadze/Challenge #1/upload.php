<html lang="en">
<head>
	<link rel="stylesheet" href="./demo.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&family=Radio+Canada:wght@300&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <title>File Upload</title>
</head>

<?php

if(isset($_POST["name"]) and isset($_POST["last-name"]) and isset($_POST["submit"])){   
    $name = $_POST["name"];

    $lastName = $_POST["last-name"];
    $fullName = $name . " " . $lastName;

    $file = $_FILES["file"];

    $fileName = $_FILES["file"]["name"];
    $fileTmpName = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $fileError = $_FILES["file"]["error"];
    $fileType = $_FILES["file"]["type"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = ["jpg", "jpeg", "png"];

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0) {
            if($fileSize < 1000000){
                $fileNameNew = uniqid("", true).".".$fileActualExt;
                # Created a folder in the current directory, called "uploads"
                $fileDestination = "uploads/".$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                echo "<div class='output-container'>";
                if(preg_match("/^[A-Za-z]+$/", $name) and preg_match("/^[A-Za-z]+$/", $lastName)){
                    echo "<h1>$fullName</h1>";
                    echo "<img src=$fileDestination>"; 
                } else {
                    echo "<p id='invalid-input'>INVALID INPUT</p>";                     
                }
                echo "</div>";
                
            } else {
                echo "File is too large";
            }
        } else {
            echo "There was an error uploading your file.";
        }
    } else {
        echo "Unsupported file format";
    }
}