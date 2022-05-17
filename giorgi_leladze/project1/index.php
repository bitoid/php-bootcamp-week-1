<?php
    $firstNameError = ""; // variables to save error messages
    $lastNameError = "";
    $imgFileError = "";
    $imagesExp = ['jpg', 'jpeg', 'png']; // allowed exp for images

    function renderSubmitedForm($img, $fname, $lname){
        print "
            <div class='submited_form-message'>
                <img src='$img'>
                <h1>$fname</h1>
                <h2>$lname</h2>
            </div>";
    }


    function checkFile($file, $allowed){
        // take elements from file array
        $fileName = $file["name"];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExp = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExp));

        // validations of file
        if($fileSize == 0) {
            $imgFileError = "you should chose picture to submit";
            return false;
        }
        if(!in_array($fileActualExt, $allowed)) {
            $imgFileError = "you can't upload files of this type";
            return false;
        }
        if($fileError !== 0) {
            $imgFileError = "there was an errror uploading your file";
            return false;
        }
        // uncommenting this will limit how much you can upload
        // if($fileSize > 1000000) {
        //     $imgFileError = "file is too big";
        //     return false;
        // }
        return true; // if any validation faill return false. else return true
    }

    function checkData($data){
        return ctype_alpha(trim($data));
    }

    if($_POST['firstname'] || $_POST["lastname"]){
        $bool = true; //default true. if any validation error --> set it to false
        
        if(!checkData($_POST['firstname'])) {
            $firstNameError = "invalid first name";
            $bool = false;
        }
        if(!checkData($_POST['lastname'])) {
            $lastNameError = "invalid last name";
            $bool = false;
        }

        if(!checkFile($_FILES['userImage'], $imagesExp)) {
            $bool = false;
        }

        if($bool) { // if bool variable is true this mean all validation was passed
            $fileTmpName = $_FILES['userImage']['tmp_name'];
            $fileExp = explode('.', $_FILES['userImage']['name']);
            $fileActualExt = strtolower(end($fileExp));

            $fileNameNew = uniqid('', true).".".$fileActualExt; // generate new name
            $fileDestination = "uploads/".$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination); // apload to "uploads" folder

            renderSubmitedForm($fileDestination, $_POST["firstname"], $_POST["lastname"]);
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form action="/index.php" method="post" enctype="multipart/form-data">

            <input class="input-text" type="text" name="firstname" placeholder="First Name">
            <span> <?php if($firstNameError) echo $firstNameError ?> </span>

            <input class="input-text" type="text" name="lastname" placeholder="Last Name">
            <span> <?php if($lastNameError) echo $lastNameError ?> </span>

            <input class="input-img" type="file" name="userImage">
            <span> <?php if($imgFileError) echo $imgFileError ?></span>

            <button class="btn" type="submit" name="submit">Submit Form</button>
        </form>
    </div>
</body>
</html>
