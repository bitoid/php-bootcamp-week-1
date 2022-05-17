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

    session_start();

    // Validating inputs

    if (isset($_POST['submit'])) {
        $_SESSION['first'] = $_POST['firstName'];
        $_SESSION['last'] = $_POST['lastName'];

        if ($_SESSION['first'] == '') {
            $_SESSION['firstname_error'] = 'First name: Empty';
        } else if (!preg_match("#^[a-zA-Z]+$#", $_SESSION['first'])) {
            $_SESSION['firstname_error'] = 'First name: Only letters allowed';
        } else {
            $_SESSION['firstname_error'] = '';
        }

        if ($_SESSION['last'] == '') {
            $_SESSION['lastname_error'] = 'Last name: Empty';
        } else if (!preg_match("#^[a-zA-Z]+$#", $_SESSION['last'])) {
            $_SESSION['lastname_error'] = 'Last name: Only letters allowed';
        } else {
            $_SESSION['lastname_error'] = '';
        }

        if (empty($_FILES['fileToUpload']['name'])) {
            $_SESSION['image_error'] = 'No image uploaded';
        } else {
            $_SESSION['filename'] = $_FILES['fileToUpload']['name'];
            if (!is_dir('upload')) {
                mkdir('upload');
            }
            $location = "upload/" . $_SESSION['filename'];
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $location);
            $_SESSION['image_error'] = '';
        }

        if ($_SESSION['firstname_error'] == '' && $_SESSION['lastname_error'] == '' && $_SESSION['image_error'] == '') {
            header('Location: result.php');
        } else {
            include "form.php";
        }
    } else {
        include "form.php";
    }



    ?>
</body>

</html>