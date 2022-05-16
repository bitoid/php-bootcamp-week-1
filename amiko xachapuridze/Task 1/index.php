<?php
session_start();
$name  =  $lastname = $image = '';
$nameErr = $lastnameErr = "";

//
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST["name"]) || preg_match('/^[a-zA-Z]$/', $_POST['name']))  {
        $nameErr = "შეიყვანეთ სახელი სწორი ფორმატით ლათინურად";
    } else {
        $name = $_POST["name"];
    }
    if (empty($_POST["lastname"]) || preg_match('/^[a-zA-Z]$/', $_POST['lastname'])) {
        $lastnameErr = "შეიყვანეთ გვარი სწორი ფორმატით ლათინურად";
    } else {
        $lastname = $_POST["lastname"];
    }
    UploadImage($name,$lastname);

}
function UploadImage($name,$lastname)
{
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {

        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" &&  $imageFileType != "jfif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { 
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <style>
        .error{
            color: red;
            font-size: 16px;
        }

    </style>
</head>
<body>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"  enctype="multipart/form-data">
<input type="text" name="name"  minlength="4" maxlength="25" placeholder="input  name" value="<?php echo  $name ?>">
    <span class="error">* <?php echo $nameErr;?></span>

    <br>
    <input type="text" name="lastname"  minlength="4" maxlength="25" placeholder="Input  LastName" value="<?php echo $lastname ?>">
    <span class="error">* <?php echo $lastnameErr;?></span>

    <br>
    <input type="file" name="fileToUpload" required>
    <br>
    <input type="submit" value="გაგზავნა">
</form>
<div> 
<img src="./images/<?php echo htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])) ?>" alt="profileimage" width="15px" height="15px">
            <?php
            echo $name . " " . $lastname;
            ?>
</div>
</body>
</html>