<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Form week1</title>
</head>
<body>
  <div class="form-container">
  <form action="" method="post" class="about-form" enctype = "multipart/form-data">
      <div>
      <label>First Name</label>
      <input type="text" name="firstname">
    </div>
     <div>
     <label>Last Name</label>
      <input type="text" name="lastname">
     </div>
      
      <input type="file" id="photo" name="img">
      <input type="submit" name="form-submit">
    </form>

  </div>
    

    <?php
     echo $_POST["firstname"];
     echo $_POST["lastname"];
     if(isset($_POST['form-submit'])){
      $filepath = "uploads/". $_FILES['img']['name'];
      if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
        echo "<img src=".$filepath." width=200px height=200px />";
      }else{
        echo 'Error!!';
      }
     }
  ?>
</body>
</html>