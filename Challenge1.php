<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php
$errorName = $errorLastName = $errorPregName = $errorPregLastname = "";
$saxeli = $gvari = $foto = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Name"]) || empty($_POST["LastName"])) {
        $errorName = "Name is required";
        $errorLastName = "LastName is required";
//    } else if (empty($_POST["LastName"])) {
//        $errorLastName = "LastName is required";
//    }
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["Name"])) {
        $errorPregName = "Error Name";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["LastName"])) {
        $errorPregLastname = "Error LastName";
    } else {

        $saxeli = "სახელი =" . $_POST["Name"];
        $gvari = "გვარი =" . $_POST["LastName"];
        //$foto = "ფოტო =" . $_POST["Img"];
        $test = move_uploaded_file($_FILES['Img']['tmp_name'], "../surati/" . $_FILES['Img']['name']);
        echo $test;
    }
}
?>
<div class="forminfo">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <a href="../index.php">M t a v a r i</a><br><br>
        <label>
            <input type="text" name="Name" placeholder="name">
            <span style="color: red"> <?php echo $errorName; ?> </span>
            <span style="color: red"> <?php echo $errorPregName; ?> </span>
        </label><br>
        <label>
            <input type="text" name="LastName" placeholder="LastName">
            <span style="color: red"> <?php echo $errorLastName; ?> </span>
            <span style="color: red"> <?php echo $errorPregLastname; ?> </span>
        </label><br>
        <label>
            <input type="file" name="Img">
        </label><br>
        <input type="submit" value="Register">
    </form>

    <div class="result">
        <span > <?php echo $saxeli; ?> </span><br>
        <span > <?php echo $gvari; ?> </span><br>
        <?php
        $imgfile = "../surati/";
        $typeimage = array('jpg', 'png', 'jpeg');
        $scanfile = scandir($imgfile);
        for ($i = 2; $i < count($scanfile); $i++) {
            echo "<img src='$imgfile$scanfile[$i]' style='height: 50px; width: 50px;' >";
        }
        ?>
    </div>

</div>
<br>

</body>
</html>