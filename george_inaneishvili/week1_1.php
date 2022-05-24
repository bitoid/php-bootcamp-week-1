<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
html{
   height:100%;
}

body {
   background-color: #710193;
   
   margin-left: 30%;
   margin-right: 30%;
   width: 40%;
   height: 50%;
   
}

.box{
   background-color: white;
   height: 100%;
   text-align: center;
   
   
}

input {
   padding-top: 10px;
   padding-bottom: 10px;
   line-height: 5px;
   margin: 2%;
   height: 30px;
   width: 40%;
   
}


.result{
   height: 90%;
   background-color: white;
   border: 2px solid black;
   text-align:center;
   
}




</style>

</head>
<body>
   <div class="box">
<form  action="week1_1.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="firstname" placeholder="სახელი:"> <br>
        <input type="text" name="lastname" placeholder="გვარი:" > <br>
        <input type="file" name="image"> <br>
        <input type="submit" name="submit" value="submit">

</form>

</div>
<div class="result">
<?php 
$filename = 'uploads';
if (file_exists($filename)) {
    
} else {
    mkdir ($filename);
}

 if(isset($_POST["firstname"]) || isset($_POST["lastname"]) ) {
    if (preg_match("/[^A-Za-z'-]/",$_POST['firstname'] )) {
       die ("გთხოვთ შეიყვანეთ მხოლოდ ლათინური ანბანის ასოები");
    }
    echo  $_POST['firstname'] . " ";
    echo  $_POST['lastname'];    
  } 
  $dir = "upload";
  echo '<br>';
 

  if(isset($_POST['submit'])) {
   $image_name = $_FILES['image']['name'];
   $image_type = $_FILES['image']['type'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $direct = "$dir/$image_name"; 
   
   move_uploaded_file($image_tmp_name, "$direct");
   echo "<img src= $direct width='200' height='200'    >" ;
 
}
?> 
</div>
</body>
</html>