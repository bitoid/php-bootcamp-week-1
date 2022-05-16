<?php
    $validation_errors = null;
    $user_info = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once 'validate_form.php';
        $validation_errors = set_validation_error($_POST);
        
        if (empty($validation_errors)) {
            require_once 'upload.php';
            $user_info = $_POST;
            $img_path = upload_image($_FILES['profilePicture']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitoid Week #1</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='style.css'>
</head>
<body>
    <div class="wrapper">
        <div class="form">
            <form action="" method="POST" enctype="multipart/form-data" class="form__body">
                <h1 class="form__title">PLEASE FILL THE FORM</h1>
                <div class="form__item">
                    <label for="formFirstName" class="form__label">First Name</label>
                    <input id="formFirstName" type="text" name="firstName" class="form__input">
                    <?php if(isset($validation_errors['firstName'])): ?>
                        <span class="form__error">
                            <?php print $validation_errors['firstName'] ?>    
                        </span>
                    <?php endif ?> 
                </div>
                <div class="form__item">
                    <label for="formLastName" class="form__label">Last Name</label>
                    <input id="formLastName" type="text" name="lastName" class="form__input">
                    <?php if(isset($validation_errors['lastName'])): ?>
                        <span class="form__error">
                            <?php print $validation_errors['lastName'] ?>    
                        </span>
                    <?php endif ?>
                </div>
                <div class="form__item">
                    <div class="file__wrapper">
                        <input type="file" name="profilePicture" id="input__file" class="file__input">
                        <label for="input__file" class="file__input-button">
                            Upload Profile Picture
                        </label>
                        <?php if(isset($validation_errors['profilePicture'])): ?>
                            <span class="form__error">
                                <?php print $validation_errors['profilePicture'] ?>    
                            </span>
                        <?php endif ?>
                    </div>
                </div>
                <button type="submit" class="form__button">Submit</button>
            </form>
        </div>
        <?php if(!empty($user_info)):?>
        <div class="profile">
            <div class="profile__item">
                <h2><?php print $user_info['firstName']?></h2>
                <h3><?php print $user_info['lastName']?></h3>
            </div>
            <div class="profile__item">
                <img src=<?php print $img_path ?>
                    alt="prfoile-picture"
                    class="profile__image"
                >
            </div>
        </div>
        <?php endif ?>
    </div>
    <footer>
        Bitoid Week #1 Challenge #1 12.05.2022
    </footer>

    <script>
        const input_label = document.querySelector('.file__input-button');
        document.querySelector('#input__file').addEventListener('change', (e) => {
            let value = e.target.value;
            if (value.length == 0 ) {
                input_label.innerHTML = "Upload Profile Picture";
            } else {
                let fileName = value.slice(value.lastIndexOf('\\')+1, value.length);
                if (fileName.length > 12) {
                fileName = `... ${fileName.slice(-11)}`
                }
                input_label.innerHTML = fileName;
            }
        });
    </script>

</body>
</html>