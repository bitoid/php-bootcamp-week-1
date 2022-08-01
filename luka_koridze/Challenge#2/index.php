<?php
    error_reporting(E_ERROR | E_PARSE);
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
         // username
    $user = $_POST['username'];
    // To solve ---Failed to open stream: HTTP request failed! HTTP/1.1 403 Forbidden--- Error;
    // This happens when browser doesn't know that requiester is a human
    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );
    // Getting Repositories Data from User
    $rawReposData = file_get_contents("https://api.github.com/users/$user/repos", false, $context);
    // Parsing Data from Repository Data
    $reposData = json_decode($rawReposData);
    // Followers Part
    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );
    // Getting follower Data from User
    $rawFollowersData = file_get_contents("https://api.github.com/users/$user/followers", false, $context);
    // Parsing Data from Followers Data
    $followersData = json_decode($rawFollowersData);
    }
   
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./reset.css"/>
    <link rel="stylesheet" href="./style.css"/>
    <title>Repositories and Followers</title>
</head>
<body>
    <form action="./index.php" method="POST" enctype="multipart/form-data">
        <label for="username">Enter your GitHub username</label>
        <input type="text" placeholder="username" name="username" id="username" required>
        <input type="submit" placeholder='Submit'>
    </form>
    <div class="container" style='display: <?php $display ?>'>
    <div class="repos">
    <?php
        if(isset($_POST['username']) && $followersData!==null){
            echo "<h1 class='title'> Repositories </h1>";
        foreach ($reposData as $repo) {
            echo "<h1> $repo->name </h1>";
        };
        }else{
            echo "<h1>Please Enter a valid username to see the repositories</h1>";
        }
    ?>
    </div>
    <div class="followers">
    <?php
    if(isset($_POST['username']) && $followersData!==null){
        echo "<h1 class='title'> Followers </h1>";
        foreach ($followersData as $follower) {
            
            echo "<div class='box'><h1 class='followerName'>$follower->login</h1><img src=$follower->avatar_url alt='User avatar /></div>";
        };
    }else{
        echo "<h1>Please Enter a valid username to see the followers</h1>";
    }
    ?>
    </div>
    </div>
   
</body>
</html>
