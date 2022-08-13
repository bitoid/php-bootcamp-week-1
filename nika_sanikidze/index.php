  <!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="styles.css" />
    <meta charset="UTF-8" />
  </head>
    <body> 
<?php 
if(isset($_POST['upload'])){
  if(!ctype_alpha($_POST['firstname'])){
    echo "ERROR: your name should include only alphabet characters"."<br></br>";
        }
    if(!ctype_alpha($_POST['lastname']))
    {
        echo "ERROR: your lastnanme should include only alphabet characters"."<br></br>";
    }
    if(ctype_alpha($_POST['firstname']) && ctype_alpha($_POST['lastname'])){
          echo $_POST['firstname']." ";
        echo $_POST['lastname']."<br></br>";
    } 

}else{


 ?>
       <form method="POST" action="" enctype="multipart/form-data">
       <input type="text" name="firstname" required>
      <input type="text" name="lastname" required>
                <input type="file" name="fupload" size="100000" accept="image/*" required>
                <input type="submit" name="upload" value="Upload">
       </form>
      <?php  } ?>
      <?php if($_FILES && ctype_alpha($_POST['firstname']) && ctype_alpha($_POST['lastname']))
        {
            $source=$_FILES['fupload']['tmp_name'];
            $target1 = $_FILES['fupload']['name'];
            move_uploaded_file($source,$target1);
       ?>

 
       <img width="400px" height="450px" src="<?php echo htmlspecialchars($target1);?>"

       <?php
        } // if $_FILES 
       ?>

    </body>
</html>
