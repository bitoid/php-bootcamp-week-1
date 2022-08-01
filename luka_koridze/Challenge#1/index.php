<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){       
        $nameValid=true;
        $surnameValid=true;
        if (!preg_match ("/^[a-zA-z]*$/", $_POST['name']) ) {  
            $nameValid=false;
        }
        if (!preg_match ("/^[a-zA-z]*$/", $_POST['surname']) ) {  
            $surnameValid=false;
        }
        if(empty($_POST['name']) || !$nameValid){
            $name_error = "Please enter a valid name";
        }else{
            $name= $_POST['name'];
        }
        if(empty($_POST['surname']) || !$surnameValid){
            $surname_error = "Please enter a valid surname";
        }else{
            $surname= $_POST['surname'];
        }
        if(empty($_FILES['photo'])){
            $photo_error = "Please upload a photo";
        }else{
            $fileTempName= $_FILES['photo']['tmp_name'];
            $fileUpExt = explode(".",$_FILES['photo']['name']);
            $fileExt =   strtolower(end($fileUpExt));
            $fileName = uniqid('',true).".".$fileExt;
            $fileDestiation = './Data/'.$fileName;
            move_uploaded_file($fileTempName, $fileDestiation);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/reset.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Week 1</title>
</head>
<body>
    <form action="./index.php" method="POST" enctype="multipart/form-data">
        <label for="name">First Name</label>
        <input type="text" placeholder="Enter your first name" name='name' id="name">
        <span><?php if(isset($name_error)) echo $name_error  ?></span>
        <label for="surname">Last Name</label>
        <input type="text" placeholder="Enter your last name" name='surname' id="surname">
        <span><?php if(isset($surname_error)) echo $surname_error ?></span>
        <label class="file" for="photo">Upload Profile Picture</label>
        <span><?php if(isset($photo_error)) echo $photo_error ?></span>
        <input type="file" name='photo' id="photo">
        <button type="submit">Submit</button>
    </form>
    
    <?php if(isset($name) && isset($surname) && isset($fileDestiation)){ echo "<div><h1>$name $surname</h1><img src=$fileDestiation alt=''></div>";} ?>
</body>
</html>


    
