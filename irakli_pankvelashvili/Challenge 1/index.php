<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chellange1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <form action="index.php" method="POST" enctype='multipart/form-data'>
        <div class="mb-3">
            <label for="fn" class="form-label">Firstname</label>
            <input type="text" class="form-control" name="firstname" placeholder="Enter your firstname" required>
        </div>
        <div class="mb-3">
            <label for="ln" class="form-label">Lastname</label>
            <input type="text" class="form-control" name="lastname" placeholder="Enter your firstname" required>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Please Upload Profile Picture</label>
            <input type="file" class="form-control"name="image" aria-label="file example" required>
        </div>
        <div class="mb-3">
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
        </div>
    </form>
    <?php

       

        $alpha = "/^[A-Z]+$/";

        if(isset($_POST['submit'])){
            $image_name = $_FILES['image']['name'];
            $image_type = $_FILES['image']['type'];
            $image_size = $_FILES['image']['size'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $first=$_POST['firstname'];
            $last=$_POST['lastname'];


            if(preg_match ($alpha, $first) && (preg_match ($alpha, $last)) && move_uploaded_file($image_tmp_name,"./photos/$image_name") ){
                echo "<p>$first<br>$last<br> <img src='photos/$image_name' width='200' height='200'></p>";
            }else{
                echo "<h3><br>ERROR:Firstname And Lastname Should Contain Only Alphabet [A-Z] <h3>";
            }


         }

    ?>
    
</body>
</html>