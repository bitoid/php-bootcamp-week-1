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
        <input type="checkbox" name="followers">followers</input>
        <input type="checkbox" name="repos">repositories</input>
        <input type="submit" name="submit" />
    </form>


  <?php
      if(isset($_POST['submit'])){
         $userName=$_POST['userName'];
          $repos_url="https://api.github.com/users/$userName/repos";
          $repos_param=[
              'http' => [
                  'method' => 'GET',
                  'header' => [
                      'User-Agent: PHP'
                  ]
              ]
          ];

          $repos_json = file_get_contents($repos_url, false, stream_context_create($repos_param));
          $repos_data = json_decode($repos_json, false);

          echo "<h1>Repos:</h1>";

          if($_POST['repos']){
              foreach ($repos_data as $user) {           
              echo "name: ".$user->name;
              echo "<br />";
              echo "<a href='$user->html_url'>Click here to view</a>";
              echo "<br /> <br />";
              }
          }


          $followers_url="https://api.github.com/users/$userName/followers";
          $followers_param=[
              'http' => [
                  'method' => 'GET',
                  'header' => [
                      'User-Agent: PHP'
                  ]
              ]
          ];

          $followers_json = file_get_contents($followers_url, false, stream_context_create($followers_param));
          $followers_data = json_decode($followers_json, false);

          echo "<h1>Followers:</h1>";

          if($_POST['followers']){
              foreach ($followers_data as $user) {        
              echo "name: ".$user->login;
              echo "<br />";
              echo "<a href='$user->html_url'><img src='$user->avatar_url'/></a>";
              echo "<br /> <br />";
              } 
          }
      }
  ?>

</html>
