<!DOCTYPE html>
<html>
<link rel="stylesheet" href="./style.css">
<html>
<head>
<title>Bitoid Technologies: Challenge #1</title>
</head>
    <div class="center">
    <img src="Logo.jpg" alt="Logo">
</div>
<form class="center" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div>
    <label for="firstName"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="firstName" require>
    <label for="lastName"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="lastName" require>

        Select image to upload:
        <input type="file" name="fileToUpload">

    <input type="submit" name="submit">
  </div>
</form>


   <?php
   if (!preg_match ("/^[A-Z]*$/", $_POST['firstName'] ) ) {  
    echo  "<h2 Class='alert'> Only upper alphabets are allowed! </h2>";  
  
  }
  else if (!preg_match ("/^[A-Z]*$/", $_POST['lastName'] ) ) {  
    echo "<h2 Class='alert'> Only upper alphabets are allowed! </h2>"; 
    
  }
  else if($_POST['firstName'] && $_POST['lastName']) {
    echo "<h2 class='center'> Welcome " . $_POST['firstName'] . " " . $_POST['lastName'] . "</h2> \n";
    }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image = $_FILES['fileToUpload'] ?? null;
    $imagePath = "./".$image['name'];
    if ($image) {
        move_uploaded_file($image['tmp_name'], "./".$image['name']);
    }

}
   ?>

   <?php if ($image): ?>
        <div class="center">
            <img src="<?php echo $imagePath ?>" >
        </div>
    <?php endif; ?>

   

   </html>