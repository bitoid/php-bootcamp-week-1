<?php 
// Creating variables for the uploaded image
$target_dir = "./uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$target_file = str_replace(' ', '-', $target_file);
$image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Creating variables for name and last name
$name = ucfirst($_POST['name']);
$last_name = ucfirst($_POST['last-name']);

// Creating an array for errors
$errors = [];

// Check the information after the submit
if(isset($_POST["submit"])) {

  // Check if name and last name were input
  if (!$name || !$last_name) {
    $errors[] = "Please fill all of the fields";
  }
  
  // Check if name and last name were inputted correctly
  if (!ctype_alpha($name) || !ctype_alpha($last_name)) {
    $errors[] = "Name and last name should only contain letters";
  }
  
  // Check if the image was uploaded

  if ($_FILES['image']) {
    // Check the type of an image
    if ($image_file_type !== 'png' && $image_file_type !== 'jpg' 
    && $image_file_type !== 'jpeg' && $image_file_type !== 'gif') {
      $errors[] = "Please upload a valid image";
    }

    // Check if the image is too large
    if ($_FILES["image"]["size"] > 500000) {
      $errors[] = "Sorry, the file is too large";
    }

    // If there were no errors, save the image
    if (!$errors) {
      move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }
  }
}
?>