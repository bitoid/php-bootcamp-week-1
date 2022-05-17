<?php
$error = ''; 
$image_url = ''; 
if( isset($_POST['submit']) ) { 
    $fileName = $_FILES['file']['name'];  
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $maxFileSize = 200000;
    $fileExt = explode(".", $fileName);
    $currFileExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    if(in_array($currFileExt, $allowed) ){
        if($fileSize < $maxFileSize) {
            if($fileError == 0){
                $uniqueFileName = uniqid('',true).".".$currFileExt;
                move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$uniqueFileName);
                $image_url = 'uploads/'.$uniqueFileName;
            } else {
                $error = 'There is an error in uploading file'; 
            }
        } else {    
                $error = "fileSize should be atmost 500kb";
        }
    } else {
        $error = "This type of file is not allowed";
    }

  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  if (empty($_POST["lastname"])) {
    $nameErr = "Name is required";
  } else {
    $lastname = test_input($_POST["lastname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
      $lastnameErr = "Only letters and white space allowed";
    }
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>week 1</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
<body class='text-center'>
  <h1>challange #1</h1>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
     method="post"   enctype="multipart/form-data" id="form" >
     Name: <input type="text" name="name" value="<?php echo $name;?>"><br>
     lastName: <input type="text" name="lastname" value="<?php echo $lastname;?>"><br>
     <input type="file" name="file" id="file" /><br>
    <input type="submit" name="submit" id="submit" />
    </form>
    <?php echo "<h2>Your Input:</h2>"; 
    echo "<h1>firstname: $name</h1>";
    echo "<h1>lastname: $lastname</h1>";
    ?>
    <h2>Upload image here</h2>
    <div style="margin:0 auto;height:200px;max-height:200px;max-
    width:200px;width:200px;border:1px solid black;">
      <img src="<?php echo $image_url; ?>" style="height: 200px;width: 200px;"/>
    </div>   
</body>
</html>