
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="flex-row">
        <div class="container">
        <div class="form">
            <form class="login-form" action='index.php' method='post' enctype="multipart/form-data">
            <input type="text" name="fname" placeholder="First Name"/>
            <input type="text" name="lname" placeholder="Last Name"/>
            <label for="image">Upload Image</label>
            <input id='image' type='file' name='image'>
            <input id='submit' class="btn" type='submit' value='submit'>
            </form>
        </div>
        </div>
        <?php 
            if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_FILES["image"])){
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                if (preg_match("/^[A-Za-z]+$/", $fname) && preg_match("/^[A-Za-z]+$/", $lname)){
                move_uploaded_file($_FILES["image"]["tmp_name"], "image/image");
                        echo "
                        <div class='container'>
                            <div class='form'>
                                <img src='image/image'>
                                <p>Profile Picture</p>
                                <p>First Name: $fname</p>
                                <p>Last Name: $lname</p>
                                
                            </div>
                        </div>
                        ";
                }
                else{
                    echo "<div class='container'>
                            <div class='form'>
                                <p>First Name and Last Name must contain A-Z characters !!!</p>
                                <p>Please fill all Inputs to Submit Form !!!</p>
                            </div>
                        </div>";
                }
            }
        ?>
    </div>
</body>
</html>