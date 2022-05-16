<?php 

    $error = '';
    $result_name = '';
    $result_lastname = '';

    $none = 'none';
    $block = 'block';
    $result_display = $none;


    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];

        $image_name = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];

        move_uploaded_file($image_tmp_name, "photos/$image_name");
        $imagePath = "<img src='photos/$image_name' class='image'>";

        if(empty($name) || empty($lastname) || $image_size == 0){
            $error = "<div class='error'>Enter Information Correctly</div>";
        } else if(ctype_upper($name) && ctype_upper($lastname)){
            $result_name = $name;
            $result_lastname = $lastname;
            $result_display = $block;
        } else {
            $error = "<div class='error'>Name and Lastname must be uppercase A-Z letters</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>Challenge_1</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <?php echo $error; ?>
            <div class="container__inputs">
                <input type="text" placeholder="name" name="name" class="input">
                <input type="text" placeholder="lastname" name="lastname" class="input">
                <input type="file" name="image" class="input">
                <button type="submit" name="submit" class="input btn">Submit</button>
            </div>
        </form>
        <div style="display: <?php echo $result_display; ?>">
        <div class="wrap">
            <p class="info"> Name:
                <?php echo $result_name; ?>
            </p>
            <p class="info"> Lastname:
                <?php echo $result_lastname; ?>
            </p>
            <?php echo $imagePath ?>
        </div>
        </div>
    </div>
</body>
</html>