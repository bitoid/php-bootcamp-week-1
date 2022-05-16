<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Github Info</title>
</head>

<body>

    <style>
        <?php include "style.css" ?>
    </style>



    <?php

    echo '<div class="pagi">';
    for ($i = 0; $i < 6; $i++) {
        echo '<a href="#"><button>' . $i + 1 . '</button></a>';
    }
    echo '</div>';



    ?>
</body>

</html>