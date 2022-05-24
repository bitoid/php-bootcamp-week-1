<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    form {
        background-color: #03253c;
        margin-left: 30%;
        margin-right: 30%;
        margin-top: 2%;
        width: 40%;
        border: 2px solid #03253c;
        border-radius: 4px;
    }

    .ele{
        border-collapse: collapse;
        margin: 20px 0;
        padding-top: 10px;
        font-size: 0.9em;
        min-width: 400px;
        border-radius: 5px 0px 5px 0px ;
        border-top: 2px solid #03253c;
        overflow: hidden;
        box-shadow: 0 0 20px gray;
        background-color: #FBFBF9;
    }

    .ele label{
        font-size: 28px;
        line-height: 25px;
        color: #03253c;
        display: inline-block;
        width: 20%; 
    }

    .ele input{
        line-height: 20px;
        text-align: center;
        margin-bottom: 10px;
        position: absolute;
        text-align: center;
        margin-left: 6%;
    }

    .foto{
        border: 2px solid black;
        background-color: #FBFBF9;
        margin-left: 29%;
    }

    .gilaki{
        width: 80px;
        height: 40px;
        margin-left: 43%;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .result{
        margin-top: 50px;
        margin-left: 30%;
        margin-right: 30%;
        font-size: 28px;
        background-color: #FBFBF9;
        width: 40%;
        background-color: white;
        border: 10px solid #03253c;
        text-align: center;
        border-radius: 9px;
    }
</style>
</head>
<body>
   
<form  action="week2_1.php" method="POST" enctype="multipart/form-data">   
    <div class="ele">
        <label> სახელი: </label>
        <input type="text" name="firstname"  class="form-control"> 
    </div>  
    <div class="ele">   
        <label> გვარი: </label>   
        <input type="text" name="lastname" class="form-control" > 
    </div>   
        <input type="file" name="image" class="foto">  <br>
        <input type="submit" name="submit" value="submit" class="gilaki"> 
</form>

<div class="result">
<?php 
$filename = 'uploads';
if (!file_exists($filename)) {
    mkdir ($filename);
}

if(isset($_POST["firstname"]) || isset($_POST["lastname"]) ) {
    if (preg_match("/[^A-Za-z'-]/",$_POST['firstname'] )) {
       die ("გთხოვთ შეიყვანეთ მხოლოდ ლათინური ანბანის ასოები");
    }
    echo  $_POST['firstname'] . " ";
    echo  $_POST['lastname'];    
} 

$dir = "$filename";
echo '<br>';
 
if(isset($_POST['submit'])) {
   $image_name = $_FILES['image']['name'];
   $image_type = $_FILES['image']['type'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $direct = "$dir/$image_name"; 
   
   move_uploaded_file($image_tmp_name, "$direct");
   echo "<img src= $direct width='200' height='200'>" ;
}
?> 
</div>
</body>
</html>