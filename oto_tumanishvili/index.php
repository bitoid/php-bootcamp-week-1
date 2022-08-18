<?php
    $name = '';
    $lastName = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'] ?? null;
        $lastName = $_POST['lastName'] ?? null;
        $img = $_FILES['image'] ?? null;
        
        $errors = [];

        if (!$name) {
            $errors[] = 'Name is required';
        }

        if (!preg_match ("/^[a-zA-z]*$/", $name) ) {
            $errors[] = 'Please enter valid name';
        }

        if(!$lastName){
            $errors[] = 'Lastname is required';
        }

        if (!preg_match ("/^[a-zA-z]*$/", $lastName) ) {
            $errors[] = 'Please enter valid lastname';
        }

        if(!$img || $img['size'] == 0){
            $errors[] = 'Image upload is required';
        } else {
            $imagePath = 'img/'.$img['name'];
            move_uploaded_file($img['tmp_name'], $imagePath);
        }

        if(!is_dir('img')) {
            mkdir('img');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php if(empty($_POST) || !empty($errors)): ?>
            <form action="/index.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $name ?>" class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="lastName">Lastname</label>
                    <input type="text" name="lastName" id="lastName" value="<?php echo $lastName ?>" class="form-control" placeholder="Enter your lastname">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <input type="submit" name="submit" class="submit">
            </form>
        <?php endif; ?>

        <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)): ?>
            <h1><?php echo "$name $lastName" ?></h1>
            <img src="<?php echo $imagePath ?>" alt="profile-photo">
        <?php endif; ?>

        <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <div><?php echo $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>