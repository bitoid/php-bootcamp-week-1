<!DOCTYPE html>
<html>
    <head>

        <title>Lika Mikhanashvili</title>
    </head>

    <body>
<!-- Difine 3 input values firstname, lastname which are type of text, inserted text can be only alphabetic characters
and third value type file for file upload, which is named file -->
    <form action="lika.php" method="post" enctype="multipart/form-data">
        Firtsname: <input type="text" name="firstname" pattern="[A-Za-z]+" oninvalid="setCustomValidity('Please insert alphabets characters only. (A-Za-z)')"><br>
        Lastname: <input type="text" name="lastname" pattern="[A-Za-z]+" oninvalid="setCustomValidity('Please insert alphabets characters only. (A-Za-z) ')"><br>
        <input type="file" name="file"><br>
        <input type="submit" value="Submit" name="Submit1"> <br/>
    </form>

    <?php

    // create 2 vers to retrive inserted values from HTML code using POST method, if value inserted
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    echo "<h1> $firstname $lastname </h1>";

    if(isset($_POST['Submit1']))
{
    $filepath = "./" . $_FILES["file"]["name"];

    if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath))
    {
        echo "<img src=".$filepath." height=200 width=300 />";
    }
    else
    {
        echo "Please choose image file!!";
    }
}


    ?>

    </body>
</html>