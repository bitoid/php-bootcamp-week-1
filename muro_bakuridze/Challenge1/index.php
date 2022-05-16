<!DOCTYPE HTML>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge #1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>.info{margin-left: 100px;}</style>
</head>
<body>  
<?php
// define variables and set to empty values
$name = $comment = $surname = "";

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if(!preg_match("/^[a-zA-Z-']*$/",$name)) {
            $nameErr = 'Only Letters allowed';
        }
    }

    if (empty($_POST["surname"])) {
        $surnameErr = "Surname is required";
    } else {
        $surname = test_input($_POST["surname"]);
        if(!preg_match("/^[a-zA-Z-']*$/",$surname)) {
            $surnameErr = 'Only Letters allowed';
        }
    }
    $file= $_FILES['file'];
    $fileName= $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        $folder='images/';

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg','png','pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                move_uploaded_file($fileTmpName,$folder.'1.png');
            } else {
                echo "Your File is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<div class="position-relative m-5">
    <h5 class="card-title m-5">Form with validation</h5>
    <form class="col-md-2 m-5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input class="form-control" type="text" name="name">
            <small id="nameHelp" class="text-danger form-text"><?php if(isset($nameErr)){ echo $nameErr; }?></small>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input class="form-control" type="text" name="surname">
            <small id="emailHelp" class="text-danger form-text"><?php if(isset($surnameErr)){ echo $surnameErr; }?></small>
        </div>
        <label for="img_upload">Upload Image</label>
        <input type="file" name="file">
        <input class="btn btn-primary" type="submit" name="submit" value="Submit">  
    </form>
</div>

<div class="info">
<?php
   if(preg_match("/^[a-zA-Z-']*$/",$name) && preg_match("/^[a-zA-Z-']*$/",$surname)){
?>
        <h6  class="card-subtitle mb-2 text-muted "> <?= $name ?></h6>
        <h6 class="card-subtitle mb-2 text-muted "> <?= $surname ?></h6>
<?php
   }
   if(file_exists("images/1.png")){
?>
        <img src="images/1.png" alt="image" style="width:200px;" class="">
<?php
   }
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>