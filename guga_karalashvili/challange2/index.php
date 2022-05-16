<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Bitoid Technologies: W 1- Chall 2</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <?php
    $usrName='';
    if($_POST == null){
        include './form.php';   // Get  empty form
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ // Check request method
        $usrName = $_POST['userName'];
        require_once './statusCode.php';
        if($responseCode == $userExist){ //check user exist
            include './form.php';
            require './userInfo.php';
            echo '<div class="user">';
            echo '<a href=' . "$userUrl" . 'target="_blank"' . '>' . '<img src=' . "$userAvat" . '>' . '</a>';
            echo '<h3>' . "$userLogin" . '</h3>';
            echo '<h2>Welcome to my github &#10084' . '</h2>';
            echo '</div>'; 
            if(isset($_POST['takeOption'])){        //Display repositoris
                $option = $_POST['takeOption'];   
                if($option == 'repositories'){
                    echo '<section id = "container">';
                    if($reposNum != 0){
                        echo '<h3>My Repositories' . '</h3>';
                    }
                    echo '<div class="grid-template">';
                    require './repositories.php';
                    echo '</div>';
                    echo '</section>';
                }
                if($option == "followers"){             //Display followers
                    echo '<section id = "container">';
                    if($followersNum != 0){
                        echo '<h3>My Followers' . '</h3>';
                    }    
                    echo '<div class="grid-template">';
                    require './followers.php';
                    echo '</div>';
                    echo '</section>';
                }
                if($option == "both"){                  //Display repositoris and followers 
                    echo '<section id = "container">';
                    if($reposNum != 0){
                        echo '<h3>My Repositories' . '</h3>';
                    }
                    echo '<div class="grid-template">';
                    require './repositories.php';
                    echo '</div>';
                    echo '</section>'.'<br>';
                    echo '<section id = "container">';
                    if($followersNum != 0){
                        echo '<h3>My Followers' . '</h3>';
                    }
                    echo '<div class="grid-template">';
                    require './followers.php';
                    echo '</div>';
                    echo '</section>';
                }
            } else{
                echo '<p class="userError">Please choose your option</p>'; // massage if option isnot choosed
            }
        }else {
            $usrName='';
            include './form.php';
            echo '<p class="userError">This User not found !!!</p>';
        }
    }

    ?>
</body>
</html>