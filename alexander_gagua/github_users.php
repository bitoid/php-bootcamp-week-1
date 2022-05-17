<?php

$data = [];
$username = '';

function github_request($name, $type) {
  $c = curl_init();
  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json', 'User-Agent: Github-Project', 'x-ratelimit-limit: 60'));
  curl_setopt($c, CURLOPT_URL, 'https://api.github.com/users/' . $name . '/' . $type);

  $content = curl_exec($c);

  curl_close($c);

  $data = json_decode($content);

  return $data;
}

if (isset($_POST['submit'])) {
  if (!empty($_POST['username'])) {
    $username = $_POST['username'];

    if (!empty($_POST['repositories'])) {
      $data['repos'] = github_request($username, 'repos');
    }

    if (!empty($_POST['followers'])) {
      $data['followers'] = github_request($username, 'followers');
    }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
      <title>Github users and followers</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
  <body>
    <div class="container">
      <div class="row">
        <h1>Github project</h1>
        <form action="github_users.php" method="post" enctype="multipart/form-data">
          <div class="form-group mb-2">
            <div class="col-md-4">
              <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
            </div>
          </div>
          <div class="form-group mb-2">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="repositories">
            <label class="form-check-label" for="repositories">Repositories</label>
          </div>
          <div class="form-group mb-2">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="followers">
            <label class="form-check-label" for="followers">Followers</label>
          </div>
          <button type="submit" name="submit" class="btn btn-primary mb-2s">Submit</button>
        </form>
        <?php if (isset($data['repos']) && !empty($data['repos'])): ?>
        <div class="col-md-6">
          <ul class="list-style">
            <h1><?php print $username ?>'s repositories:</h1>
            <?php foreach ($data['repos'] as $content): ?>
              <li>
                <a href="<?php print $content->html_url ?>" target="_blank"><?php print $content->name ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
        <?php if (isset($data['followers']) && !empty($data['followers'])): ?>
          <div class="col-md-6">
            <h1><?php print $username ?>'s Followers:</h1>
            <?php foreach ($data['followers'] as $content): ?>
              <h4><?php print $content->login ?></h4>
              <div class="content">
                <a href="<?php print $content->html_url ?>" target="_blank">
                  <img src="<?php print $content->avatar_url ?>" width="300" height="300" /> 
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </body>
</html>
