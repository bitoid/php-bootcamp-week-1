<?php

  $pattern = "/^[A-Z]{2,}$/";
  $error = "";
  $divResult = "";
  $fname = "";
  $lname = "";
  if (isset($_POST["submit"])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    if (!preg_match($pattern, $lname) || !preg_match($pattern, $fname) || $_FILES["uploadfile"]["size"] > 1000000) {
      $error =  "არასწორი ფორმატი, გამოიყენე A-Z და ფაილი 500kb-ზე ნაკლები ზომის";
      $image_name = "x.png";
      $fullName = "";
    }  else  {
        $image_name = $_FILES['uploadfile']['name'];
        $image_tmp_name= $_FILES['uploadfile']['tmp_name'];
        move_uploaded_file($_FILES['uploadfile']['tmp_name'], "vault/$image_name");
        $fullName = $fname . " " . $lname;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
    <meta property="og:type" content="website">
    <meta property="og:url" content="GPX Bitcamp">
    <meta property="og:title" content="GPX Bitcamp">
    <meta property="og:description" content="Junior_PHP">
    <meta property="og:image" content="https://gpx.ge/root/img/main.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="img/ico.ico" />
   <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Profile</title>
  </head>
  <body>
<?php if (empty($_POST)) {?>

  <div class="box" >
      <form action="" method="post" enctype="multipart/form-data">
        <div class="line1">
          <div class="icon"><i class='bx bx-user-check'></i></div>
          <div class="input"><input id="lname" type="text" name="fname" placeholder="სახელი" required /></div>
        </div>
        <div class="line2">
          <div class="icon"><i class='bx bx-user-plus'></i></div>
          <div class="input"><input id="lname" type="text"  name="lname" placeholder="გვარი" required/></div>
        </div>
        <div class="line3">
          <input type="file" name="uploadfile" value="" required/>
        </div>
        <div id="line4">
          <input id="submit" type="submit" name="submit" value="SEND" class="btn btn-success"  />
        </div>
      </form>
  </div>
  <?php } ?>



  <?php if (!empty($_POST)) {?>
  <div class="result">
    
    <p><?=$error . $fullName?></p>
    <img src='vault/<?=$image_name?>'>

  </div>
  <?php } ?>







  </body>
</html>
