<?php require_once './form_logics.php' ?>
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
<?php if($_POST == null) :?>
    <form action="./index.php" method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <input type="text" name="first_name" placeholder="Enter First Name..." value = "<?php echo $first_name ?>" class="form-control" id="formGroupExampleInput">
            <?php if ($errors['first_name_empty'] != null) : ?>
                <div class="alert alert-danger">
                    <div><?php echo $errors["first_name_empty"] ?></div>
                </div>
            <?php endif; ?>
            <?php if ($errors["first_name_validation"] != null): ?>
                <div class="alert alert-danger">
                    <div><?php echo $errors["first_name_validation"] ?></div>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <input type="text" name="last_name" placeholder="Enter Last Name..." value = "<?php echo $last_name ?>" class="form-control" id="formGroupExampleInput2">
            <?php if ($errors["last_name_empty"] !=null): ?>
                <div class="alert alert-danger">
                    <div><?php echo $errors["last_name_empty"] ?></div>
                </div>
            <?php endif; ?>
            <?php if ($errors["last_name_validation"]!= null): ?>
                <div class="alert alert-danger">
                    <div><?php echo $errors["last_name_validation"] ?></div>
                </div>
            <?php endif; ?>
        </div>
    
        <div class="form-group">
            <input type="file" name="profile_photo" class="form-control-file" id="exampleFormControlFile1">
            <?php if ($errors["image_empty"] != null): ?>
                <div class="alert alert-danger">
                    <div><?php echo $errors['image_empty'] ?></div>
                </div>
            <?php endif; ?>
        </div>
        <input type="submit" name="submit" class="btn btn-primary mb-2">
    </form>

<?php else : ?>
    <div class="card">
        <p><?php echo $first_name . ' '; ?> <?php echo $last_name ; ?></p>
        <img src="<?php echo $profile_photo_url; ?> " alt="profile photo">
    </div>
<?php endif; ?>
</body>
</html>