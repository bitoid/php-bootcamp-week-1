<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nameValid = true;
    $lastnameValid = true;
    if (!preg_match("/^[a-zA-z]*$/", $_POST['name'])) {
        $nameValid = false;
    }
    if (!preg_match("/^[a-zA-z]*$/", $_POST['lastname'])) {
        $lastnameValid = false;
    }
    if (empty($_POST["name"]) || !$nameValid) {
        $name_error = "Please enter a valid name";
    } else {
        $name = $_POST['name'];
    }
    if (empty($_POST["lastname"]) || !$lastnameValid) {
        $lastname_error = "Please enter a valid lastname";
    } else {
        $lastname = $_POST['lastname'];
    }
    if (empty($_FILES['picture'])) {
        $photo_error = "Please upload picture";
    } else {
        $fileTempName = $_FILES['picture']['tmp_name'];
        $fileUpExt = explode(".", $_FILES['picture']['name']);
        $fileExt =   strtolower(end($fileUpExt));
        $fileName = uniqid('', true) . "." . $fileExt;
        $fileDestiation = './Data/' . $fileName;
        move_uploaded_file($fileTempName, $fileDestiation);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./reset.css">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>

<body>
    <form action="./index.php" method="POST" enctype="multipart/form-data">
        <label for="name">Your First Name</label>
        <input type="text" placeholder="Enter your first name" id="name" name="name">
        <span><?php if (isset($name_error)) echo $name_error ?> </span>
        <label for="lastname">Your Last Name</label>
        <input type="text" placeholder="Enter your last name" id="lastname" name="lastname">
        <span><?php if (isset($lastname_error)) echo $lastname_error ?> </span>
        <label for="picture" class="picture">Upload Your Profile Picture</label>
        <span><?php if (isset($picture_error)) echo $picture_error ?></span>
        <input type="file" name="picture" id="picture">
        <button type="submit">Submit</button>
    </form>
</body>
<?php if (isset($name) && isset($lastname) && isset($fileDestiation)) {
    echo "<div><h1>$name $lastname</h1><img src=$fileDestiation alt=''></div>";
} ?>
</body>

</html>