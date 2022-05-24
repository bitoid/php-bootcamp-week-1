<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form action="index.php" method="post">
    <input type="text" name="username" placeholder="Github username" required ><br><br>
    <label for="select">Select:</label>
    <select class="form-select" name="select" required>
      <option value=""></option>
      <option name="option" value="repositories">repositories</option>
      <option name="option" value="followers">followers</option>
      <option name="option" value="both">both</option>
    </select> 
    <br><br>
    <input type="submit" name="submit" value="Submit"><br><br>
  </form>   
</body>
</html>
<?php
$username= $_POST["username"];
if($_POST["select"] == "repositories"){
  repos($username);
}elseif($_POST["select"] == "followers"){
  followers($username);
}elseif($_POST["select"] == "both"){
  repos($username);
  followers($username);
}
?>

<?php
function repos($username){
 $p=1;
    $user_repos = "https://api.github.com/users/$username/repos?page=$p&per_page=100";
    $opts= [
      'http' => [
        'method' => 'GET',
          'header' => [
            'User-Agent: PHP'
          ]
      ]
    ];
    $content =stream_context_create($opts);
    $file_repo = file_get_contents($user_repos, false, $content);
    $data_repo = json_decode($file_repo, true);
    ?>
    <ul>
      <?php
        for ($i=0; $i < count($data_repo); $i++) { 
      ?>              
        <li class="repo-item">
          <a href="<?php echo $data_repo[$i]["html_url"]?>" class="btn btn-dark btn-lg">
          <span>
            <?php echo $data_repo[$i]["name"];?>                             
            </span>
          </a>
        </li>                  
      <?php
        }              
      ?>                       
      </ul>
        <?php

}
?>

<?php
function followers($username){
  $p=1;
  $user_followers = "https://api.github.com/users/$username/followers?page=$p&per_page=100";
    $opts= [
      'http' => [
        'method' => 'GET',
          'header' => [
            'User-Agent: PHP'
          ]
      ]
    ];
    $content =stream_context_create($opts);
    $file_followers = file_get_contents($user_followers, false, $content);
    $data_followers = json_decode($file_followers, true);
    ?>
    <ul>
    <?php
    for ($i=0; $i < count($data_followers); $i++) { 
    ?>
        <li>
        <img src="<?php echo $data_followers[$i]["avatar_url"];?>" width="100" alt="">
            <a href="<?php echo $data_followers[$i]["html_url"];?>" >
            <span>
           
            <?php echo $data_followers[$i]["login"];?>
            </span>    
            </a>
            
        </li>
    <?php
    }
    ?>  
    </ul>
        <?php
  }
?>
 






