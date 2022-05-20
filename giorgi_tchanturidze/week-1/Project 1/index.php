
<!--                            Week 1 Project 2                        -->

<?php
  //Cheking name and surname if they are alphabet characters (A to Z)
    if (preg_match("/[^A-Za-z'-]/",$_POST['name'])){

      $errors[]='Invalid Name. <br /> Should be only alphabet characters (A to Z)';
    }
    if (preg_match("/[^A-Za-z'-]/",$_POST['surname'])){

      $errors[]='Invalid Last name. <br /> Should be only alphabet characters (A to Z)';
    }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title>Upload image</title>
  <link href="appcss.css"  rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body class="container">
  <?php if(empty($_POST) || !empty($errors)):?>
    <!-- If there are any errors, print them -->
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <?php foreach($errors as $error): ?>
          <div><?php echo $error ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <!-- Submitting with POST method -->
  <form action="/index.php" method="post" enctype="multipart/form-data">
    <div class="mt-5">
      <p class="h6">Should be only alphabet characters (A to Z)</p>
      <input type="text"name="name"placeholder="Name"class="form-control mb-3">
      <input type="text"name="surname"placeholder="Surname"class="form-control mb-3">
      <input type="file"name="image"class="form-control mb-3">
      <input type="submit" value="submit" class="btn btn-primary form-control mb-3">
    </div>
  </form>
  <?php else: ?>
  <?php
  // making image folder if dont exist already
  if (!is_dir('images')){
    mkdir('images');
  }
  // if file was submited, uploading to local folder
  if(isset($_FILES['image'])){
    $imagePath = 'images/'.$_FILES['image']['name'] ;
    move_uploaded_file($_FILES['image']['tmp_name'],$imagePath);
  }
  ?>
  <!-- Showing results -->
  <div class="card mb-3">
    <img src="<?php print $imagePath?>" width="500">
    <div class="card body">
    <h5 class="card-title"><?php echo $_POST['name'] . ' ' .  $_POST['surname']?></h5>
    <p class="card-text" ><small class="text-muted">Image uploaded on: <?php print date('d/Y/M') ?> </small></p>
    </div>
  </div>
  <?php endif; ?>

</body>

</html>