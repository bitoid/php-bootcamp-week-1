<!DOCTYPE html>
<html>
    <head>
        <h1>Fill Those Tabs</h1>
</head>

 <form action="form.php" method="post" enctype="multipart/form-data">
     <input type="text" name="name" placeholder="Name" required/>
     <input type="text" name="surname" placeholder="Surname" required/>
     <input type="file" name="image" required>
     <input type="submit" name="submit" />
</form>

<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    if($_POST['name'] && $_POST['surname']){
        if(ctype_alpha($_POST['name'])=='true' && ctype_alpha($_POST['surname'])=='true'){
                print $_POST['name']. ' ' .$_POST['surname'] .'<br>';

                $image=$_FILES['image']?? null;

                if(!is_dir('images')){
                    mkdir('images');
                }
                if($image){
                    $imagePath= 'images/'. $image['name'];
                    move_uploaded_file($image['tmp_name'], $imagePath);     
                    ?><img src="<?php echo'images/'.$image['name'] ?> " width=300px alt="Your Image"> <?php
                  } 
        }else{echo "Please Fill Tabs in Latin Letters Only (A-Z)"; }
    }
    }
?>
</html>  