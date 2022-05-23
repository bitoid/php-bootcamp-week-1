<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link rel="stylesheet" href="./davaleba1.css">
      
</head>
<body>
<?php
//ფორმის ველის ინფორმაციის ატვირთვა
//შემოწმება გამოტანა
$result=0;
$check="/^[a-zA-Z-' ]*$/";
$name=$surname='';
$nameerr=$surnameerr=$imgeror='';
$cda =true;
if(isset($_POST['submit']))
{
    if (!preg_match($check,$_POST['name'])) 
    {
        $nameerr = "*👎 Enter only Latin uppercase or lowercase letters";
    }
      if (!preg_match($check,$_POST['name1'])) 
    {
        $surnameerr = "*👎 Enter only Latin uppercase or lowercase letters";
    }
    if(empty($_POST['name']))
    {
        $nameerr='*👎 The name field is empty';
    }
    if(empty($_POST['name1']))
    {
        $surnameerr='*👎 The last name field is empty';
    }
    if (preg_match($check,$_POST['name']))
    {
        if(!empty($_POST['name'])){
            $nameerr='👍';
            $result+=1;
            
        }
    }
    if (preg_match($check,$_POST['name1']))
    {
        if(!empty($_POST['name1'])){
            $surnameerr='👍';
            $result+=1;
            $surname = $_POST['name1'];
        }
    }

    $name = $_POST['name'];
    $surname = $_POST['name1'];

}

 ?><br>
 <?php 
 //სურათის ატვირთვა გამოტანა
 if(isset($_POST['submit']))
 {
    $img_name=$_FILES['img-upload']['name'];
    $tmp_img_name=$_FILES['img-upload']['tmp_name'];
    $uploads="uploads/";
    move_uploaded_file($tmp_img_name,$uploads.$img_name);
     $imgg =  "<img class='img' src='$uploads./$img_name'/>";
     if($img_name!=null){
        $result+=1;
    }
    else{
        $imgeror= "Please upload a picture";
    }
 }
 
 ?>
<div class="result">
 <?php if($result<=2):?>
<form class="forma" action="davaleba1.php" method="post" enctype="multipart/form-data">
 <input type="text" name="name" placeholder="სახელი"><br>
 <input style="margin-top: 15px;" type="text" name="name1" placeholder="გვარი"> <br>
 <input type="file" name="img-upload"><br><br>
 <input style="background-color: green;" type="submit" name="submit" value="send">
</form>
     <div class="eror">
     <p ><?php echo $nameerr ?></p>
     <p ><?php echo $surnameerr ?></p>
     </div>
     <?php endif ?>
</div>  
 

 <?php if($result==3) :?>
  <?php  echo $imgg; ?>
 <p class="suname"><?php echo $name." ".$surname ?></p>
 <?php endif ?>
  <p style="color: red; margin-left: 40%;font-size: 24px;"><?php echo $imgeror ?></p>
 <style>
     
 </style>
</body>
</html>