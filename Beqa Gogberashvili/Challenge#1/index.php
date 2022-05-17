<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Simple Form</title>
</head>

<body>

    <?php

    // Saving default form inside variable

    $form = '<div class="main">
        <div class="form">
            <h1>Who are you?</h1>
            <form method="post" enctype="multipart/form-data">
                <ul class="form-items">
                    <li><input type="text" name="firstName" placeholder="First Name"></li>
                    <li><input type="text" name="lastName" placeholder="Last Name"></li>
                    <li><label class="custom-file-upload">
                    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/png, image/gif, image/jpeg">
                    <img src="./upload.png" width="20px" style="object-fit: cover; vertical-align:middle">
                    Upload Image
                </label></li>
                    <li><input type="submit" name="submit" class="butt" value="Submit"></li>
                </ul>
            </form>
        </div>
    </div>';

    // Validating inputs

    if (isset($_POST['submit'])) {
        $first = $_POST['firstName'];
        $last = $_POST['lastName'];
        switch ($first && $last) {
            case '':
                echo $form;
                echo '<script>alert("Warrning: Fill both names")</script>';
                break;
            case !preg_match("#^[a-zA-Z]+$#", $first):
                echo $form;
                echo '<script>alert("Warrning: Only letters allowed")</script>';
                break;
            case !preg_match("#^[a-zA-Z]+$#", $last):
                echo $form;
                echo '<script>alert("Warrning: Only letters allowed")</script>';
                break;
            default:

                // Uploading image

                if (empty($_FILES['fileToUpload']['name'])) {
                    echo $form;
                    echo '<script>alert("Warrning: No image uploaded")</script>';
                } else {
                    $filename = $_FILES['fileToUpload']['name'];
                    if (!is_dir('upload')) {
                        mkdir('upload');
                    }
                    $location = "upload/" . $filename;
                    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $location);

                    // Echo result

                    echo '<div class="main">
                    <div class="output">
                        <img src="./upload/' . $filename . '" alt="myImage" width="400px" height="400px" style="object-fit: cover">
                        <h1>' . $first . ' ' . $last . '</h1>
                    </div>
                    <a href="./index.php"><button class="another">Another one</button></a>
                    </div>';
                }
                break;
        }
    } else {
        // Echo out default form
        echo $form;
    }


    ?>
</body>

</html>