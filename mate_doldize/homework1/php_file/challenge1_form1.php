<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="forminfo">
    <form action="Challenge1.php" method="post" enctype="multipart/form-data">
        <a href="../index.php">M t a v a r i</a><br><br>
        <label>
            <input type="text" name="Name" placeholder="name">
            <?php if (isset($errorName)) { ?>
                <span style="color: red"><?php echo $errorName; ?></span>
            <?php } ?>
            <?php if (isset($errorPregName)) { ?>
                <span style="color: red"><?php echo $errorPregName; ?></span>
            <?php } ?>
        </label><br>
        <label>
            <input type="text" name="LastName" placeholder="LastName">
            <?php if (isset($errorLastName)) { ?>
                <span style="color: red"><?php echo $errorLastName; ?></span>
            <?php } ?>
            <?php if (isset($errorPregLastname)) { ?>
                <span style="color: red"><?php echo $errorPregLastname; ?></span>
            <?php } ?>
        </label><br>
        <label>
            <input type="file" name="Img">
        </label><br>
        <input type="submit" value="Register">
    </form>
</div>

</body>
</html>