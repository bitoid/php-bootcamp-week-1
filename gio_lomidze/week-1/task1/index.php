<?php
    include 'function.php';
    $validateInputs = [false,false,false];
?>
<!doctype HTML>
<html>
    <head>
        <meta content="width=device-width, user-scalable=no, initial-scale=1.0, minimal-ui" name='viewport'>
        <title>Submit form</title>
        <link href="css/reset.css" rel="stylesheet" type="text/css">        
        <link href="css/form.css" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class='wrapper'>
            <form action='' method='POST' enctype='multipart/form-data'>
            <h1>Submit the form below 👇</h1>
                <input type='text' name='firstName' placeholder='First Name' value=''>

                <?php 
                    if(isset($_POST['submit'])) {
                        if($_POST['firstName']) {
                            $cond = preg_match('/[\d]/',$_POST['firstName']);
                            validator($cond,'Incorrect first name');
                            if(!$cond) $validateInputs[0] = true;
                        } else {
                            $validateInputs[0] = false;
                            validator(true,'First name is required!');
                        }
                    }
                ?>

                <input type='text' name='lastName' placeholder='Last Name' value=''>

                <?php 
                    if(isset($_POST['submit'])) {
                        if($_POST['lastName']) {
                            $cond = preg_match('/[\d]/',$_POST['lastName']);
                            validator($cond,'Incorrect last name');
                            if(!$cond) $validateInputs[1] = true;
                        } else {
                            $validateInputs[1] = false;
                            validator(true,'Last name is required!');
                        }
                    }
                ?>
                
                <div class="custom_input_file">
                    <label class="lbl">Upload an image</label>
                    <input type='file' name='userImage' accept='image/*'>
                </div>

                <?php 
                    if(isset($_POST['submit'])) {
                        if($_FILES['userImage']['name']) {
                            $cond = !preg_match('/(\.jpg|\.png|\.bmp|\.jpeg|\.webp)$/i', $_FILES['userImage']['name']);
                            validator($cond,'File is NOT an image');
                            if(!$cond) $validateInputs[2] = true;
                        } else {
                            $validateInputs[2] = false;
                            validator(!$_FILES['userImage']['name'],'Image is required!');
                        }
                    }
                ?>

                <button type='submit' name='submit'>Submit</button>
            </form>
            <div class='result'>

                <?php
                    if(isset($_POST['submit'])) {
                        if($validateInputs[0] && $validateInputs[1] && $validateInputs[2]) {
                            print   '<p class="success">Your data was submitted successfully!</p>
                                    <p>First name: ' . $_POST['firstName'] . '</p>
                                    <p>Last name: ' . $_POST['lastName'] . '</p>';
                            $img = $_FILES['userImage'];
                            $dir = 'images/';
                            if(!is_dir($dir)) {
                                mkdir($dir,'0777',true);
                            }
                            $img_name = $dir . $_FILES['userImage']['name'];
                            $tmp_img_name = $_FILES['userImage']['tmp_name'];
                            move_uploaded_file($tmp_img_name, $img_name);
                            echo "<div class='img_wrap'><img src='$img_name' alt='$img_name'/></div>";
                        }
                    }
                ?>

            </div>
        </div>
    </body>
</html>