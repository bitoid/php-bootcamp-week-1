<?php
include "./config/repos.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GITHUB</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav>
    <div>
      <a href="./">User repositories</a>
      <a href="./followers.php">User followers</a>
    </div>
  </nav>

  <div class="minicontainer">
    <form method="post">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
          <?php 
          if ($_SERVER["REQUEST_METHOD"] === "POST" && empty($_POST["username"]))
          { 
          ?>
            <b class="validation">Filling in this field is required</b>
          <?php
          } 
          ?>
        </b>
      </div>
      <button type="submit">Submit</button>
    </form>
    <hr>
    <div class="grid-container">
      <?php 
      if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["username"]))
      {
        foreach ($repos as $item)
        { 
      ?>
          <div class="item">
            <a href="<?php echo $item->html_url; ?>" target="_blank">
              <?php echo $item->name; ?>
            </a>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
</body>
</html>