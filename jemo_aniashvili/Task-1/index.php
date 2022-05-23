<?php
   $pdo = new PDO('mysql:host=localhost;port=3306;dbname=people', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM users');
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<?php  require_once 'header.php'?>
</head>

  <body>

<form action="index.php" method="post" enctype="multipart/form-data" name="myform" onsubmit="return validation()">
    <div class="container">
        
        <label for="image"><b>Profile Picture</b></label><br>
        <input type="file" placeholder="upload image" id="image" name="image">
        <br><br><br>

        <label class="nameClass" ><b>First Name</b></label><br>
        <input type="text" placeholder=" " id="username" name="username" autocomplate="off"><br>
        <br>
  
        <label class="nameClass"><b>Last Name</b></label><br>
        <input type="text" placeholder=" " id="name" name="name" autocomplate="off"><br><em><br><br><br>
        
        <div id="error"></div>

    <button type="submit" name="upload" value="submit" ><strong>Submit</strong></button>

    </div>

</form>

<?php require_once 'index.js'    ?>
<div class="new">
<?php
      if($_SERVER['REQUEST_METHOD']=='POST'){

         if(isset($_POST['upload'])){

            $image_name = $_FILES['image']['name'];
            $image_type = $_FILES['image']['type'];
            $image_size = $_FILES['image']['size'];
            $image_tmp_name = $_FILES['image']['tmp_name'];

           move_uploaded_file($image_tmp_name, "photos/$image_name");
           echo "<img src='photos/$image_name' width='220' height='250' >";
         }  
         echo "<br>";
         echo $_POST['username'];
         echo " ";
