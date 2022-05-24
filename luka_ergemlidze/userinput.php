<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>

</head>

<body class = "container">
    <?php if (empty($_POST)): ?>
        <form action="userinput.php" method="POST" enctype="multipart/form-data">
            <div class = "FirstPage">
                <input type = "text" name = "Fname" class = "Fname" placeholder = "Name" require /><br>
                <input type = "text" name = "Lname" class = "Lname" placeholder = "Surname" require /><br>
                <input type = "file" name = "image" class = "image" /><br>  
                <input type = "submit" name = "submit" class = "submit" />
            </div>
        </form>
    <?php else: ?>
        <?php
        $img = $_FILES['image']['name'];
        $imgPath = '';

        if(!file_exists('images')) {
            mkdir('images');
        }

        $imgPath = 'images/'.$img;
        move_uploaded_file($_FILES['image']['tmp_name'], $imgPath);
        ?>
        <?php if(isset($_POST['submit'])) { ?>
            <div class = "SecondPage">
            <img src="<?php print './' . $imgPath ?>" class = "UploadedImage">
            <h3 class = "FullName"><?php print $_POST['Fname'] . " " . $_POST['Lname'] ?></h3>
            </div>
        <?php } ?>
    <?php endif; ?>

</body>

</html>