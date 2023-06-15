<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="hello.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form class="box"action="hello.php" method="post" enctype="multipart/form-data">
        <h1>login</h1>
        <input type="text1" pattern="[A-Za-z]+" name="name1"placeholder="first name">
        <input type="text2" pattern="[A-Za-z]+" name="name2"placeholder="last name">
        <input type="file" name="pic" class="file-input">
        <input type="submit" name="submit">
        <?php 
        $var = "hello";
        // if submit clicked
        if(isset($_POST['submit'])){
            //if firstname is empty
            if(empty($_POST['name1'])){
                echo "<h3 style='color: white;'>fill name</h3>";
            }
            //if firstname or lastname contains numbers
            if(!preg_match("/^[a-zA-Z\s]+$/", $_POST['name1']) || !preg_match("/^[a-zA-Z\s]+$/", $_POST['name2'])){
                echo "<h3 style='color: white;'>you can use only characters</h3>";
            }
            //if lastname is empty
             if(empty($_POST['name2'])){
                echo "<h3 style='color: white;'>fill surname</h3>";
            }  

            $first = $_POST['name1'];
            $second = $_POST['name2'];
            $image = $_POST['pic'];
            //Stores the filename as it was on the client computer.
            $imagename = $_FILES['pic']['name'];
            //Stores the filetype e.g image/jpeg
            $imagetype = $_FILES['pic']['type'];
            //Stores any error codes from the upload.
            $imageerror = $_FILES['pic']['error'];
            //Stores the tempname as it is given by the host when uploaded.
            $imagetemp = $_FILES['pic']['tmp_name'];
            $imagePath = "images/";
            //if image uploaded check if...
            if(is_uploaded_file($imagetemp)) {
                if ($_FILES["pic"]["size"] > 1500000) {?>
                    <h2 style='color: white;'>Sorry, your file is too large. max size is 1.5MB</h2>;
                    
                <?php }
                
                // last move when everythink is right
                else if(move_uploaded_file($imagetemp, $imagePath . $imagename) &&(!empty($_POST['name1']))&&(preg_match("/^[a-zA-Z\s]+$/", $_POST['name2'])&&preg_match("/^[a-zA-Z\s]+$/", $_POST['name1']))&&(!empty($_POST['name2']))) {?>
                    
                    <h2 style='color: white;'>name: <?php echo $first ?> </h2>
                    <h2 style='color: white;'>surname: <?php echo $second ?> </h2>
                    
                    <img src='<?php echo $imagePath.$imagename ?>' style='max-height:300px; max-width: 500px'>
                    
                    <?php
                    
                }else{ ?>
                    <h2>ulpoad image</h2>

               
                <?php }
       
            }
    

        }
        ?>
    </form>


   
 








</body>
</html>