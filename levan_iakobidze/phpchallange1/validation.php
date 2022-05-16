<?php

$isValid = false;



if (isset($_POST["submit"])) {
  if (empty($_POST["firstname"]) || empty($_FILES['image']['name']) || empty($_POST["lastname"])) {
  $fillValidator = "Please, fill all fields !";
    $isValid = false;
  } else {
    $isValid = true;
  }

  if (
    strtoupper($_POST["firstname"]) != $_POST["firstname"] ||
    strtoupper($_POST["lastname"]) != $_POST["lastname"]
  ) {
    $caseValidator = "Please, enter CAPITAL letters only !";
    $isValid = false;
  } 


  if (  preg_match('/^\d+$/', $_POST['firstname']) || preg_match('/^\d+$/', $_POST['lastname'])   ) {

    $numberError = 'Please, enter the letters only !';

    $isValid = false;   
  }

  if ($isValid) {
    $success = "Succsess";
  }

  $name = $_POST["firstname"];
  $surname = $_POST["lastname"];

  $image = $_FILES["image"]["name"];

  $imageTmp = $_FILES["image"]["tmp_name"];

  move_uploaded_file($imageTmp, "uploads/" . $image);
}

?>