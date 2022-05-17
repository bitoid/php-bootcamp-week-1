<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <title>Challenge #1</title>
  </head>
  <body>
    
    <form method="POST" enctype="multipart/form-data">        
        <input type="text" name="firstName" placeholder="First name">
        <input type="text" name="lastName" placeholder="Last name">
        <input type="file" name="image" />
       
        <input type="submit" name="submit" />
    </form>

    
<?php
  if(isset($_POST['submit'])){
    
    $img_name=$_FILES['image']['name'];
    $tmp_img_name=$_FILES['image']['tmp_name'];
    move_uploaded_file($tmp_img_name,$img_name);

    echo "<img src='./$img_name' />";
  }  

?>
    

<?php
    if($_POST['firstName'] && $_POST['lastName']){
      if(ctype_alpha($_POST['firstName']) && ctype_alpha($_POST['lastName'])){
        print "<h1>Username: " . $_POST['firstName'] . " " . $_POST['lastName'] . "</h1";
        }else{ 
        echo "only alphabet characters required!";
        }
    }
    
?>

  </body>
</html>