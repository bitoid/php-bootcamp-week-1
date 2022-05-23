<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Challenge 2</title>
</head>

<body>
<div class="container mt-2 text-center">
<form action="index.php" method="POST">
    <label class="form-label"  for="$repos"><h1 class="fs-2">Enter username here to see users Git information<h1></label>
    <input class="form-control"  type="text" name="repos" id="$repos">
    <input class="btn btn-primary mt-2" type="submit" name="submit">
</form>
</div>

<?php if(array_key_exists("submit", $_POST)):
$ch_repos = curl_init();
$url_repos = "https://api.github.com/users/" . $_POST['repos'] . "/repos";
curl_setopt_array($ch_repos,[
    CURLOPT_URL => $url_repos,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['User-Agent: PHP']
]);
$json_data = curl_exec($ch_repos);
curl_close($ch_repos);
$repos_data = json_decode($json_data);

$ch_follower = curl_init();
$url_follower = "https://api.github.com/users/" . $_POST['repos'] . "/followers"; 
curl_setopt_array($ch_follower,[
      CURLOPT_URL => $url_follower,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => ['User-Agent: PHP']
    ]);
$json_data = curl_exec($ch_follower); 
curl_close($ch_follower);  
$follower_data = json_decode($json_data);?>

  <div class="container">
    <div class="row">
      <div class="col">
        <h2>Here are <?= $_POST['repos']?>s Repositories</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col"><h3>Repository</h3></th>
      <th scope="col"><h3>Link to Repository</h3></th>
    </tr>
  </thead>
  <?php foreach($repos_data as $data):?>
        <tbody>
    <tr>
      <td scope="row"><h4> <?= $data -> name ."\n"; ?> </h4></td>
      <td class="td"><p><a href="<?= $data -> html_url ."\n"; ?>"><?= $data -> html_url ."\n"; ?></a> </p></td>
  </tr>
  <?php endforeach; ?>
  </tbody>
  </table>
  </div>
  <div class="col">
  <h2>Here are <?= $_POST['repos']  ?>s Followers</h2>
  <table class="table">
  <thead>
    <tr>
      <th scope="col"><h3>Followers</h3></th>
      <th scope="col"><h3>Avatar</h3></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($follower_data as $data):?>
    <tr>
      <td class="td"> <h4> <?= $data -> login ."\n"; ?> </h4></td>
      <td class="td"><a href="<?= $data -> html_url;  ?>"><img src="<?= $data -> avatar_url;?>" class="img-fluid" alt="NAN"></a></td>
    </tr>
  </tbody>
        <?php endforeach; ?>
        </table>
</div>
</div>
</div>
<?php endif?>

</body>
</html>