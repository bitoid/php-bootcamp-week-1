<?php
    require_once "./helpers.php";

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $image = $_FILES['image'];

    $sent = (bool)isset($_POST['send']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>დავალება #1</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <main class="container">
        <form action="." method="POST" enctype="multipart/form-data" class="form">
            <input type="text" name="first_name"  placeholder="სახელი" value="<?php echo $first_name; ?>" />
            <?php validate_input($sent,$first_name); ?>

            <input type="text" name="last_name"  placeholder="გვარი" value="<?php echo $last_name; ?>" />
            <?php validate_input($sent,$last_name,"გვარი"); ?>

            <input type="file" name="image" />
            <?php validate_image($sent,$image); ?>

            <input type="submit" value="send" name="send" />
        </form>

        <?php if (is_array_valid([$first_name,$last_name]) && $img_path) { ?>
            <article class="summary">
                <p class="summary__item">სახელი: <?php echo $first_name; ?></p>
                <p class="summary__item">გვარი: <?php echo $last_name; ?></p>
                <img src="<?php echo $img_path; ?>" alt="<?php echo $first_name ."'s picture"?>">
            </article>
        <?php } ?>
    </main>
</body>
</html>
