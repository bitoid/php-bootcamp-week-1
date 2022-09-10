<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.rtl.min.css" integrity="sha384-+4j30LffJ4tgIMrq9CwHvn0NjEvmuDCOfk6Rpg2xg7zgOxWWtLtozDEEVvBPgHqE" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<body>

  <?php include "validation.php" ?>
    <?php if(empty($_POST) || !empty($name_error) || !empty($last_error) ||!empty($file_error)): ?>
      
     
        <form action="" method="post" enctype="multipart/form-data">
            <label for="">Firstname</label>
            <br>
            <input type="text" name="firstname" class="feedback-input" placeholder="First Name" >
            <span><?= $name_error ?></span>
            <br>
            <label for="">Lastname</label>
            <br>
            <input type="text" name="lastname" class="feedback-input" placeholder="Last Name">
            <span><?= $last_error ?></span>
            <br>
            <input type="file" name="profileimage"  class="feedback-input">
            <span><?= $file_error ?></span>
            <br>
            <input type="submit" name="submit" class="btn btn-primary" />
</form>
<?php  
else:
?>
<div>
<ul class="list">
        <li class= "list"><?php  echo "<h1>" . $_POST ['firstname'] .' '.  $_POST ['lastname'] ."</h1>"; ?></li>
    </ul>
    <img src="<?php print "uploads/" .  $porfile_image;  ?>">
    
</div>

<?php endif; ?>


<style>
    body{
        margin: 50px;
        background-color: #D6EAF8 ;
    }
    input{
        width: 50%;
        padding: 10px;

    }

</style>
</body>
</html>
