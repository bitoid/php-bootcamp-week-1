
<!--                            Week 1 Project 2                        -->

<?php 
  //Pre described variables
$name=$_POST['name'];
$way=$_POST['select'];
$page=1; // Variable for while loop pages
// Open the file using the HTTP headers 
$param = [
  'http' => [
      'method' => 'GET',
      'header' => [
          'User-Agent: PHP'
      ]
  ]
];
$context = stream_context_create($param);
// when name submited starting while loop file_get_content for data
if (isset($name)){
  while (true){    
    $file = file_get_contents('https://api.github.com/users/'. $name .'/'.$way . '?page=' . $page .'&per_page=100', false, $context);
    $data=json_decode($file,false);
    
    // access to every object value in the way that you want
    foreach ($data as $obj){
      $arr[]= $obj->html_url;
    }
    $page++;
    // When there is no more data, breaking while loop
    if (empty($data)){   
      break;
    }    
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Week 1 Project 2</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap, CSS -->
    <link href="appcss.css"  rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <!-- HTML body-->
    <form action="" method="POST">
      <div class="form-group">
        <label >Enter Github Username</label>
        <input type="text" class="form-control" name="name" placeholder="Username" />
      </div>
      <div class="form-group">
        <select class="form-select" name="select" aria-label="Default select example">
          <option selected>Open this select menu</option>
          <option value="repos">Repos</option>
          <option value="followers">Followers</option>
        </select>
      </div>
      <div class="form-group">   
        <button type="submit" class="btn btn-primary" >Submit</button>      
      </div>
    </form>
    <!-- Showing list of resoults -->
    <div>
      <!-- Repos -->
        <?php if ($way==="repos"): ?>
          <ul class="columns" data-columns="4">
          <?php foreach ($arr as $new) : ?>
              <li>
                <a href="<?php echo $new ?>"><?php echo str_ireplace("https://github.com/".$name ."/", "", $new) ?></a>
              </li>
          <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <!-- Followers -->
        <?php if ($way==="followers"): ?>
          <ul class="columns" data-columns="4">
          <?php foreach ($arr as $new) : ?>
              <li>
                <a href="<?php echo $new ?>"><?php echo str_ireplace("https://github.com/", "", $new) ?><br>
                <img class="images" src="<?php echo 'https://avatars.githubusercontent.com/'. str_ireplace("https://github.com/", "", $new) ?>" alt="Italian Trulli">
                </a>
            </li>
          <?php endforeach; ?>
          </ul>
        <?php endif; ?>
          </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
