<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send form data</title>
</head>
<body>
    <?php if(isset($_POST['submit1'])) {
        $data = base64_encode(file_get_contents($_FILES['avatar']['tmp_name']));
        $altText = $_FILES['avatar']['name'];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
    ?>
    Welcome <?php echo $firstName . " " . $lastName; ?><br>
    <br>
    <img src="data:image/jpg;base64,<?php echo $data; ?>" alt="<?php echo $altText; ?>" />
    <br>
    <?php } else {echo "Please, fill the form data and send it!";}?>
    <br>
    <form action="./index.php" enctype="multipart/form-data" method="post">
        First name: <input type="text" name="firstName" value="<?php echo $firstName; ?>" pattern="[A-Za-z]*"><br>
        Last name: <input type="text" name="lastName" value="<?php echo $lastName; ?>" pattern="[A-Za-z]*"><br>
        Avatar: <input type="file" name="avatar" accept="image/jpeg"><br>
        <input type="submit" name="submit1" value="Send">
    </form>
</body>
</html>