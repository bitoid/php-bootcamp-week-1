<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>َAnimated Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php if (empty($_POST)) : ?>
        <form class="box" action="/index.php" method="POST" enctype="multipart/form-data">
            <div>
                <input type="text" name="first_name" placeholder="first name" value="">
                <input type="text" name="last_name" placeholder="last name" value="">
                <input type="file" name="file"><br>
                <input type="submit" name="submit" value="UPLOAD">
            </div>
        </form>
    <?php else : ?>
        <?php
        $file_directory = "upload/";
        if (!file_exists($file_directory)) {
            mkdir($file_directory);
        }
        if (isset($_FILES["file"])) {
            $file_name = $_FILES["file"]["name"];
            $file_tmp = $_FILES["file"]["tmp_name"];
            $upload_file = move_uploaded_file($file_tmp, $file_directory . $file_name);
        }
        if (isset($_POST["submit"])) {
            $name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            if ($_POST["first_name"] &&  $_POST["last_name"] && $upload_file) {
        ?>
                <p style="text-align:center;"><?php echo "<img src ='upload/$file_name' ><br><br>" ?></P>
                <h2 style="text-align:center;"><?php print $_POST["first_name"] . " " . $_POST["last_name"] . "<br><br>" ?></h2>
    <?php
            }
            if (empty($name)) {
                echo "<h4 style='text-align:center;'>Please Enter Your Name</h4>";
            } else if (!ctype_alpha($name)) {
                echo "<h4 style='text-align:center;'>Use Only Alphabet Caracters </h4>";
            } else if (empty($last_name)) {
                echo "<h4 style='text-align:center;'>Please Enter Your  Last Name </h4>";
            } else if (!ctype_alpha($last_name)) {
                echo "<h4 style='text-align:center;'>Use Only Alphabet Caracters <h/4>";
            } else if (empty($upload_file)) {
                echo "<h4 style='text-align:center;'>Plase Upload Profile Picture.</h4>";
            }
        }
    endif; ?>

</body>

</html>