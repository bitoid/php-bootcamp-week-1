<?php
include_once '../include/function.php';
session_start();
$userName = $_SESSION["user"];
$userInfo = json_decode(parseJson("https://api.github.com/users/$userName"), true);
$existCheck = array_key_exists("public_repos", $userInfo);
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
    <link rel="shortcut icon" type="image/x-icon" href="../img/ico.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css" />
    <title>Result</title>
  </head>
  <body>
    <div class="resultbox">
      <a href="../index.php" id="back"><i class='bx bxs-left-arrow-circle'></i></a>
     <div class="result">
        <?php
              if ($existCheck === true) {
                $existCount = $userInfo["followers"];
                $pageNumber = ceil($existCount/100)+1;
                //if user exists, counts how many pages would be needed for full info

                  if ($existCount > 0) {

                    tableHeader("N", "ფოტო", "სახელი");
                    $x = 0;
                    for ($i=1; $i < $pageNumber; $i++) { 
                      $urll = "https://api.github.com/users/$userName/followers?per_page=100&page=$i";
                      $result = parseJson($urll);
                      $api = json_decode($result, true);
                      foreach($api as $key => $value) 
                      {$x++?>
                    <tr>
                    <td><?=$x?></td>
                    <td><a href='<?=$value['html_url']?>' target='_blank'><img class='nano' src='<?=$value['avatar_url']?>' alt='' style='width: 42px'></a></td>
                      <td><?=$value['login']?></td>
                      </tr>
                      <?php }
                    }
                  }
                else {?>
                  <p style="color: white">მომხმარებელს არ ჰყავს გამომწერი</p>      
                  <?php
                    }
              }
              
              elseif ($existCheck === false) {?>

                  <p style="color: white">ასეთი მომხმარებელი არ არსებობს</პ>
           
                <?php }  ?>
              
     </div>
    </div>
  </body>
</html>
