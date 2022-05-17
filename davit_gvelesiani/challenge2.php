<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Challenge #2</title>
  </head>
  <body>
    
    <form method="POST">        
        <input type="text" name="userName" placeholder="user name">
        </br>
        </br>
        <input type="checkbox" name="followers">followers</input>
        <input type="checkbox" name="repos">repositories</input>
        <input type="submit" name="submit" />
    </form>


<?php
    if(isset($_POST['submit'])){
       $userName=$_POST['userName'];
        $url="https://api.github.com/users/$userName/repos";
        $param=[
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP'
                ]
            ]
        ];

        $json = file_get_contents($url, false, stream_context_create($param));
        $data = json_decode($json, false);
        
        echo "<h1>Repos:</h1>";
        
        if($_POST['repos']){
            foreach ($data as $user) {           
            echo "name: ".$user->name;
            echo "<br />";
            echo "<a href='$user->html_url'>Click here to view</a>";
            echo "<br /> <br />";
            }
        }
        

        $url="https://api.github.com/users/$userName/followers";
        $param=[
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP'
                ]
            ]
        ];

        $json = file_get_contents($url, false, stream_context_create($param));
        $data = json_decode($json, false);

        echo "<h1>Followers:</h1>";
        
        if($_POST['followers']){
            foreach ($data as $user) {        
            echo "name: ".$user->login;
            echo "<br />";
            echo "<a href='$user->html_url'><img src='$user->avatar_url'/></a>";
            echo "<br /> <br />";
            } 
        }
        
    }
    

?>

</html>