<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href ="style.css" rel="stylesheet"/>
    <title>Second Challenge</title>
  </head>
  <body>

<div class="form_container">
  <form  action="index.php" method="POST" enctype="multipart/form-data" class="row g-3 form">
  <div class="col-md-4">
    <label for="validationDefault01" class="form-label">Enter Github Username:</label>
    <input type="text"  name="username" placeholder="Enter username" class="form-control" required>
  </div>
  <div class="col-md-3">
    <label for="validationDefault04" class="form-label">Choose List Type</label>
    <select class="form-select"  name="option" required>
      <option selected  value="">Choose...</option>
      <option value="repositories">repositories</option>
      <option value="followers">followers</option>
      
    </select>
  </div>
  <div class="col-12">
  <input type="submit" name="submit" value="submit" class="btn btn-dark sub_btn">
  </div>
</form>
</div>
  <?php  if ($_SERVER['REQUEST_METHOD'] === 'POST'):?>
        <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col">URL</th>  
        </tr>
      </thead>
      <tbody>
 <?php require_once 'api.php'; ?>
  <?php if ($user_exist):
        require_once 'choice.php';
  elseif (strlen($username) !== 0 && !$user_exist): ?>
              <div>
                <p style="color:red; font-size:22px; padding-left:20px;">Error, User Not Found!</p>
              </div>
    <?php endif; ?> 
 <?php endif; ?>
</body>
</html>