<?php
$pFileErr = "";
$lNameErr = "";
$fNameErr = "";
$image = "";

//form request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//First Name validation
    if (empty($_POST["Fname"])) {
        $fNameErr = "First Name is required !";
    } else {
        if (!preg_match("/^([a-zA-Z' ]+)$/", $_POST["Fname"])) {
            $fNameErr = "Only alphabet characters!";
        }
    }

    //Last Name validation

    if (empty($_POST["Lname"])) {
        $lNameErr = "Last Name is required !";
    } else {
        if (!preg_match("/^([a-zA-Z' ]+)$/", $_POST["Lname"])) {
            $lNameErr = "Only alphabet characters!";
        }
    }

    $target_file = $_FILES["Pfile"]["name"];
    $temp_file = $_FILES['Pfile']["tmp_name"];
    $location = $target_file;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Image validation
    if (($imageFileType == "")) {
        $pFileErr = "Picture is required !";

    } else if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        $pFileErr = "It's not image";
    } else if (move_uploaded_file($temp_file, $location)) {
        $image = "<img src=" . $location . "/>";
    }

}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Challange #1</title>



    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form method="POST" action="/index.php" enctype="multipart/form-data" class="form-signin">
      <h1 class="h3 mb-3 font-weight-normal">FORM</h1>

      <div class="input-field">
      <div class="error"> <?php echo $fNameErr; ?></div>
      <input type="text" name="Fname"class="form-control top" placeholder="First Name"  autofocus>
      </div>

      <div class="input-field">
      <div class="error"> <?php echo $lNameErr; ?></div>
      <input type="text" name="Lname" class="form-control middle" placeholder="Last Name" >
      </div>

      <div class="input-field">
      <div
      class="error"> <?php echo $pFileErr; ?></div>
      <input type="file" name= "Pfile"class="form-control bottom"  >
</div>


      <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Post"></input>


     <div class="vl"></div>

<div class="upload">
      <?php

if (isset($_POST["submit"])) {
    if ($fNameErr === "" && $lNameErr === "" && $pFileErr === "") {
        //Name and last Name

        print "<h2>" . $_POST["Fname"] . " " . $_POST["Lname"] . "</h2>";
        print "<br>";
        print $image;

    }

}

?>
</div>

    </form>
  </body>








</html>
