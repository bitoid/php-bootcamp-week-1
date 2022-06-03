<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Week 1 Challenge 1
  </title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="formula">
  <form action="" enctype="multipart/form-data" method="post">
    <p>
      <label for="firstName">Enter your first name:</label>
      <input type="text" id="firstName" name="firstName" placeholder="name">
    </p>
    <p>
      <label for="lastName">Enter your first name:</label>
      <input type="text" id="lastName" name="lastName" placeholder="Last Name">
    </p>
    <p>
      <label for="file">Upload Picture:   </label>
      <input type="file" name="file" id="file">
    </p>
    <button type="submit" name="submit1">Submit</button>
  </form>
</div>
<div class="picture">
<?php
$compliment = [
  "nice pic 😎", "Breathtaking 🤗", "Elegant 🤩", "😍😍😍", "Stunning 🥰",
  "kirqi potoa 🧐", "🤯", "Are you French? Because Eiffel for you. 😘", "HELP"
];
$num = rand(0, count($compliment) - 1);

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
    echo "<p>".$compliment[$num]."</p>";
    } else {
    echo "ERROR";
    }
  } else {
    echo "ERROR! Name and last name should only include alphabet characters";
  }
}
?>
</div>
</body>
</html>