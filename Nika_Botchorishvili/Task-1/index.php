<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Task 1</title>
</head>
<body>
<?php

$name = "";
$lastName = "";
$fileDest = "";
$error = "";
if(isset($_POST) && !empty($_POST)){
    if(ctype_alpha($_POST['name']) && ctype_alpha($_POST['lastName'])){
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        if(!empty($name) && !empty($lastName)){
            $fileName = $_FILES['pfp']['name'];
            $fileTempName = $_FILES['pfp']['tmp_name'];
            $fileType = $_FILES['pfp']['type'];
            $fileSize = $_FILES['pfp']["size"];
            $fileError = $_FILES['pfp']['error'];

            $fileNameExp = explode(".", $fileName);
            $fileExt = end($fileNameExp);

            $allowedTypes = ["jpg",  "png", "jpeg"];
            if(in_array($fileExt, $allowedTypes)){
                if($fileError === 0){
                    $modifiedFileName = uniqid("", true) . "." . $fileExt;
                    $fileDest = "uploads/" . $modifiedFileName;
                    move_uploaded_file($fileTempName, $fileDest);
                }
            }else{
                $error = "File should either be jpg, png or jpeg!";
            }
        }else{
            $error = "Fill in the inputs!";
        }
    }else{
        $error = "Use characters only!";
    }
}

?>
    <div class="container">
        <h1 id="header">Task 1</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div id="form-cont">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Name">
                </div>

                <div class="input-group">
                    <input type="text" name="lastName" placeholder="Lastname">
                </div>
                <div class="input-group">
                    <input type="file" name="pfp">
                </div>
                
                <div class="input-group">
                   <button>SUBMIT</button>

                </div>
                
            </div>
        </form>

        <?php if(isset($_POST) && !empty($_POST) && empty($error)): ?> 
            <div class="res-cont">
                <h1>Name: <?= $name ?></h1>
                <h1>Last Name: <?= $lastName ?></h1>
                <img src="<?= $fileDest ?>" alt="">
            </div>
        <?php endif; ?>
        <p><?= $error ?></p>
        </div>
    </div>
</body>
</html>