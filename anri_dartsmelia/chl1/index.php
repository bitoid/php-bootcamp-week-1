<?php
if (isset($_FILES['img'])) {
    if ($_FILES['img']['error'] == 0) {
        $errors = array();
        $file_name = $_FILES['img']['name'];
        $file_size = $_FILES['img']['size'];
        $file_tmp = $_FILES['img']['tmp_name'];
        $file_type = $_FILES['img']['type'];
        $tmp = explode('.', $file_name);
        $path = "upload/";

        $file_ext = end($tmp);

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        move_uploaded_file($file_tmp, $path . $file_name);
    } else {
        $errors[] = "Please Upload Image!";
    }

    $name = $_POST["name"];
    $surname = $_POST["surname"];

    if ($surname == "" && $name == "") {
        $errors[] = "Please input your first and last names";
    } else if ($surname == "") {
        $errors[] = "Please input your last name";
    } elseif ($name == "") {
        $errors[] = "Please input your first name";
    } else {
        if (!ctype_alpha($name)) {
            $errors[] = "Name must only contain letters!";
        }

        if (!ctype_alpha($surname)) {
            $errors[] = "Surname must only contain letters!";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Challange 1</title>
</head>

<body>

    <div class="wrapper">
        <div class="before">
            <form action="index.php" method="post" class="inputForm" enctype="multipart/form-data">

                <div class="formElement">
                    <label for="name">First Name</label>
                    <input type="text" id="name" name="name" placeholder="Jhon">
                </div>

                <div class="formElement">
                    <label for="surname">Last Name</label>
                    <input type="text" id="surname" name="surname" placeholder="Doe">
                </div>

                <div class="formElement">
                    <label for="img">Profile Picture<img src="src/images/upload.png" alt="upload icon" class="icon"> </label>
                    <input type="file" id="img" name="img" hidden>
                </div>

                <button type="submit">Submit Form</button>

            </form>
        </div>
    </div>

    <?php if (isset($_FILES['img']) && empty($errors) == true) : ?>
        <div class="after" style="background-color: #f2e9e4; border-radius: 10px; min-width: 40vw; max-width: 80vw; min-height: 40vh; max-height: 60vh; -webkit-box-shadow: 5px 5px 15px -5px #c9ada7; box-shadow: 5px 5px 15px -5px #c9ada7; display: flex; justify-content: flex-start; align-items: center; margin-left: 20px;">
            <div class="imgContainer">
                <img src="<?php echo $path . $file_name ?>" alt="" class="profileImg" width="200px" height="200px" style="border-radius: 50%; padding: 20px;">
            </div>

            <div class="textContainer" style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-left: 10px;">
                <p>Inputed First Name: <span style="color: green;"><?php echo $name ?></span></p>
                <p>Inputed Last Name: <span style="color: green;"><?php echo $surname ?></span></p>
            </div>

        </div>

    <?php elseif (empty($errors) == false) : ?>
        <div class="after" style="background-color: #f2e9e4; border-radius: 10px; min-width: 40vw; max-width: 80vw; min-height: 40vh; max-height: 60vh; -webkit-box-shadow: 5px 5px 15px -5px #c9ada7; box-shadow: 5px 5px 15px -5px #c9ada7; display: flex; justify-content: center; align-items: center; margin-left: 20px; color:red; flex-direction: column;">
            <?php foreach ($errors as $err) : ?>
                <p><?php echo $err ?></p>
            <?php endforeach ?>
        </div>

    <?php endif ?>

</body>

</html>
