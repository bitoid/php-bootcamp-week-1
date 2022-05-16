
<!--                          Week 1 Project 1                        -->


<?php 
  //Pre described variables
  $image=$_FILES['image'] ?? null;
  $imagePath='';
  $errors=[];
  $name=$_POST['name'];
  $lastname=$_POST['lastname'];

  //Cheking name and last name if they are alphabet characters (A to Z)
  if (preg_match("/[^A-Za-z'-]/",$name)){
      
    $errors[]='Invalid Name. <br /> Should be only alphabet characters (A to Z)';
  }
  if (preg_match("/[^A-Za-z'-]/",$lastname)){
      
    $errors[]='Invalid Last name. <br /> Should be only alphabet characters (A to Z)';
  }

  //If last name and name was correctly added uploading image
  if(empty($errors)){  
    if (!is_dir('images')){
      mkdir('images');
    }

    if(isset($image)){
      $imagePath = 'images/'.$image['name'] ;
      move_uploaded_file($image['tmp_name'],$imagePath);
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Week 1 - Project 1</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap, CSS -->
    <link href="appcss.css"  rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <h1>Week 1 - Project 1</h1>
      <!-- If there are any errors, print them -->
      <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                    <div><?php echo $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
      <!-- Submitting with POST method -->
      <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label >Upload image</label>
          <input type="file" name="image" />
        </div>
        <div class="form-group">
          <label >Name and Last Name contain only alphabet characters (A to Z)</label>
          <input type="text" class="form-control" name="name" placeholder="Name" />
        </div>
        <div class="form-group">
          <input type="lastname" class="form-control" name="lastname" placeholder="Last name"  />
        </div>
        <div class="form-group">   
          <button type="submit" class="btn btn-primary" name="upload">Submit</button>      
        </div>
      </form>
      <!-- Bootstrap CSS Table -->
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Lastname</th>
          </tr>
        </thead>
    <tbody>
      <!-- Showing results if no errors -->
      <?php if (empty($errors)): ?>
        <tr>
          <td>
            <img src="<?php echo $imagePath?>" alt="No File Choosen" class="product-img">
          </td>
          <td>
            <?php echo $name ?>
          </td>
          <td>
            <?php echo $lastname ?>
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
      
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
