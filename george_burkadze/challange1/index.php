<?php
require_once "./config/form.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>USER</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <form method="post" enctype="multipart/form-data">
    <div class="minicontainer">
      <div class="input-group">
        <label for="image">Profile image</label>
        <input type="file" name="profile" id="profile" accept=".jpg, .jpeg, .png">
        <b class="validation">
          <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($fileerror)) {
              echo $fileerror;
            }
          }
          ?>
        </b>
      </div>
      <div class="input-group">
        <label for="firstname">First name</label>
        <input type="text" name="firstname" id="firstname">
        <b class="validation">
          <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($firstnameerror)) {
            echo $firstnameerror;
          }
          ?>
        </b>
      </div>
      <div class="input-group">
        <label for="lastname">Last name</label>
        <input type="text" name="lastname" id="lastname">
        <b class="validation">
          <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($lastnameerror)) {
            echo $lastnameerror;
          }
          ?>
        </b>
      </div>
      <div>
        <button type="submit">Upload</button>
      </div>
    </div>
  </form>
</body>

</html>