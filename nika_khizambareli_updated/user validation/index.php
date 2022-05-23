<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //initialing first values of variables
    $first_name = $last_name = "";
    $image = null;
    $image_path = "";
    $regex = "/^[a-zA-Z]+$/i";

    //reinitialing variable values after request is sent to the server

    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $image = $_FILES['image'];
    //creating directory for image ,if it doesnt exist and moveing uploaded file to that directory and reasigning image path
    if (!file_exists('images')) {
        mkdir('images');
    }
    if ($image) {
        $image_path = "./images/" . $image['name'];
        move_uploaded_file($image['tmp_name'], $image_path);
    }
    //creating simple validator for user info
    if (!empty($first_name) && !preg_match_all($regex, $first_name)) {
        $first_name = "invalid first name, field should contain only alphanumeric charecters";
    }elseif (empty($first_name)) {
        $first_name = "empty value, please fill up First Name field";
    }else{
        $first_name = $first_name;
    }
    if (!empty($last_name) && !preg_match_all($regex, $last_name)) {
        $last_name = "invalid last name, field should contain only alphanumeric charecters";
    }elseif (empty($last_name)) {
        $last_name = "empty value, please fill up Last Name field";
    }else{
        $last_name = $last_name;
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>

    <?php if (empty($_POST)) : ?>
        <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="register">register</div>
            <input type="text" id="fname" name="fname" aria-label="First Name" placeholder="first name">
            <input type="text" id="lname" name="lname" aria-label="Last name" placeholder="last name">
            <label for="image" class="icon">choose file</label>
            <input type="file" name="image" id="image">
            <button type="submit">submit</button>

        </form>
        </div>

    <?php else : ?>
       <div class="container">
       <div class="output">
            <p class="first_name"><?= "Name: " . $first_name; ?></p>
            <p class="last_name"><?= "Surname: " . $last_name; ?></p>
            <?php if (strlen($image_path) > 10) : ?>
                <div class="profile_picture"><img src="<?= $image_path ?>" alt="profile picture"></div>

            <?php else : ?>
                <p>no image file uploaded</p>

            <?php endif; ?>
        </div>
       </div>

    <?php endif; ?>



</body>

</html>