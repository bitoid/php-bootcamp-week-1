<!doctype HTML>
<html>
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Challange 1</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body class="container">
          <?php 
          if(isset($_POST['submit']) && isset($_FILES['profile']) && $_POST['name'] && $_POST['surname']){
            if(ctype_alpha($_POST['name']) || ctype_alpha($_POST['surname'])){
              print '<h1>' . 'Name:' .'</h1>' . $_POST['name'];
              print '<h1>' . 'Surname:' .'</h1>' . $_POST['surname'];
              print '<h1>Profile Picture:</h1>'; 
            }else{
              echo "<div class='alert alert-danger'>Name and surname should be written with letters A-z</div>";
            }
            echo '<h1>Image</h1>';
            $imageData = file_get_contents($_FILES['profile']['tmp_name']); 
            echo sprintf('<img src="data:image/png;base64,%s" />', base64_encode($imageData));

          }  else{
            header("Location: index.php");
          }?>

    </body>
</html>
