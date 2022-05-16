<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>My form</title>
</head>
<body>
    
<main class="container"> 
    <form  action="/index.php" method="POST" enctype="multipart/form-data">
    <div class="row mt-2">
        <div class="col">
        <label for="username">Enter First Name</label>
        <input class="form-control" id="username" type="text" required name="name" placeholder="First Name">
        </div >
        <div class="col">
        <label for="$username1">Enter Last Name</label>
        <input class="form-control" type="text" required name="surname" id="$username1" placeholder="Last Name">
        </div>
        </div>
        <div class="row">
        <div class="col">
        <label for="formFile">Upload profile picture</label>
        <input class="form-control" type="file"  id="formFile" name="img">
        </div>
        <div class="col">
        <input  class="btn btn-primary mt-4" type="submit" name="submit">
        </div>
        </div>

    </form>

    <?php
        
      $pattern = '/^[a-zA-Z]+$/i';
    if(array_key_exists("submit", $_POST)){
        if(preg_match_all($pattern, $_POST["name"]) && preg_match_all($pattern, $_POST["surname"]) ){

        ?>
        <div class="container text-center">
       <h2 class="text"><?php echo $_POST["name"] . " " . $_POST["surname"]; ?></h2>
       </div>
       <?php
        
        $temp_loc = $_FILES['img']["tmp_name"];
        $file_storage = $_FILES["img"]["name"];

        move_uploaded_file($temp_loc, $file_storage);

        
        ?> 
        <div class="container text-center w-50 h-50">
        <img class="img img-fluid"" src="<?php echo $_FILES["img"]["name"] ?>" alt="profile"> 
        </div>
        <?php
        } else {
           ?>  <div class="container text-center"><h2><?php echo  "User information should only consist from English letters!"; ?> </h2></div> <?php 
        }
    }
    ?> 

   
</main>


</body>
</html>