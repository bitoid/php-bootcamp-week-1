<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" href="/first-challenge/php-bootcamp-week-1/zura_iakobishvili/style.css">
        <title>
         PHP FORM VALIDATION  
        </title>
    </head>
    <body>
        <div class = "container">
            <h1>Bitoid Technologies</h1>
            <img class = "main-logo" src="img.jpg" alt="image" >

        
        
            <form action="form.php" method="POST" enctype = "multipart/form-data"> 
                <input class = "info"  type="text" name = "firstname" placeholder = "First Name"/>
                <input class = "info"  type="text" name = "lastname" placeholder = "Last Name"/>
                <input class = "info"  type="file" name = "image" placeholder = "Upload your image"/>
                <input class = "info"  type= "submit" name="submit" value="REGISTER"/>
            </form>
        </div>  


  

        
    <?php
        // $firstname = "";
        // $lastname = "";
       if($_SERVER['REQUEST_METHOD']=="POST"){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $image;
        $alpha = "/^[A-Z]+$/";

        // First name errors 

        if(empty($firstname)){
            echo   "Please enter your First name ";
        } elseif (strlen($firstname) < 6 ) { // strlen --> ასოების რაოდენობა სთრინგში 
            echo "Your First name needs to have minimum 6 letters  ";
        } elseif(preg_match ($alpha, $firstname)){
            echo "<br><br>$firstname";
        } else{
            echo "<br>Firstname should contain only alphabet characters (A to Z) ";
        }

        // Last name errors 

        if(empty($lastname)){
            echo   "Please enter your Last name   ";
        }elseif (strlen($lastname) < 6 ) { // strlen --> ასოების რაოდენობა სთრინგში 
            echo "Your Last name needs to have minimum 6 letters  ";
        } elseif(preg_match ($alpha, $lastname)){
            echo "<br><br>$lastname";
        } else{
            echo "<br>Last name should contain only alphabet characters (A to Z) ";
        }
        


        if($firstname && $lastname ) {
            print "FULL NAME: " .$firstname . " " . $lastname;
        } 

    
   

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $img_name = $_FILES['image']['name'];
        $tmp_img_name = $_FILES['image']['tmp_name'];
        $destination = "uploads/". $img_name;
        move_uploaded_file($tmp_img_name, $destination);
    }
    if(empty($image)){
        echo "Upload your image";
    }
}
    
?> 
     <img src="<?php echo $destination ?>">   
    
    </body>
</html>