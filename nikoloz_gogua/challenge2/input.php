<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>challange #2</title>
      <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form action="/input.php?page=1" method="POST" class="form-signin top">
      <input type="text" name="github" class="form-control" placeholder="Github Username"  autocomplete="off">

      <div class="input-group mb-3">
  <select class="custom-select" name="choose" >
    <option selected>Choose...</option>
    <option value="repository">Repository</option>
    <option value="followers">Followers</option>
  </select>

</div>

<button type="submit" name="submit" class="btn btn-primary">Get</button>

    </form>
    <?php
require "github_repo.php";
require "github_follow.php";

if (isset($_POST["submit"])) {

    $username =
        $_POST["github"];

    $param = [
        "http" => [
            "method" => "GET",
            "header" => [
                "User-Agent:PHP",
            ],
        ],
    ];

    //check if username field is fill

    if ($_POST["github"] === "") {
        echo "<div class=error1>Username Required!</div>";
    }
    //check if option field is fill
    if ($_POST["choose"] === "Choose...") {
        echo "<div class=error2>Option Required!</div>";

    }
    ?>

    <?php
//if everthing is ok send post method for repoistory
    if ($_POST["choose"] === "repository" && !empty($username)) {
        repos($username, $param);
//if everthing is ok send post method for follower
    } else if ($_POST["choose"] === "followers" && !empty($username)) {
        followers($username, $param);
    }

    ?>





<?php }?>


  </body>
</html>
