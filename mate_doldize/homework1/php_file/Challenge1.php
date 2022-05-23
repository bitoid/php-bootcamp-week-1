<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/style.css">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
</head>
<body>
<?php

$foto = "";

$saxeli = $_POST['Name'];
$gvari = $_POST['LastName'];

if (empty($saxeli)) {
    $errorName = "Name is required";
} else if (empty($gvari)) {
    $errorLastName = "LastName is required";
} else if (!preg_match("/^[a-zA-Z-' ]*$/", $saxeli)) {
    $errorPregName = "Error Name";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/", $gvari)) {
    $errorPregLastname = "Error LastName";
} else {
    $saxeli = "სახელი =" . $_POST["Name"];
    $gvari = "გვარი =" . $_POST["LastName"];
    $test = move_uploaded_file($_FILES['Img']['tmp_name'], "../surati/" . $_FILES['Img']['name']);
    echo $test;
}

include "challenge1_form1.php";

?>

<div class="result">
    <span> <?php echo $saxeli; ?> </span><br>
    <span> <?php echo $gvari; ?> </span><br>
    <?php
    $imgfile = "../surati/";
    $typeimage = array('jpg', 'png', 'jpeg');
    $scanfile = scandir($imgfile);
    for ($i = 2; $i < count($scanfile); $i++) {
        echo "<img src='$imgfile$scanfile[$i]' style='height: 50px; width: 50px;' >";
    }
    ?>
</div>

</body>
</html>