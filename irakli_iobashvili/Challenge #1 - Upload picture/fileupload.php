<?php
//Check if data have been submitted
if(isset($_POST['submit1']) && isset($_POST['firstName']) && isset($_POST["lastName"])){
  $name = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  // check if name and last name are only in alphabets
  if(ctype_alpha($name) && ctype_alpha($lastName)){
  $filepath = "uploads/".$_FILES['file']['name'];
    if(move_uploaded_file($_FILES['file']['tmp_name'], $filepath)){
    echo $name."<br/>".$lastName.'<br/>';
    echo "<img src='".$filepath."'/>";
    } else {
    echo "ERROR";
    }
  } else {
    echo "ERROR! Name and last name should only include alphabet characters";
  }
}
?>