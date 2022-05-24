<?php

$is_Valid = false;



if (isset($_POST["submit"])) {
  if (empty($_POST["firstname"]) || empty($_FILES['image']['name']) || empty($_POST["lastname"])) {
  $fill_Validator = "Please, fill all fields !";
    $is_Valid = false;
  } else {
    $is_Valid = true;
  }

  if (
    strtoupper($_POST["firstname"]) != $_POST["firstname"] ||
    strtoupper($_POST["lastname"]) != $_POST["lastname"]
  ) {
    $case_Validator = "Please, enter CAPITAL letters only !";
    $is_Valid = false;
  } 


  if (  preg_match('/^\d+$/', $_POST['firstname']) || preg_match('/^\d+$/', $_POST['lastname'])   ) {

    $number_Error = 'Please, enter the letters only !';

    $is_Valid = false;   
  }

  if ($isValid) {
    $success = "Succsess";
  }

  $name = $_POST["firstname"];
  $surname = $_POST["lastname"];

  $image = $_FILES["image"]["name"];

  $image_Tmp = $_FILES["image"]["tmp_name"];

  move_uploaded_file($image_Tmp, "uploads/" . $image);
}

?>