<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Week 1 Challenge 1
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
</head>
<body>
  <div class="formula form-group">
  <form action="" enctype="multipart/form-data" method="post">
    <p>
      <label for="firstName" class="form-label">Enter your first name:</label>
      <input type="text" id="firstName" class="form-control" name="firstName" placeholder="name" value="<?php echo $_POST['firstName']?? '' ?>">
    </p>
    <p>
      <label for="lastName" class="form-label">Enter your first name:</label>
      <input type="text" id="lastName"  class="form-control"name="lastName" placeholder="Last Name" value="<?php echo $_POST['lastName']?? '' ?>">
    </p>
    <p>
      <label for="file" class="form-label">Upload Picture:   </label>
      <input type="file" name="file" class="form-control" id="file">
    </p>
    <button type="submit" name="submit1" class="btn btn-primary">Submit</button>
  </form>
</div>
<div class="picture">

<?php
include 'compliment.php';

//Check if data have been submitted
if(isset($_POST['submit1']) && isset($_POST['firstName']) && isset($_POST["lastName"])){
  $name = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  // check if name and last name are only in alphabets
  if(ctype_alpha($name) && ctype_alpha($lastName)){
  $filepath = "uploads/".$_FILES['file']['name'];
    if(move_uploaded_file($_FILES['file']['tmp_name'], $filepath)){
    echo $name." ".$lastName.'<br/>';
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