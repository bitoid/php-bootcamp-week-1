<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Bitoid Technologies : W 1 - Chall 1</title>
</head>
<body>

    <?php 
    $firstName = '';
    $lastName = '';
    $imgPath = '';
    
    if($_POST == null){
        include './form.php';
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $firstName = $_POST['FirstName'];
        $lastName = $_POST['LastName'];
        $img = $_FILES['image'];
        $image = $img['name'];
        if($image){
            include './files.php';
            move_uploaded_file($img['tmp_name'],'images/'.$image);
            $imgPath = "./images/"."$image";
        }
        if(!preg_match('/[^A-Za-z]/',$firstName) && !preg_match('/[^A-Za-z]/',$lastName)){
            echo '<div class="fullname">';
            echo '<p>' . "$firstName" . ' ' . "$lastName" . '</p>';
            echo '<img src="' . "$imgPath" . '"' . ' alt="image not found">';
            echo '</div>';
        }else {
            if(preg_match('/[^A-Za-z]/',$firstName)){
                $firstName='';
                echo '<p class="first">Your first name must contains only alphabet characters!!!</p>';
            }
            if(preg_match('/[^A-Za-z]/',$lastName)){
                $lastName='';
                echo '<p class="last">Your last name must contains only alphabet characters!!!</p>';
            }
            include_once './form.php';
        }
    }
    ?>
</body>
</html>