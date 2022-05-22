<!doctype HTML>
<html>

<head>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class="formContainer">
        <?php
        //$notSubmitedWell = true;

        //if (isset($_FILES['pic']) && isset($_FILES['pic']['error']) && !$_FILES['pic']['error'] && $_POST['name'] && $_POST['email']) {
        //     $notSubmitedWell = false;
        // }

        if (!isset($_POST['submit']) || $error_list) : ?>
            <form class="form" action="" method="POST" enctype="multipart/form-data">
                <input class="forminput formitem" type="text" name="name" /><br />
                <input class="forminput formitem" type="email" name="email" /><br />
                <input class="forminput formitem" type="hidden" name="MAX_FILE_SIZE" value="300000" />
                <input class="forminput formitem" type="file" name="pic" /><br>
                <input class="formbutton formitem" type="submit" name="submit" value="Upload">
            </form>
        <?php endif; ?>

    </div>

    <?php
    require_once("validation.php");

    if (isset($_POST['submit'])) {
        if (!$error_list) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            move_uploaded_file($_FILES['pic']["tmp_name"], "uploads/" . $_FILES["pic"]["name"]);
        }
    }
    ?>
    <?php if ($error_list) : ?>
        <ul class="errorList">
            <?php foreach ($error_list as $key => $value) : ?>
                <li class="listItem"><?php echo $value; ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif; ?>

    <?php
    //var_dump('<img src= "uploads/"'.$_FILES["pic"]["name"].'/>');   
    if (!$notSubmitedWell) : ?>
        <div class="card">
            <img class="cardImg" src=uploads/<?php $_FILES["pic"]["name"] ?> />
            <div class="cardInfo">
                <h4>Hi <p><?php echo $name; ?></p>
                </h4>
                <h4>Your email is <p><?php echo $email; ?>$</p>
                </h4>
            </div>
        </div>
    <?php endif ?>
</body>

</html>