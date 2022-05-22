<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="form_style.css">
  </head>
  <body>
    <?php if (empty($_POST)): ?> 
    <form action="form.php" method="post" enctype="multipart/form-data" class="container">
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">First name</label>
            <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Name" required>
        </div>
        <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Last name</label>
            <input type="text" class="form-control" id="validationCustom02" name="surname" placeholder="Surname" required><br>
        </div>
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02" name="profile_photo" required>
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
    <?php else: ?>
    
    <?php
    if(!$_POST['name'] || !$_POST['surname']){
        echo  "<div class='alert alert-danger' role='alert'> Please enter name and surname!</div>";
        }
    elseif (!preg_match ("/^[a-zA-Z\s]+$/", $_POST['name'] ) || !preg_match ("/^[a-zA-Z\s]+$/", $_POST['surname'] )){
        echo  "<div class='alert alert-danger' role='alert'>Please use only Latin letters!</div>";
        }
    else{
    $upload_directory = getcwd() . "/uploads/";
    $profile_image_name = basename($_FILES["profile_photo"]['name']);
    $profile_image_url = NULL;

    if (!file_exists($upload_directory)){
        mkdir($upload_directory);
        }

    if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $upload_directory . $profile_image_name)){
        $profile_image_url = $upload_directory . $profile_image_name;
        }
    }
    ?>
    

    <div class="card mb-3">
        <img src="<?php print "/uploads/" . $profile_image_name; ?>">
        <div class="card-body">
            <h5 class="card-title"><?php print $_POST['name']; ?> <?php print $_POST['surname']; ?></h5>
        </div>
    </div>
    <?php endif; ?>
  </body>
</html>