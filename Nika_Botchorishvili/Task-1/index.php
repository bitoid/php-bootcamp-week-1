<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Task 1</title>
</head>
<body>
    <div class="container">
        
        <h1 id="header">Task 1</h1>

        <?php if(empty($_POST)): ?>
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

        <?php else: ?>
            <?php 
            $name = isset($_POST['name']) && !empty($_POST['name'])? $_POST['name']: "";
            $lastName = isset($_POST['lastName']) && !empty($_POST['lastName'])? $_POST['lastName']: "";
            $error = "";
            $fileDestination = "";
            
            //Error Handling
            do{
                if(empty($name) && empty($lastName)){
                    $error = "Name and last name inputs are empty";
                    break;
                }
                 
                if(!empty($name) && empty($lastName)){
                    $error = "Last name input is empty";
                    break;
                }
    
                if(empty($name) && !empty($lastName)){
                    $error = "Name input is empty";

                    break;
                }
    
                if(!ctype_alpha($name) && !ctype_alpha($lastName)){
                    $error = "Name and last name should be written only in characters";
                    break;
                }
            
                if(isset($_FILES) && !empty($_FILES['pfp'])){
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
                            $fileDestination = "uploads/" . $modifiedFileName;
                            move_uploaded_file($fileTempName, $fileDestination);
                            unset($_FILES);
                        }
                    }else{
                        $error = "File should either be jpg, png or jpeg!";
                        break;
                    }
                }
                break;
            }while(empty($error));
            ?>

            <?php if(empty($error)): ?>

            <div class="res-cont">
                <h1>Name: <?= $name ?></h1>
                <h1>Last Name: <?= $lastName ?></h1>
                <img src="<?= $fileDestination ?>" alt="">
            </div>

            <?php else: ?>

                <p><?= $error ?></p>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</body>
</html>