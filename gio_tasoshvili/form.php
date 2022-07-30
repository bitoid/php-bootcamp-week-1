<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
    <h1> Please Fill These Forms </h1>
    <form action="form.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name" required/>
            <input type="text" name="surname" placeholder="Surname" required>
            <input type="file" name="image" required>
            <input type="submit" name="submit" />  
    </section>
    </form>    
</body>
</html>



<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    if($_POST['name'] && $_POST['surname']){
        if(ctype_alpha($_POST['name'])=='true' && ctype_alpha($_POST['surname'])=='true'){
                

                $image=$_FILES['image']?? null;

                if(!is_dir('images')){
                    mkdir('images');
                }
                if($image){
                    $imagePath= 'images/'. $image['name'];
                    move_uploaded_file($image['tmp_name'], $imagePath);     
                    ?>
                    <figure class="personal-info">
                        <figcaption class="name-surname">
                            <?php print $_POST['name']. ' ' .$_POST['surname'] .'<br>'; ?>
                        </figcaption>
                        <img src="<?php echo'images/'.$image['name'] ?> " width=300px alt="Your Image"> 
                    </figure>
                    <?php
                  } 
        }else{
            $letterError = "Please Fill Tabs in Latin Letters Only (A-Z)";
            echo $letterError;
        }
    }
    }
?>
</html>  