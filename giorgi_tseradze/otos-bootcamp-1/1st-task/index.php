<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="index.css">  
  <title>1st task: form</title>
</head>
<body>

<!-- input form -->
<section class="form">

  <form action="index.php" method="POST" enctype="multipart/form-data" >

  <label for="firstName">First Name:</label><br>
  <input type="text" id="fname" name="fname" placeholder="Enter your first name" ><br>

  <label for="lastName">Last Name:</label><br>
  <input type="text" id="lname" name="lname" placeholder="Enter your last name" ><br>

  <input type="file" id="image" name="image"><br /><br />

  <input type="submit" name="submit" value="submit">

  </form>
</section>

<!-- first name and last name preview and validation -->
<section class="preview">
  <?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    if(!preg_match("/^[a-zA-z]*$/", $fname) || !preg_match("/^[a-zA-z]*$/", $lname)){
      $error = "Only latin characters are allowed.";  
      echo "<p style='color: red; font-size: 20px; font-weight: bold;'>".$error."</p>"; 
    } else {
      echo '<br>'."<p style='font-size: 20px; font-weight: bold;'>".$_POST["fname"].'<br>';
      echo $_POST["lname"].'<br>';

    };
  ?>
</section>

<!-- image preview -->
<?php
 if(isset($_POST['submit']))
 {
    $img_name=$_FILES['image']['name']; 
    echo '<br>';

    $tmp_img_name=$_FILES['image']['tmp_name'];
    echo '<br>';

    move_uploaded_file($tmp_img_name, 'uploads/'.$img_name);

    $img_path = 'uploads/'.$img_name;

    echo '<img src="'.$img_path.'" />'; 
 } 
 ?>

</body>
</html>
