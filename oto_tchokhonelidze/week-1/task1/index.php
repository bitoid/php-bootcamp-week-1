<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 1</title>
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
</head>
<body>
    
<?php  
include "functions.php";

$show_form = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fnameErr = $lnameErr = $imageErr = "";  
    check_inputs($_POST, $_FILES);
}

if($show_form){
    ?>
    <form method="post" action="index.php" enctype="multipart/form-data">    
        <label for="fname">First Name: </label>  
        <input type="text" name="fname" value=<?php echo $_POST['fname'] ?>>  
        <span class=<?php echo ($fnameErr) ? 'error' : ''; ?>><?php echo $fnameErr; ?> </span>  
        <br>  
        <label for="lname">Last Name: </label>   
        <input type="text" name="lname" value=<?php echo $_POST['lname'] ?>>  
        <span class=<?php echo ($lnameErr) ? 'error' : ''; ?>><?php echo $lnameErr; ?> </span>  
        <br> 
        <input type="file" name="image">
        <br>                       
        <input type="submit" name="submit" value="Submit">   
        <br>                             
    </form> 
    <?php
}
 
    if(isset($_POST['submit'])) { 
        show_result($_POST, $_FILES['image']['name']);
    }  
?>  
  
</body>  
</html>