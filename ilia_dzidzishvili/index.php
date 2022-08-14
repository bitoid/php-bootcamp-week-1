<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Week-1</title>
   <link rel="stylesheet"  href="styles.css">
</head>
<body>

   <?php 
      $uploadFileName = null;
      $hasPost = false;
      if(isset($_POST["firstname"]) || isset($_POST["lastname"]) /*|| $_FILES["firstname"]*/) 
      {
         $hasPost = true;
         $errorMessages = [];
         if (!preg_match("/^[A-Z]+$/", $_POST["firstname"]))
            array_push($errorMessages, 'First name must only contain letters A to Z');
         if (!preg_match("/^[A-Z]+$/", $_POST["lastname"]))
            array_push($errorMessages, 'Last name must only contain letters A to Z');
         if ($_FILES['image']['size'] == 0){
            array_push($errorMessages, 'Please select a profile picture');
         }else{
            $uploadFileName = $_FILES["image"]["name"];
            if(empty($errorMessages))
               move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/'.$uploadFileName);
         }
      }
   ?>

   <div class="container">
      <h1>Bitoid week 1</h1>
      
      <?php if($hasPost): ?>
         <?php if($errorMessages): ?>
            <div class="error-messages">
               <?php foreach ($errorMessages as $errMsg): ?>
                  <div><?= $errMsg ?></div>
               <?php endforeach; ?>
            </div>
         <?php else: ?>
            Firstname: <?= $_POST['firstname'] ?> <br>
            Lastname: <?= $_POST['lastname'] ?> <br>
            Profile image: <br>
            <img src="./uploads/<?= $uploadFileName ?>" width="100">
         <?php endif; ?>
      <?php endif; ?>
      

      <form method="post" action="index.php" enctype="multipart/form-data">
         <label for="firstname">Firstname</label>
         <input name="firstname" id="firstname">
         <label for="lastname">Lastname</label>
         <input name="lastname" id="lastname">
         <label for="image">Profile image</label>
         <input type="file" name="image" id="image" accept=".jpg, .png">
         <button type="submit">Send</button>
      </form>      

   </div>
   
</body>
</html>