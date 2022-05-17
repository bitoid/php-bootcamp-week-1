<?php
$pdo = require 'database.php';

$errors = [];
$firstName = '';
$lastName = '';
$image = $_FILES['profile_picture'] ?? null;
$filePath = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $image =  $_FILES['profile_picture'];

    //validation
    if (!ctype_alpha($firstName)) {
        $errors[] = 'First name must be letters';
    }

    if (!ctype_alpha($lastName)) {
        $errors[] = 'Last name must be letters';
    }

    if (!is_dir('uploads')) {
        mkdir('uploads');
        if (!is_dir('uploads/images')) {
            mkdir('uploads/images');
        }
    }

    if ($image['name'] && empty($errors)) {
        $filePath = 'uploads/images/' . time() .'_'.$image['name'];
        move_uploaded_file($image['tmp_name'],$filePath);
    }


    //save to database
    if (empty($errors)) {
        $statement = $pdo->prepare(
            "INSERT INTO users (first_name, last_name, image) 
                        VALUES (:first_name, :last_name, :image )"
        );
        $statement->bindValue(':first_name', $firstName);
        $statement->bindValue(':last_name', $lastName);
        $statement->bindValue(':image', $filePath);
        $statement->execute();
        header('Location: index.php');
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Create</title>
</head>
<body>
<div class="d-flex justify-content-between col-6">
    <h4 class="p-2 bd-highlight">User Create</h4>
    <a class="p-2 btn btn-success mb-2 mt-2" href="index.php">List</a>
</div>
<hr class="col-6" style="">
<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <?php
        foreach ($errors as $error) : ?>
            <?= $error ?> <br>
        <?php
        endforeach; ?>
    </div>
<?php endif; ?>
<div class="form-group col-6 mx-3">
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col d-flex">
                <div class="col">
                    <label>First Name</label>
                    <input type="text" class="form-control mt-2" placeholder="First name" name="first_name" value="<?= $firstName ?>">
                </div>
            </div>
            <div class="col d-flex">
                <div class="col">
                    <label>Last Name</label>
                    <input type="text" class="form-control mt-2" placeholder="Last name" name="last_name" value="<?= $lastName ?>">
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <label>Profile picture</label>
            <input type="file" class="form-control-file" name="profile_picture" placeholder="Profile Picture">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>