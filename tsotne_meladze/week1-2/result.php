<?php
include_once 'function.php';
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
    <link rel="shortcut icon" type="image/x-icon" href="img/ico.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css" />
    <title>Result</title>
  </head>
  <body>
    <div class="resultbox">
    <a href="index.php" id="back"><i class='bx bxs-left-arrow-circle'></i></a>
    
      <?php

        if (isset($_POST["submit"])) {

          $userName = $_POST["user"];
          $sumbitType = $_POST["github"];

          if ($sumbitType == "repo") {

            echo '<div class="result">';
            $userInfo = json_decode(parseJson("https://api.github.com/users/$userName"), true);
            $existCheck = array_key_exists("public_repos", $userInfo);
           // check whether user exists
            if ($existCheck === true) {
              $existCount = $userInfo["public_repos"];
              $pageNumber = ceil($userInfo["public_repos"]/100)+1;
              //if user exists, counts how many pages would be needed for full info

                if ($existCount > 0) {
                  echo '<ul class="pagination">';
                  echo "<li class='page-item active'><a class='page-link' href='process.php?page=1&user=$userName&type=$sumbitType&number=$pageNumber'>1</a></li>";
                  for ($i=2; $i < $pageNumber; $i++) { 
                    echo "<li class='page-item'><a class='page-link' href='process.php?page=$i&user=$userName&type=$sumbitType&number=$pageNumber'>$i</a></li>";
                  }
                  echo '</ul>'; 
                  // creates page links
                  tableHeader("N", "Repository სახელი", "აღწერა");
                    $result = parseJson("https://api.github.com/users/$userName/repos?per_page=100&page=1");
                    $api = json_decode($result, true);
                    $x=1;
                    foreach($api as $key => $value) 
                    {
                    echo "<tr>
                    <td>" . $x++ . "</td>
                    <td><a href='{$value['html_url']}' target='_blank'>{$value['name']}</a></td>
                    <td>{$value['description']}</td>
                    </tr>";
                    }
        
                } else {
                  emptyUser("მომხმარებელს არ აქვს რეპოზიტორია");
                }
                
                

                echo '</table>';
            }
            
            elseif ($existCheck === false) {
              echo $noUser;

            }  
            echo '</div>';
          } // ll the same is done with followers

          if ($sumbitType  == "follow") {

            echo '<div class="result">';
           
            $userInfo = json_decode(parseJson("https://api.github.com/users/$userName"), true);
            $existCheck = array_key_exists("followers", $userInfo);
     
            

              
            if ($existCheck === true) {
              $existCount = $userInfo["followers"];
              $pageNumber = ceil($userInfo["followers"]/100)+1;

                if ($existCount > 0) {
                  echo '<ul class="pagination">';
                  echo "<li class='page-item active'><a class='page-link' href='process.php?page=1&user=$userName&type=$sumbitType&number=$pageNumber'>1</a></li>";
                  for ($i=2; $i < $pageNumber; $i++) { 
                    echo "<li class='page-item'><a class='page-link' href='process.php?page=$i&user=$userName&type=$sumbitType&number=$pageNumber'>$i</a></li>";
                  }
                  echo '</ul>';

             
                  tableHeader("N", "ფოტო", "სახელი");
            
            
                    $result = parseJson("https://api.github.com/users/$userName/followers?per_page=100&page=1");
                    $api = json_decode($result, true);
          
                    $x=1;
                    foreach($api as $key => $value) 
                    {
                      echo "<tr>
                      <td>" . $x++ . "</td>
                      <td><a href='{$value['html_url']}' target='_blank'><img class='nano' src='{$value['avatar_url']}' alt='' style='width: 42px'></a></td>
                      <td>{$value['login']}</td>
                      </tr>";
                    }
        
                  }

                  else {
                    emptyUser("მომხმარებელს არ ჰყავს გამომწერები");
                  }
                } elseif ($existCheck === false) {
                  echo $noUser;
    
                }  
                echo '</div>';
            }
            
          //if both followers and repos are selected, pagination is not included
            if ($_POST["github"] == "both") {

              $userInfo = json_decode(parseJson("https://api.github.com/users/$userName"), true);
              $existCheck = array_key_exists("public_repos", $userInfo);
       
              if ($existCheck === true) {
                echo '<div class="result">';
                $existCount = $userInfo["public_repos"];
                $pageNumber = ceil($userInfo["public_repos"]/100)+1;
                  if ($existCount > 0) {
               
                    tableHeader("N", "Repository სახელი", "აღწერა");
                    $x=1; 
                    for ($i=1; $i < $pageNumber; $i++) { 
  
                      $result = parseJson("https://api.github.com/users/$userName/repos?per_page=100&page=$i");
                      $api = json_decode($result, true);
                    
            
                      foreach($api as $key => $value) 
                      {
                      echo "<tr>
                      <td>" . $x++ . "</td>
                      <td><a href='{$value['html_url']}' target='_blank'>{$value['name']}</a></td>
                      <td>{$value['description']}</td>
                      </tr>";
                      }
          
                    }
                  } else {
                    emptyUser("მომხმარებელს არ აქვს რეპოზიტორია");
                  }
                  
                  echo '</table>';
                  echo '</div>';
                  
                  echo '<div class="result">';
                  $existCount1 = $userInfo["followers"];
                  $pageNumber1 = ceil($userInfo["followers"]/100)+1;
                  if ($existCount1 > 0) {
               
                    tableHeader("N", "ფოტო", "სახელი");
                    $x1=1; 
                    for ($i=1; $i < $pageNumber1; $i++) { 
  
                      $result = parseJson("https://api.github.com/users/$userName/followers?per_page=100&page=$i");
                      $api = json_decode($result, true);
            
            
                      foreach($api as $key => $value) 
                      {
                        echo "<tr>
                        <td>" . $x1++ . "</td>
                        <td><a href='{$value['html_url']}' target='_blank'><img class='nano' src='{$value['avatar_url']}' alt='' style='width: 42px'></a></td>
                        <td>{$value['login']}</td>
                        </tr>";
                      }
          
                    }
                  } else {
                    emptyUser("მომხმარებელს არ ჰყავს გამომწერები");
                  }
                  
                
                  echo '</table>';
                  echo '</div>';
                  
              }
              
              elseif ($existCheck === false) {
                echo '<div class="result">';
                echo $noUser;
                echo '</div>';
  
              }  
             
            }

          }
      ?>
    </div>
  </body>
</html>
