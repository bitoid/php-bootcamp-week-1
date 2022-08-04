<?php
 $userFirstName = "";
 $userLastName = "";
 $img = "";

     
     if(isset($_POST['firstname']) && preg_match ("/^[a-zA-z]*$/", $_POST['firstname'])){
      $userFirstName = $_POST['firstname'];
     }else {
      $userFirstName = "Please enter valid name";
     }

     
     if(isset($_POST['lastname']) && preg_match ("/^[a-zA-z]*$/", $_POST['lastname'])){
      $userLastName = $_POST['lastname'];
     }else {
      $userLastName = "Please enter valid lastname";
     }



     if(isset($_POST['form-submit'])){
      $filepath = "uploads/". $_FILES['img']['name'];
      if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
       
        $img = "<img class=user-img src=".$filepath."/>";
      }else{
         $img = 'Error!! - Please upload Your photo';
      }
     }

    
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="styles.css">
  <title>Form week1</title>
</head>
<body>
  <div class="form-container">
  <form action="" method="post" class="about-form" enctype = "multipart/form-data">
      <div>
      <label>First Name</label>
      <input type="text" name="firstname"  required>
    </div>
     <div>
     <label>Last Name</label>
      <input type="text" name="lastname"  required>
     </div>
        <label for="img-upload" class="img-upload">
          Select Image
          <ion-icon name="image-outline"></ion-icon>
      <input type="file" id="img-upload" name="img" >
      </label>
     
      <input type="submit" name="form-submit">
    </form>

  </div>
  <div class="user-details">
  <p>Firstname : 
    <?=   $userFirstName ;?></p>
  <p>Lastname : <?=  $userLastName ;?></p>

  <?= $img; ?>

  </div>
    
</body>
</html> 

