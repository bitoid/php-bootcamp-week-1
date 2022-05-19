<!DOCTYPE html>
<html>
<link rel="stylesheet" href="./style.css">
<html>
<head>
<title>Bitoid Technologies: Challenge #2</title>
</head>
    <div class="center">
    <img src="github.png" alt="github">
</div>
<form class="center" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div>
    <label for="name"><b>Enter name of github user: </b></label>
    <input type="text" placeholder="Enter GitHub UserName" name="name" require><br>
    <label for="item"><b>Choose a content: </b></label>
    <select name="item">
      <option value="repos">Repositoryes</option>
      <option value="followers">Followers</option>
    </select>
    <input type="submit" name="submit">    
  </div>
</form>

   <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name =  $_POST['name'];
   $item = $_POST['item'];

   // Create a stream
$param = [
  'http' => [
    'method' => 'GET',
    'header' => [
      'User-Agent: PHP'
    ]
  ]
];

$context = stream_context_create($param);

if (isset($name)) {

    $url = 'https://api.github.com/users/' .$name. '/' .$item.'?page=1&per_page=30';

    $result = json_decode(file_get_contents($url, false, $context));
    if (empty($result)) {
      $i=0;
    }
    else {
      foreach ($result as $value) {
        if ($_POST['item']=="repos") {
          $str =strrev($value->html_url);
          $array[] = strrev(substr($str, 0, strpos($str, '/')));
        }
        else{
          $array[] = [
            'login' => $value->login,
            'avatar' => $value->avatar_url
          ];
        }
      }
    }
  
}
}
  ?>

<div class="center">
  <ol>
    <?php foreach ($array as $info): ?>
      <li>
        <?php if ($item==="repos" ) {?> 
          <h2>
              <?php echo $info; ?>
          </h2> <?php
        }
        else {
          ?>

  <div>
    <h1>I am  <?php echo $info['login'] ?> </h1>
    <div class="image" style="background-image: url('<?php echo $info['avatar']?>');">
          <a href="https://github.com/<?php echo $info['login'] ?>" target=”_blank”> <button class="follow">Follow me</button> </a>
    </div>

<?php } ?>
      </li>
      <?php endforeach; ?>
</ol>
</div>
</html>