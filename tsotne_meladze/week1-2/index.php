<?php
session_start();
if(isset($_POST["submit"])) {
  $_SESSION["user"] = $_POST["user"];
 if ($_POST["github"] == "repos") {
  header('Location: repos/index.php');
 } else {
  header('Location: followers/index.php');
 }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="GPX Bitcamp" />
    <meta property="og:title" content="GPX Bitcamp" />
    <meta property="og:description" content="Junior_PHP" />
    <meta property="og:image" content="https://gpx.ge/root/img/main.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="img/ico.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Github</title>
  </head>
  <body>
    <div class="box">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="line1">
          <div class="icon"><i class="bx bx-user-circle"></i></div>
          <div class="input"><input id="user" type="text" name="user" placeholder="Github პროფილი" required /></div>
        </div>
        <div class="line2">
          <div class="icon"><i class="bx bxs-message-square-check"></i></div>
          <div class="input">
            <select name="github">
              <option value="repos">Repository</option>
              <option value="followers">Followers</option>
            </select>
          </div>
        </div>
        <div id="line4">
          <input id="submit" type="submit" name="submit" value="GET" class="btn btn-success" />
        </div>
      </form>
    </div>
  </body>
</html>
