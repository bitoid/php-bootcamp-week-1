<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=person','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$statement = $pdo -> prepare('SELECT * FROM profiles');
$statement ->execute();
$profiles = $statement->fetchAll(PDO::FETCH_ASSOC);

$errors= [];
$name= '';
$surname = '';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{ $name =$_POST['name'];
$surname =$_POST['surname'];
$image =$_FILES['image'] ?? null;
$imagePath = '';

if(!is_dir('images'))
{
    mkdir('images');
}
if($image)
{
  $imagePath = 'images/'.randomString(8).'/'.$image['name'];
  mkdir(dirname($imagePath));
  move_uploaded_file($image['tmp_name'], $imagePath);
}
if(!$surname ) 
{
    $errors[] = 'Surname is required';

}
if(!$name)
{
    $errors[] = 'Product price is required';
}

if(empty($errors))
{
    $statement = $pdo->prepare("INSERT INTO profiles(image,name,surname)
    VALUES(:image,:name,:surname)");
    $statement->bindValue(':image',$imagePath);
    $statement->bindValue(':name',$name);
    $statement->bindValue(':surname',$surname);
  
    
    $statement->execute();
    header('Location: index.php');
    }
    
}

function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for($i=0; $i<$n; $i++)
    {
    $index = rand(0, strlen($characters)-1);
    $str.= $characters[$index];
    }

    return $str;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet"/>
  </head>
  <body>
  <?php if(!empty($errors)):?>
    <div class="alert alert-danger">
        <?php foreach($errors as $error):?>
            <div><?php echo $error ?></div>
      <?php endforeach; ?>
 <?php endif; ?>
  <form  method="post" enctype="multipart/form-data">
    <div class="container">
  <div class="mb-3 form-check">
    <label>Image</label>
    <input type="file" name="image">
  </div>
  <div class="mb-3 form-check">
    <label>Name</label>
    <input type="text" name="name" pattern="[a-zA-Z'-'\s]*" >
  </div>
  <div class="mb-3 form-check">
  <label>Surname</label>
    <input type="text" name="surname" pattern="[a-zA-Z'-'\s]*" >
  </div>
  <div class="mb-3 form-check">
  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
  </div>
  </div>
  </form>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Surname</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($profiles as $i => $profile) : ?>
        <tr>
      <th scope="row"><?php echo $i + 1 ?></th>
      <td>
       <?php if($profile['image']): ?>
     <img src="<?php echo $profile['image'] ?>" alt="<?php echo $profile['name'] ?>" class="pic"/>
      <?php endif; ?>
      </td>
      <td><?php echo $profile['name'] ?></td>
      <td><?php echo $profile['surname'] ?></td>
      <?php endforeach; ?>
      </tr>
     </tbody>
  </table>

  </body>
</html>