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

          $userName = $_GET['user'];
          $fromPageNumber = $_GET['page'];
          $sumbitType = $_GET['type'];
          $aggPageNumber = $_GET['number'];

          if ($sumbitType == "repo") {


            echo '<div class="result">';

            echo '<ul class="pagination">';
            for ($i=1; $i < $fromPageNumber; $i++) { 
              echo "<li class='page-item'><a class='page-link' href='process.php?page=$i&user=$userName&type=$sumbitType&number=$aggPageNumber'>$i</a></li>";
            }
            echo "<li class='page-item active'><a class='page-link' href='process.php?page=$fromPageNumber&user=$userName&type=$sumbitType&number=pageNumber'>$fromPageNumber</a></li>";
            for ($i=$fromPageNumber+1; $i < $aggPageNumber; $i++) { 
              echo "<li class='page-item'><a class='page-link' href='process.php?page=$i&user=$userName&type=$sumbitType&number=$aggPageNumber'>$i</a></li>";
            }
            echo '</ul>';


                tableHeader("N", "Repository სახელი", "აღწერა");
                $result = parseJson("https://api.github.com/users/$userName/repos?per_page=100&page=$fromPageNumber");
                $api = json_decode($result, true);
                $zorg = ($fromPageNumber-1) * 100 +1;

                foreach($api as $key => $value) 
                    {
                    echo "<tr>
                    <td>" . $zorg++ . "</td>
                    <td><a href='{$value['html_url']}' target='_blank'>{$value['name']}</a></td>
                    <td>{$value['description']}</td>
                    </tr>";
                    }

              
           
 
                    echo '</table>';
                    echo '</div>';
                

         }

         if ($sumbitType == "follow") {

 
          echo '<div class="result">';
          echo '<ul class="pagination">';
            for ($i=1; $i < $fromPageNumber; $i++) { 
              echo "<li class='page-item'><a class='page-link' href='process.php?page=$i&user=$userName&type=$sumbitType&number=$aggPageNumber'>$i</a></li>";
            }
            echo "<li class='page-item active'><a class='page-link' href='process.php?page=$fromPageNumber&user=$userName&type=$sumbitType&number=pageNumber'>$fromPageNumber</a></li>";
            for ($i=$fromPageNumber+1; $i < $aggPageNumber; $i++) { 
              echo "<li class='page-item'><a class='page-link' href='process.php?page=$i&user=$userName&type=$sumbitType&number=$aggPageNumber'>$i</a></li>";
            }
            echo '</ul>';
            tableHeader("N", "ფოტო", "სახელი");
              $result = parseJson("https://api.github.com/users/$userName/followers?per_page=100&page=$fromPageNumber");
              $api = json_decode($result, true);
              $zorg = ($fromPageNumber-1) * 100 +1;

              foreach($api as $key => $value) 
                  {
                    echo "<tr>
                    <td>" . $zorg++ . "</td>
                    <td><a href='{$value['html_url']}' target='_blank'><img class='nano' src='{$value['avatar_url']}' alt='' style='width: 42px'></a></td>
                    <td>{$value['login']}</td>
                    </tr>";
                  }

            
         

                  echo '</table>';
                  echo '</div>';
                

       }


        
      ?>
    </div>
  </body>
</html>
