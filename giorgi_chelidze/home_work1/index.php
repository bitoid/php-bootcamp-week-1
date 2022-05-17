<?php

    $message = '';
    $fileName = '';
    $pageContent = '';

    if(isset($_POST['submit'])) {
        
        $allowedExtension = array('png', 'jpg', 'jpeg');

        if(!empty($_FILES['photo']['name'])) {

            $fileName = $_FILES['photo']['name'];
            $fileSize = $_FILES['photo']['size'];
            $fileTempName = $_FILES['photo']['tmp_name'];

            $targetDir = "images/" . $fileName;

            // Accessing file extensions of uploaded file 

            $fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));

            if(in_array($fileExtension, $allowedExtension)) {
                if($fileSize <= 1000000) {

                    move_uploaded_file($fileTempName, $targetDir);
                    

                } else {
                    $message = '<p class="warning" >FILE IS TOO LARGE</p>';
                }
            } else {
                $message = '<p class="warning" >THIS TYPE OF FILE IS NOT ALLOWED</p>';
            }

        } else {
            $message = '<p class="warning" >PHOTO IS REQUIRED</p>';
        }

        if($_POST['firstName'] && $_POST['lastName']) {
            if(!ctype_alpha($_POST['firstName']) || !ctype_alpha($_POST['lastName'])) {
                $message = '<p class="warning" >FIRSTNAME AND LASTNAME SHOULD CONTAIN LETTERS</p>';
            } else {
                $pageContent = "
                    <div class='box' >
                        <div>
                            <h1 class='full-name' >{$_POST['firstName']} {$_POST['lastName']}</h1>
                            <img class='photo' src='/images/$fileName' alt='$fileName' />
                        </div>
                    </div>
                ";
            }
        } else {
            $message = '<p class="warning" >FIRSTNAME AND LASTNAME IS REQUIRED</p>';
        }
    }

?>

<!-- <?php echo $_SERVER['PHP_SELF']; ?> -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>First Challenge</title>
        <link rel="stylesheet" type="text/css" href="styles/index.css" >
        <script src="https://use.fontawesome.com/3a2eaf6206.js"></script>
    </head>
    <body>

        <?php
            if($pageContent) {
                echo $pageContent;
            } else {
                echo '
                    <div class="box" >
                        <form class="form" action="index.php" method="POST" enctype="multipart/form-data" >
                            <input class="input-field" type="text" name="firstName" placeholder="Firstname" oninput="allowalph(this)" />
                            <input class="input-field" type="text" name="lastName" placeholder="Lastname" oninput="allowalph(this)"/>
                            
                            <label for="type-file" >
                                <i class="fa fa-2x fa-camera"></i>
                                <input class="upload-file-input" name="photo" type="file" id="type-file" />
                            </label>
                            
                            <input class="submit-button" type="submit" name="submit" value="Sign Up" />
                            <?php echo $message ?>
                        </form>
                    </div>
                ';
            }
        ?>
<script>
    function allowalph(element){
        let textInput = element.value
        textInput = textInput.replace(/[^A-Za-z]*$/gm, "")
        element.value = textInput
    }
</script>
    </body>
</html>