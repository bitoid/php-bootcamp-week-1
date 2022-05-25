<?php require_once 'validation.php' ?>
<?php require_once 'image.php' ?>

<!DOCTYPE html>
<html>
    <head>
    <title>first task</title>
    <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php if(empty($_POST) || !empty($errors)): ?>
        <div>
            <h3>Enter your full name and upload picture</h3>
            <form action="/index.php" method="POST" enctype="multipart/form-data">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fist_name" placeholder="first name" value = <?php echo $name ?>>
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="last_name" placeholder="last name" value = <?php echo $surname ?>>
                <label for="picture">Choose Piture</label>
                <input type="file" id="picture" name="file">
                <input type="submit" value="Submit" name="submited">
            </form>
        </div>
        <div class="errors">
            <!--printing validation errors if exists -->
            <?php if (!empty($_POST) && !empty($errors)): ?>
                <?php foreach($errors as $error): ?>
                    <?php echo $error; ?>
                    <br>
                <?php endforeach ?>
            <?php endif ?>
        </div>
        <?php elseif(empty($errors)): ?> 
            
            <div><img src=<?php echo $img_source ?> /> </div>
            <br>
            <div class ="name"> <?php echo $_POST['fist_name'] . " " . $_POST['last_name'] ?> </div> 
            
        <?php endif ?>

    </body>
</html>