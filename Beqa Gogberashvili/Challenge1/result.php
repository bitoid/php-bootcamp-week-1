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
    <title>Form Result</title>
</head>

<?php session_start(); ?>

<body>
    <div class="main">
        <div class="output">
            <img src="./upload/<?php echo $_SESSION['filename'] ?>" alt="myImage" width="400px" height="400px" style="object-fit: cover">
            <h1><?php echo $_SESSION['first'] ?> <?php echo $_SESSION['last'] ?></h1>
        </div>
        <a href="./index.php"><button class="another">Another one</button></a>
    </div>

</body>

</html>