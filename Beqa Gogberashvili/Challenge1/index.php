<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
</style>

<body>

    <?php

    $errors = [];
    $first_name = '';
    $last_name = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];

        $image = $_FILES['image'] ?? null;
        $imagepath = '';

        // Input validation

        if (!$first_name) {
            $errors[] = 'First Name: Empty';
        }

        if ($first_name && !preg_match("#^[a-zA-Z]+$#", $first_name)) {
            $errors[] = 'First Name: Only letters allowed';
        }

        if (!$last_name) {
            $errors[] = 'Last Name: Empty';
        }

        if ($last_name && !preg_match("#^[a-zA-Z]+$#", $last_name)) {
            $errors[] = 'Last Name: Only letters allowed';
        }

        // Image validation

        if ($_FILES['image']['size'] == 0) {
            $errors[] = 'No image uploaded';
        }

        if ($image) {
            if (!is_dir('upload')) {
                mkdir('upload');
            }
            move_uploaded_file($image['tmp_name'], 'upload/' . $image['name']);
        }

        // Submitting form

        if (empty($errors)) : ?>
            <h1><?php echo $first_name ?></h1>
            <h1><?php echo $last_name ?></h1>
            <img src="/upload/<?php echo $_FILES['image']['name'] ?>" alt="Image" width="400px" height="400px" style="object-fit: cover"><br>
            <a href="./index.php">Back</a>

        <?php endif;
    }

    // Errors

    if (!empty($errors)) : ?>

        <div class="alert">
            <?php foreach ($errors as $error) : ?>
                <div><?php echo $error ?></div>
            <?php endforeach ?>
        </div>

    <?php endif ?>

    <?php

    //Default form

    if (empty($_POST) || !empty($errors)) : ?>

        <form method="post" enctype="multipart/form-data">
            <input type="text" name="first_name" value="<?php echo $first_name ?>">
            <input type="text" name="last_name" value="<?php echo $last_name ?>">
            <input type="file" name="image" accept="image/png, image/gif, image/jpeg">
            <input type="submit" name="submit">
        </form>

    <?php endif ?>


</body>

</html>