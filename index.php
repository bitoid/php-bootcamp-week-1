<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            padding: 50px;
            margin: 50px;
        }
    </style>
    <title>Hello, world!</title>
  </head>
  <body>
<form method="POST" enctype="multipart/form-data"  >
  <div class="mb-3">
    <label  class="form-label">Name</label>
    <input type="text" name="firstname" class="form-control" >
    </div>
  <div class="mb-3">
    <label  class="form-label">Last Name</label>
    <input type="text" name="lastname"  class="form-control" >
  </div>
  <div class="mb-3">
  <label for="formFile" class="form-label">Default file input example</label>
  <input class="form-control" name="formFile"  type="file" id="formFile">
</div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form> 

<?php

if ($_POST):
   if ( !ctype_alpha($_POST["firstname"]) or !ctype_alpha($_POST["lastname"])):
     ?>
       <div class="alert alert-primary" role="alert"> შეავსეთ სწორად ველები!!!</div>
     <?php
       exit;
   endif;

   
   echo  $_POST["firstname"]. " ". $_POST["lastname"]."<br>"; 

if ($_FILES):
    
    $fileName = $_FILES["formFile"]["tmp_name"];
   

    if (move_uploaded_file( $fileName, 'temp.jpeg')) : ?>
        <img src='temp.jpeg' width='150px' />

      <?php
    endif;

  endif;
endif;
?>
<?php
// API URL
$url = 'https://api.github.com/users/otarza/followers';
$opts = [
    'http' => [
        'method' => 'GET',
        'header' => [
                'User-Agent: PHP'
        ]
    ]
];

$json = file_get_contents($url, false, stream_context_create($opts));

$obj = json_decode($json);

?>
  <div class="grid">
<?php
for ($i=0; $i<count($obj); $i++):
  
  ?>
    <div class="g-col-6"><?= $obj[$i]->login; ?></div>
  
<?php 
endfor

?>
</div>


</body>
</html>

