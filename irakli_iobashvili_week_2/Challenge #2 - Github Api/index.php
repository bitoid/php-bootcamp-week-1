<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
    <h1>Enter Github username:</h1>
    <div class="form-class">
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
  </div>
    <?php 
      include 'functions.php';
      if(isset($_POST["username"])){
        $username = $_POST['username'];
        $pages = getPages($username);
        $num = 1;
      }
      $headers = [
        'User-Agent: GitHub-username'
        ];
        // Get how many public repositories user has
          ?>
        <?php if($username ?? null): ?>
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
          <?php endif; ?>
    
<!-- If User chooses Both -->
<?php if(isset($username) && isset($_POST['repos']) && isset($_POST['followers'])){ ?>
  <a href="#followers">Followers</a>
  <h1>Repositories</h1>
  <?php

for($x = 1; $x < $pages + 1; $x++){
  $decoded = getDecode($username, 'repos', $x);
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
      <h1 id="followers">Followers</h1>
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
    $decoded = getDecode($username, 'followers', $x);

  ?>
        <?php foreach($decoded as $follower): ?>
        <tr>
          <td><?= $num?></td>
          <td><a href="<?=$follower["html_url"]?>" target="_blank"><img src="<?=$follower['avatar_url']?>" alt='user-photo' style='width:100px;height:100px;'></a></td>
          <td><?= $follower["login"]?></td>
        </tr>
        <?php $num++; ?>
        <?php endforeach; }?>
      </tbody>
      </table>
    </tbody>
  </table>
</main>
</body>
</html>
      
<!-- If user only chooses repos -->
<?php }else if(isset($username) && isset($_POST['repos'])){ 

  for($x = 1; $x < $pages + 1; $x++){
  $decoded = getDecode($username, 'repos', $x);
?>
      <?php foreach($decoded as $repo): ?>
        <tr>
          <td><?= $num ?></td>
          <td><?= $repo['id']?></td>
          <td><a href="<?= $repo['html_url']?>" target="_blank"><?= $repo['name']?></a></td>
          <td><?= $repo['description']?></td>
        </tr>
        <?php $num++; ?>
        <?php endforeach; } ?>
      </tbody>
      </table>
    </tbody>
  </table>
      </main>
</body>
</html>

<!-- If User only chooses followers -->
<?php }else if(isset($username) && isset($_POST["followers"])){

  for($x = 1; $x < $pages + 1; $x++){
    $decoded = getDecode($username, 'followers', $x);
  ?>
        <?php foreach($decoded as $follower): ?>
        <tr>
          <td><?= $num?></td>
          <td><a href="<?=$follower["html_url"]?>" target="_blank"><img src="<?=$follower['avatar_url']?>" alt='user-photo' style='width:100px;height:100px;'></a></td>
          <td><?= $follower["login"]?></td>
        </tr>
        <?php $num++; ?>
        <?php endforeach; } }?>
      </tbody>
      </table>
    </tbody>
  </table>
      </main>
</body>
</html>