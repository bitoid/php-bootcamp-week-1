<?php 
    if (isset($_POST["submit"])) {


            if (isset($_POST['firstName']) || isset($_FILES['image']) ) {


                $errorMsg = "WARNING!".'<br>'."YOUR NAME SHOULD CONTAIN ONLY LETTERS AND SHOULD'T BE EMPY!".'<br>'."OR, YOU DON'T HAVE A PROFILE IMAGE";

                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $imageName = $_FILES['image']['name'];
                $imageType = $_FILES['image']['type'];
                $imageTmpName = $_FILES['image']['tmp_name'];

                move_uploaded_file($imageTmpName, "media/$imageName");

        }       
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Task#1</title>
</head>
<body>
    <div class="task1">
        <h2>TASK #1</h2>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <div>
                    <label class='names' for="firstName">First name :</label>
                    <input type="text" name="firstName" id="firstName">
                </div>
                <div>
                    <label class='names' for="lastName">Last name :</label>
                    <input type="text" name="lastName" id="lastName">
                </div>
                <input type="file" name="image" id="image">
                <input type="submit" name="submit" value="submit" class="submit">
            </form>
            <div class="error-msg">
                        <?php  
                        if (isset($_POST['firstName']) || isset($_FILES['image'])){
                            if(!preg_match('/^[a-zA-Z]+[ ]?[a-zA-Z]+$/', $firstName) || empty($firstName)  || !$imageName || !preg_match('/^[a-zA-Z]+[ ]?[a-zA-Z]+$/', $lastName) || empty($lastName)){
                                echo $errorMsg;
                            }
                        }
                         ?> 
                    </div>
            <div class="container">
                    <div class="name">
                        <span class="label">First Name : </span>
                        <span> 
                        <?php
                            if (isset($_POST['firstName']) || isset($_FILES['image'])){
                                if(preg_match('/^[a-zA-Z]+[ ]?[a-zA-Z]+$/', $firstName) && !empty($firstName)  && $imageName && preg_match('/^[a-zA-Z]+[ ]?[a-zA-Z]+$/', $lastName) && !empty($lastName)) {
                                    echo $firstName;
                               }
                            }
                        ?> 
                        </span>
                    </div>
                    <div class="name">
                        <span class="label">Last Name : </span>
                        <span>
                        <?php 
                            if (isset($_POST['firstName']) || isset($_FILES['image'])){
                                if(preg_match('/^[a-zA-Z]+[ ]?[a-zA-Z]+$/', $firstName) && !empty($firstName)  && $imageName && preg_match('/^[a-zA-Z]+[ ]?[a-zA-Z]+$/', $lastName) && !empty($lastName)) {
                                    echo $lastName;
                            }
                            }
                        ?> 
                        </span>
                    </div>
                    <span class="label">Image :</span>
                    <div class="picture">
                        <img src="<?php 
                            if (isset($_POST['firstName']) || isset($_FILES['image'])){
                                if(preg_match('/^[a-zA-Z]+[ ]?[a-zA-Z]+$/', $firstName) && !empty($firstName)  && $imageName && preg_match('/^[a-zA-Z]+[ ]?[a-zA-Z]+$/', $lastName) && !empty($lastName)){
                                    echo  'media/'.$imageName;
                            }
                            }?>"
                        >
                    </div>
            </div>
        </div>
        
    

</body>
</html>