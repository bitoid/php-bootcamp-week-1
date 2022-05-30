<?php
//==============global variables=======
$firstname = '';
$lastname = '';
$image_url = '';
$firstname_value = '';
$lastname_value = '';
$error_mesage = ['', '',''];
?>

<?php
//============== make directory for image=======
if (!is_dir('upload')) {
    mkdir('upload');
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if(trim($_POST['firstname'])=='' || trim($_POST['lastname'])=='' ){
        $error_mesage[2] = '* firstname and lastname is required';
        $firstname_value =trim($_POST['firstname']);
        $lastname_value = trim($_POST['lastname']);       
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['firstname']) || !preg_match("/^[a-zA-Z-' ]*$/", $_POST['lastname'])) {
        $error_mesage[0] = 'Enter only letters';
        $firstname_value =trim($_POST['firstname']);
        $lastname_value = trim($_POST['lastname']);  
    }
    if ($_FILES['file']['size'] == 0) {
        $error_mesage[1] = 'choose photo please';
        $firstname_value =trim($_POST['firstname']);
        $lastname_value = trim($_POST['lastname']);  
    }
    if ($error_mesage[0] === '' && $error_mesage[1] === ''&& $error_mesage[2]=='') {
        move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $_FILES['file']['name']);
        $image_url = './upload/' . $_FILES['file']['name'];
        $firstname=trim($_POST['firstname']);
        $lastname= trim($_POST['lastname']);  
        $firstname_value = '';
        $lastname_value = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>project_1_new</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <fieldset>
                <form action="" method="post" enctype="multipart/form-data">
                <label for="firstname">firstname</label>
                <input type="text" name="firstname" value="<?php echo $firstname_value ?>"><br>
                <label for="lastname">lastname</label>
                <input type="text" name="lastname" value="<?php echo $lastname_value ?>">
                <p class="error-text">* <?php echo $error_mesage[0].'<br> '.$error_mesage[2] ?> </p>
                <label for="image">image</label>
                <input type="file" name="file" value="<?php ?>"><br>
                <p class="error-text"> *<?php echo $error_mesage[1] ?> </p>
                <input type="submit" value="submit">
            </form>       
    </fieldset>
    <div class="output">
        <p>Hello:  <?php echo $firstname . ' ' . $lastname  ?></p>
        <img style='width:200px' src="<?php echo $image_url ?>" alt="photo">
    </div>
</body>

</html>