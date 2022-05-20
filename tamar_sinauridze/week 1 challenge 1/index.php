<?php
$errors = [];
if(!empty($_POST)) {
    require_once("validations.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <?php if(!empty($_POST) && !empty($errors)): ?>
                <p class="errmsg">Form was not uploaded</p>
            <?php endif ?>

            <?php if(empty($_POST) || !empty($errors)): ?>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <label for="first-name">First name:</label>
                    <input type="text" id="first-name" name="first_name" placeholder="Enter your first name"
                    pattern="[a-zA-Z]{1,}" title="English letters only" required>
                    <span class="errmsg"><?php echo $errors["first_name"]?? '' ?></span>
                    <label for="last-name">Last name:</label>
                    <input type="text" id="last-name" name="last_name" placeholder="Enter your last name"
                    pattern="[a-zA-Z]{1,}" title="English letters only" required>
                    <span class="errmsg"><?php echo $errors["last_name"]?? '' ?></span>
                    <label for="picture">Picture:</label>
                    <input type="file" id="picture" name="userpic" title="Upload JPG, JPEG, PNG or GIF file. Up to 5MB" required>
                    <span class="errmsg"><?php echo $errors["picture"]?? '' ?></span>
                    <input type="submit" name="submit">
                </form>
            <?php endif ?>

            <?php if (!empty($_POST) && empty($errors)) : ?>
                <p>Successfully submitted:</p>
                <p>Name:</p>
                <h2><?php echo $_POST["first_name"] . ' ' . $_POST["last_name"]?></h2>
                <p>Picture:</p>
                <img src="<?php echo $target_file ?>" alt="User image">
            <?php endif ?>
        </div>
    </body>
</html>
