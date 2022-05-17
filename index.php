<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge1</title>
</head>
<body>


    <div class="uploadForm">
        <form  action="/php/index.php" method="POST" enctype="multipart/form-data">

            <label for="firstname"> Enter Your First Name: </label>
            <input type="text" name="firstname" id="firstname" placeholder="First Name" >

            <label for="lastname"> Enter Your Last Name: </label>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name">

            <label for="image"> Enter Profile Picture: </label>
            <input type="file" accept="image/*"  id="image" name="image" >

            <input type="submit"  id="submit" name="submit">

        </form>
    </div>



    <?php

        if(isset($_POST['submit'])){
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $target_dir = "uploads/";
            if(!is_dir($target_dir)){
                mkdir($target_dir);
            }
            $imagepath = $target_dir . basename($_FILES["image"]["name"]);

            if((!preg_match("/^([a-zA-Z' ]+)$/",$firstName) ||
            empty($firstName)) && (!preg_match("/^([a-zA-Z' ]+)$/",$lastName) || empty($lastName))){
                print "Please enter correct first and last name!";
            }else if(!preg_match("/^([a-zA-Z' ]+)$/",$firstName) || empty($firstName)){
                print "Please enter correct first name!";
            }else if((!preg_match("/^([a-zA-Z' ]+)$/",$lastName)) || empty($lastName)){
                print "Please enter correct last name!";
            }else if($_FILES["image"]['size'] == 0){
                print "Please Upload Profile Picture";
            }
            else if(move_uploaded_file($_FILES["image"]["tmp_name"], $imagepath)) {
                print "First Name: " . $firstName . " Last Name: " . $lastName . "<br>";
                print "<img src=".$imagepath.">;";
            }
        }


    ?>

</body>
</html>
