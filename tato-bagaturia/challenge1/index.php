<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge 1</title>
</head>
<body>
    
    <?php if(empty($_POST)): ?>
    <div class="uploadForm"> 
        <form  action="/index.php" method="POST" enctype="multipart/form-data">

            <label for="firstname">Please Enter Your First Name: </label>
            <input type="text" pattern="[a-zA-Z]+" title="Letters Only" name="firstname" id="firstname" placeholder="First Name" required>

            <label for="lastname">Please Enter Your Last Name: </label>
            <input type="text" pattern="[a-zA-Z]+" title="Letters Only" name="lastname" id="lastname" placeholder="Last Name" required>

            <label for="image">Please Enter Profile Picture: </label>
            <input type="file" accept="image/*"  id="image" name="image" >

            <input type="submit"  id="submit" name="submit"> 

        </form>
    </div>

    <?php else: ?>
    <?php
        if(isset($_POST['submit'])) {
            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname']; 
            $target_dir = "uploads/";
            $image_name = basename($_FILES["image"]["name"]);
            $image_path = NULL;
            $alphabet_validation = "/^([a-zA-Z' ]+)$/";

            if(!is_dir($target_dir)){
                mkdir($target_dir);
            }

    ?>

    <?php if( (  !preg_match($alphabet_validation,$first_name) || empty($first_name) ) && ( !preg_match($alphabet_validation,$last_name) || empty($last_name))){ ?>
        <div class="alert">
            Incorrect first and last names!
        </div>
    <?php 
        }
        else if(!preg_match($alphabet_validation,$first_name) || empty($first_name)){
    ?>
    
        <div class="alert">
            Incorrect first name!
        </div>

    <?php
        }
        else if((!preg_match($alphabet_validation,$last_name)) || empty($last_name)){
    ?>

        <div class="alert">
            Incorrect last name!
        </div>

    <?php
        }
        else if($_FILES["image"]['size'] == 0){
    ?>

        <div class="alert">
            Please Upload Profile Picture!
        </div>
        
    <?php
        }
            else if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image_name)) { 
                $image_path = $target_dir . $image_name;  
    ?>

        <div class = "result">
            <p id="resultNames" class="resultFname"><?= $first_name?> </p>
            <p id="resultNames" class="resultLname"><?= $last_name?> </p>
            <br>
            <img src="<?=$image_path?>" width="400" height="400" >
        </div> 
            
    <?php
            }
        }        
    ?>

    
    <?php endif; ?> 
</body>
</html>