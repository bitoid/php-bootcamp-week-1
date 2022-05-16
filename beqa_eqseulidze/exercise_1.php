<?php

$erorrName = ''; // variable of error mesages;==================
$erorrSurname = '';// variable of error mesages;==================

$nameValue = '';  //variable of inputs value;==================
$surnameValue = '';//variable of inputs value;==================

$uploadText=''; //variable  about photo  (opload or not opload )
$congratulation='';
$hello='';
$img_path='';

//If there is no  folder name "upload" do it
if (!is_dir('upload')){
    mkdir('upload');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    //echo $name;
    $surname = $_POST['surname'];
    //echo $surname;
    $uploadText = '';    
    
    // ============function for trim, strips and change '<' and '>' siymbols; ============

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if (empty($name)) {
        $erorrName = 'please enter Name';
        
    } else {
        $name = test_input($name);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $erorrName = "Only letters allowed";
    }
    $nameValue = $name;
     $name = '';
}

    if (empty($surname)) {
    $erorrSurname = 'please enter Name';
        } else {
            $surname = test_input($surname);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $surname)) {
                $erorrSurname = "Only letters allowed";
            }
            $surnameValue = $surname;
            $surname = '';
        }


        $tmp_name = $_FILES['file']['tmp_name'];
        $image_name=$_FILES['file']['name'];
        $file_location = 'upload/';
       
        if($erorrSurname == '' && $erorrName == ''){
        if (isset($_FILES)) {
            $upload = move_uploaded_file($tmp_name, $file_location.$image_name);

            if ($upload != false) {
                // $uploadText = "your foto is uploaded";
                $uploadColor = 'green';
            } else {
                $uploadText = 'choose photo';
                $uploadColor = 'red';
            }
        }
    }
        $congratulation = '';
        $hello='';

         // if everything is ok execute folowing code:==================>>
        if ($erorrSurname == '' && $erorrName == '' && $uploadColor == 'green') {
            $img_path =$file_location.$image_name ;
            $surname = $surnameValue;
            $name = $nameValue;
            $surnameValue = '';
            $nameValue = '';
            $congratulation = 'Your attempt was successful';
            $hello="hello :" . $name . " " . $surname;   
        }
 };
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <fieldset>
        <legend>REQUARED FORM</legend>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="container">
                <label for="name"> Name :</label>
                <input type="text" name="name" placeholder="name" value="<?php  echo $nameValue ?>">
                <span>* <?php echo $erorrName ?> </span> <br>
            </div>
            <div class="container">
                <label for="surname">Surname : </label>
                <input type="text" name="surname" placeholder="surname" value="<?php echo $surnameValue ?>">
                <span>* <?php echo $erorrSurname ?> </span> <br>
            </div>
            <div class="container">
                <label for="file"> Photo: </label>
                <input type="file" name="file">
                <span>** <?php echo $uploadText; ?> </span>
            </div>
            <div class="container">
                <input type="submit" name="upload" value="upload">
                <span class="congratulation" style="color:green"> <?php echo $congratulation ?></span>
            </div>
        </form>

        <div class='hello'> <?php echo $hello ?> </div>
        <br>
        <img src="<?php echo  $img_path ?>" alt="photo">

    </fieldset>

   
</body>

</html>