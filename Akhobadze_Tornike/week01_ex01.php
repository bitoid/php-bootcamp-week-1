<!doctype HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
<!-- Down is Php tags -->
    <?php
        $image = $_FILES['image']['name'];
        $imagePath = '';

        mkdir('images');
            
        $imagePath = 'images/'.$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    
    ?>
<!-- Down is HTML tags -->
    <form action = "/week01_ex01.php" method = "POST" enctype = "multipart/form-data">
        <input type = "text" name = "Fname" placeholder = "First Name" require />
        <br>
        <input type = "text" name = "Lname" placeholder = "Last Name" require />
        <br>
        <input type = "file" name = "image" />
        <br>  
        <input type = "submit" name = "submit" />
        <!-- Down is Php tags -->
        <?php 
        if(isset($_POST['submit'])){
            print "<br>Full name: " . $_POST['Fname'] . " " . $_POST['Lname'] . "<br>";
            print "Your Profile Picture <br>"; 
            echo '<img src="./' . $imagePath . '" alt="' . $imagePath . '" style: width="200px" height="150px">';
        }
        ?>
    </form>

</html>