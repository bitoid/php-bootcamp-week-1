<?php
  $name = '';
  $surname = '';
  $image = '';
  $error = '';

  if (isset($_POST['submit'])) {
    if (isset($_POST['first_name']) && !empty($_POST['first_name'])) {
      if (ctype_alpha($_POST['first_name'])) {
        $name = $_POST['first_name'];
      }
      else {
        $error = 'Error: first name contains numbers';
      }
    }

    if (isset($_POST['last_name']) && !empty($_POST['last_name'])) {
      if (ctype_alpha($_POST['last_name'])) {
        $surname = $_POST['last_name'];
      }
      else {
        $error = 'Error: last name contains numbers';
      }
    }

    if (isset($_FILES['image']) && !empty($_FILES['image']) && !$_FILES['image']['error']) {
      $uploads_directory = './images';
      $tmp_name = $_FILES['image']['tmp_name'];
      $image = basename($_FILES['image']['name']);
      move_uploaded_file($tmp_name, "$uploads_directory/$image");
    }
    else {
      $error = 'Error: image upload has failed';
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
      <title>Form</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger mb-2" role="alert">
              <?php print $error; ?>
            </div>
          <?php endif; ?>
          <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 col-form-label" for="first-name">First name</label>
              <input type="text" name="first_name" class="form-control" id="first-name" placeholder="First name" required>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-form-label" for="last-name">Last name</label>
              <input type="text" name="last_name" class="form-control" id="last-name" placeholder="Last name" required>
            </div>
            <div class="form-group mt-3 mb-3">
              <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>

      <?php if (!$error): ?>
        <div class="row mt-5">
          <div class="col-md-6">
            <?php if ($name && $surname): ?>
              <h2> <?php print $name . ' ' . $surname ?></h2>
            <?php endif; ?>
          </div>
        </div>
        <div class="row">
          <?php if ($image): ?>
            <div class="mt-3 col-md-3">
              <img src="<?php print '/images/' . $image ?>" />
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </body>
</html>
