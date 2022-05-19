<!DOCTYPE html>
<html>
<head>
    <title>My name valid</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
<body>
    <div class="container-fluid">
        <h1>Registration form</h1>
    </div>

    <div class="container">

        <form action="/index.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="fname" placeholder="First Name" required>  <br>
            <input type="text" name="lname" placeholder="Last Name" required><br><br>
            <input type="file" name="uploadfile"><br> 
            <input id="submit" type="submit" name="submit" value="save">
        </form>
    </div>



    <?php
        


        $alpha = "/^[a-zA-z]+$/";  
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $error = "Incorrect name";
        $success = $fname . ' ' . $lname;

        

        if(isset($_POST['submit'])) {
            if(preg_match($alpha, $fname) && preg_match($alpha, $lname)) {
                $new_dir = "uploads/";
                $new_file = $new_dir.basename($_FILES["uploadfile"]["name"]);
                $imageFileType = pathinfo($new_file,PATHINFO_EXTENSION);
                move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $new_file);
            
                echo '<img src="'.$new_file.'" />';
                echo "<br>";
                    echo  "I'm "  . $success. " from BitCamp";
                }else{
                    echo $error;
                }
        }

        
        
        
    ?>

    

    
</body>
</html>
