<!-- 
    Fixed multiple if statements
    Split html and php (stringed part)
-->

<html lang="en">
<head>
	<link rel="stylesheet" href="./demo.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&family=Radio+Canada:wght@300&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <title>File Upload</title>
</head>

<?php

if(isset($_POST["name"]) && isset($_POST["last-name"]) && isset($_POST["submit"])){   


    $file = $_FILES["file"];

    $fileName = $_FILES["file"]["name"];
    $fileType = $_FILES["file"]["type"];
    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = ["jpg", "jpeg", "png"];

    $fileError = $_FILES["file"]["error"];

    if(in_array($fileActualExt, $allowed)){
        checkErrors($fileError);
    } else {
        echo "Unsupported file format";
    }
}

function checkErrors($fileError){
    $fileSize = $_FILES["file"]["size"];

    if($fileError === 0) {
        checkFileSize($fileSize);
    } else {
        echo "There was an error uploading your file.";
    }
}

function checkFileSize($fileSize){
    if($fileSize < 1000000){
        moveFileToDestination();
    } else {
        echo "File is too large";
    }
}

function moveFileToDestination(){
    $fileName = $_FILES["file"]["name"];
    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $fileTmpName = $_FILES["file"]["tmp_name"];

    $name = $_POST["name"];
    $lastName = $_POST["last-name"];
    $fullName = $name . " " . $lastName;

    $fileNameNew = uniqid("", true).".".$fileActualExt;
        # Created a folder in the current directory, called "uploads"
        $fileDestination = "uploads/".$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
    ?>
        <div class='output-container'>
            <?php if(preg_match("/^[A-Za-z]+$/", $name) && preg_match("/^[A-Za-z]+$/", $lastName)): ?>
                <h1><?php print $fullName ?></h1>
                <img src=<?php print $fileDestination ?>
            <?php else: ?>
                <p id="invalid-input">INVALID INPUT</p>                     
            <?php endif; ?>
        </div>
<?php } ?>