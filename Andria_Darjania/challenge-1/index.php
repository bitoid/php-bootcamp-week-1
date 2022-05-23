<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "validation.php";
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $error = validation($first_name, $last_name);

        if (!file_exists("images")) {
            mkdir("images");
        } 
        $picture_address = "images/" . $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        move_uploaded_file($tmp, $picture_address);
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/styles/main.css" rel="stylesheet">
        <title>Upload Image</title>
    </head>
    <body class="front">
        <?php if ($_SERVER["REQUEST_METHOD"] == "GET" || !is_null($error)): ?>
        <div class="container">
            <form action="/index.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <label>
                        First Name
                        <input autocomplete="off" type="text" name="firstname" placeholder="First Name" pattern="[A-Za-z]+" title="Use only letters" required>            
                    </label>
                    <label>
                        Last Name 
                        <input autocomplete="off" type="text" name="lastname" placeholder="Last Name" pattern="[A-Za-z]+" title="Use only letters" required>
                    </label>
                    <label>
                        Profile Picture
                    <input type="file" name="file" required>
                    </label>
                    <input class="btn btn-alt" type="submit" name="submit" value="Upload">
                    <?php if (!is_null($error)): ?>
                        <div class="validation"><?= $error ?></div>
                    <?php endif ?>
                </fieldset>
            </form>
        </div>
        <?php else: ?> 
            <h1><?= "$first_name $last_name" ; ?></h1>
            <img class="uploaded" src="<?= $picture_address ?>" alt=Profle photo>
        <?php endif ?>
    </body>
</html>