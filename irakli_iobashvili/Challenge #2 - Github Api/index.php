<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <main>
    <form action="" method="post">
      <div class="belowPadding">
        <input type="text" name="username">
        <input type="checkbox" name="repos"  value="repositories">
        <label for="repos">Repositories</label>
        <input type="checkbox" name="followers"  value="followers">
        <label for="repos">followers</label>
      </div>
      <button type="submit">Submit</button>
    </form>
    <?php 
      if(isset($_POST["username"])){
        $username = $_POST['username'];
      }
    ?>
<?php if(isset($username) && isset($_POST['repos']) && isset($_POST['followers'])){ ?>
  <?php

$headers = [
  "User-Agent: api test",
  "Authorization: token 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"
];
// Get how many public repositories user has
  $ch = curl_init("https://api.github.com/users/".$username);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $responseRepo = curl_exec($ch);
  curl_close($ch);
  $decoded = json_decode($responseRepo, true);
  // Number of public repositories
  $publicRepos = $decoded["public_repos"];
  $pages = ceil($publicRepos / 100);
  echo "<h1>Repositories</h1>";
  $num = 1;
  ?>
  <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
  <?php
for($x = 1; $x < $pages + 1; $x++){
  $ch = curl_init("https://api.github.com/users/".$username."/repos?per_page=100&page=".$x."");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);
  $decoded = json_decode($response, true);
  // print_r($decoded);
  
  // foreach ($decoded as $repo){
  //   echo $num . ": " . $repo['name'] . "<br/>";
  //   $num++;
  // }

?>
      <?php foreach($decoded as $repo): ?>
        <tr>
          <td><?= $num ?></td>
          <td><?= $repo['id']?></td>
          <td><a href="<?= $repo['html_url']?>" target="_blank"><?= $repo['name']?></a></td>
          <td><?= $repo['description']?></td>
        </tr>
        <?php $num++; ?>
        <?php endforeach; ?>
        <?php } ?>
        
      </tbody>
      </table>
    </tbody>
  </table>
      </main>
  <?php 
  $ch = curl_init("https://api.github.com/users/".$username);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $responseRepo = curl_exec($ch);
  curl_close($ch);
  $decoded = json_decode($responseRepo, true);
  // Number of public repositories
  $publicRepos = $decoded["followers"];
  $pages = ceil($publicRepos / 100);
  echo "<h1>Followers</h1>";
  $num = 1;
  ?>
    <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>Picture</th>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>
    <?php
  for($x = 1; $x < $pages + 1; $x++){
  $ch = curl_init("https://api.github.com/users/".$username."/followers?per_page=100&page=".$x."");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);
  $decoded = json_decode($response, true);
  ?>
        <?php foreach($decoded as $follower): ?>
        <tr>
          <td><?= $num?></td>
          <td><a href="<?=$follower["html_url"]?>" target="_blank"><img src="<?=$follower['avatar_url']?>" alt='user-photo' style='width:100px;height:100px;'></a></td>
          <td><?= $follower["login"]?></td>
        </tr>
        <?php $num++; ?>
        <?php endforeach; ?>
        <?php } ?>
      </tbody>
      </table>
    </tbody>
  </table>
      </main>
</body>
</html>
      

<?php }else if(isset($username) && isset($_POST['repos'])){ ?>
<?php

$headers = [
  "User-Agent: api test",
  "Authorization: token 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"
];
// Get how many public repositories user has
  $ch = curl_init("https://api.github.com/users/".$username);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $responseRepo = curl_exec($ch);
  curl_close($ch);
  $decoded = json_decode($responseRepo, true);
  // Number of public repositories
  $publicRepos = $decoded["public_repos"];
  $pages = ceil($publicRepos / 100);
  echo "<h1>Repositories</h1>";
  $num = 1;
  ?>
  <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
  <?php
for($x = 1; $x < $pages + 1; $x++){
  $ch = curl_init("https://api.github.com/users/".$username."/repos?per_page=100&page=".$x."");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);
  $decoded = json_decode($response, true);
  // print_r($decoded);
  
  // foreach ($decoded as $repo){
  //   echo $num . ": " . $repo['name'] . "<br/>";
  //   $num++;
  // }

?>
      <?php foreach($decoded as $repo): ?>
        <tr>
          <td><?= $num ?></td>
          <td><?= $repo['id']?></td>
          <td><a href="<?= $repo['html_url']?>" target="_blank"><?= $repo['name']?></a></td>
          <td><?= $repo['description']?></td>
        </tr>
        <?php $num++; ?>
        <?php endforeach; ?>
        <?php } ?>
      </tbody>
      </table>
    </tbody>
  </table>
      </main>
</body>
</html>
<?php }else if(isset($username) && isset($_POST["followers"])){
// Get how many public follower user has
$headers = [
  "User-Agent: api test",
  "Authorization: token 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"
];
  $ch = curl_init("https://api.github.com/users/".$username);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $responseRepo = curl_exec($ch);
  curl_close($ch);
  $decoded = json_decode($responseRepo, true);
  // Number of public repositories
  $publicRepos = $decoded["followers"];
  $pages = ceil($publicRepos / 100);
  echo "<h1>Followers</h1>";
  $num = 1;
  ?>
    <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>Picture</th>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>
    <?php
  for($x = 1; $x < $pages + 1; $x++){
  $ch = curl_init("https://api.github.com/users/".$username."/followers?per_page=100&page=".$x."");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);
  $decoded = json_decode($response, true);
  ?>
        <?php foreach($decoded as $follower): ?>
        <tr>
          <td><?= $num?></td>
          <td><a href="<?=$follower["html_url"]?>" target="_blank"><img src="<?=$follower['avatar_url']?>" alt='user-photo' style='width:100px;height:100px;'></a></td>
          <td><?= $follower["login"]?></td>
        </tr>
        <?php $num++; ?>
        <?php endforeach; ?>
        <?php } ?>
<?php } ?>
      </tbody>
      </table>
    </tbody>
  </table>
      </main>
</body>
</html>
<a href=""></a>