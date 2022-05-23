<?php require "function.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section id="form-section">
    <form action= "" method="POST" enctype="multipart/form-data">
            <input class="name_class" type="text" name="FirstName"  placeholder="First name"  />
            <input class="name_class" type="text" name="lastName"  placeholder="Last name"  />
            <input type="file" name="file" id="image-upload" accept=".jpg, .jpeg,.png"  />
            <button type="submit" name="submit" value="upload">submit</button>
        </form>
    </section>
    <section id="php_section">      
        <?php if (!empty($_FILES["file"]) && isset($_POST['FirstName']) && isset($_POST['lastName'])){
                    include_once "upload.php";                    
                    if(empty($filename) || empty($firstname) || empty($lastname)){ ?> 
                        <p class='error_msg'> wrong format, empty field error </p>
                    <?php  }else{
                        chekingalphabet($firstname, $lastname);?>                   
                        <p id='initials'> <?php echo $firstname."  ".$lastname;  ?> </p>        
                        <img id='img' src='<?php echo $folder;?>'>           
            <?php  }?>          
        <?php   }?>              
 </section>

</body>
</html>

