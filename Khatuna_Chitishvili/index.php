<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َAnimated Login Form</title>
    <link rel="stylesheet" href="style.css"> 
  </head>
<body>

<form class="box" action="/index.php" method="POST" enctype="multipart/form-data">

<!--for name -->
<div>
    <input type="text" name="first_name" placeholder="first name" value="">
</div>

 <!--for last mane-->  
<div>
    <input type="text"  name="last_name" placeholder="last name" value="">
</div>
   
<!--for image-->
<div>
    <input type="file" name="file"><br>


<!--submit button-->

<input type="submit" name="submit" value="UPLOAD">

</form> 

</body>
</html>

<?php
//Upload profile picture.
    if(isset($_FILES["file"])){
    $file_name= $_FILES["file"]["name"];
    $file_tmp= $_FILES["file"]["tmp_name"];
    $file_moved="upload/";
    $upload_file= move_uploaded_file($file_tmp,$file_moved.$file_name);
    }


//show uploaded picture on the same page.
    if($_POST["first_name"] &&  $_POST["last_name"] && $upload_file){
        print $_POST["first_name"]. " " . $_POST["last_name"]."<br><br>"; 
        echo "<img src ='upload/$file_name'><br><br>";
           
    }  



    if(isset($_POST["submit"]) ){
        $name= $_POST["first_name"];   
        $last_name =$_POST["last_name"];
     
        if(empty($name)){   
            echo "<h4>Please Enter Your Name</h4>";
        }else if(!ctype_alpha($name)){  //Validate if First Name only alphabet characters 
            echo "<h4>Use Only Alphabet Caracters </h4>";
        }else if(empty($last_name)){
            echo "<h4>Please Enter Your  Last Name </h4>";
        }else if(!ctype_alpha($last_name)){ //Validate if Last Name only alphabet characters 
                echo "<h4>Use Only Alphabet Caracters <h/4>";
        }else if(empty($upload_file)){
            echo "<h4>Plase Upload Profile Picture.</h4>";
        }
    }
?>



