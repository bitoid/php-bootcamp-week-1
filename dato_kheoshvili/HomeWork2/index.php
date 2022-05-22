<!doctype HTML>
<html>

<head>
  <link rel="stylesheet" href="style/style.css">
</head>

<body>
  <?php require_once 'create_context.php'; ?>

  <form class="form" action="" method="POST">
    <input class="formInput" type="text" name="name" placeholder="Type GitHub Username" /><br />
    <input class="formInput" type="submit" name="submit" value="Search">
  </form>

  <?php if (isset($_POST['submit'])) : ?>
    <?php
    $repos = file_get_contents('https://api.github.com/users/' . $_POST['name'] . '/repos', false, $context_repos);
    $followers = file_get_contents('https://api.github.com/users/' . $_POST['name'] . '/followers', false, $context_followers);
    ?>
    <?php if (!($repos && $followers)) : ?>
      <h3 class='errorText'>Requested user do not exist or request limit is out. Please check spelling or try again in an hour. Bellow is example user 'OtarZa'. Have a nice day.</h3>";
      <?php
      $repos = file_get_contents('tmp/tmpRepos.txt');
      $followers = file_get_contents('tmp/tmpFollowers.txt');
      ?>
    <?php endif ?>
  <?php endif ?>

  <div class="content">
    <?php $repoArr = json_decode($repos, true); ?>

    <ul class="list">
      <h5>Repositories</h5>
      <?php
      foreach ($repoArr as $key => $value) : ?>
        <li><?php echo $key ?> <?php echo $value['name'] ?></li>
      <?php endforeach ?>
    </ul>

    <?php $followersArr = json_decode($followers, true); ?>

    <ul class="list">
      <h5>Followers</h5>
      <?php foreach ($followersArr as $key => $value) : ?>
        <li> <?php echo $key ?> <?php echo $value['login'] ?></li>
      <?php endforeach ?>
    </ul>
  </div>

</body>

</html>