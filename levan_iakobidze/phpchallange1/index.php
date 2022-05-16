<?php require_once "validation.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Form</title>
</head>

<body>

    <main>
        <div class="form-wrapper">

            <form action="index.php" method='POST' enctype="multipart/form-data">
                <div class="validation">

                    <h3 class='error'>
                        <?php echo $fillValidator; ?>
                    </h3>

                    <h3 class='error'>

                        <?php echo $caseValidator; ?>


                    </h3>

                    <h3 class="error">
                        <?php echo $numberError; ?>
                    </h3>

                    <h3 class='sucsess'>
                        <?php echo $success; ?>
                    </h3>

                </div>
                <div class="firstName-lastName-cont">
                    <input type="text" name='firstname' placeholder="First Name">
                    <input type="text" name='lastname' placeholder="Last Name">
                </div>

                <div class="photoInput-photo-cont">

                    <div class="photo-input-cont">

                    </div>
                    <input type="file" name="image">


                </div>
                <input class='submit-btn' type="submit" name='submit' placeholder='submit'>


            </form>

        </div>

        <div class="output">

            <div class="card-img">

                <?php if($isValid) : ?>
                <img class='profile-img' src="./uploads/<?php if($isValid){ echo $image;} ?>" alt="image">

                <?php endif; ?>
            </div>


            <div class="card-text">

                <h1><?php if ($isValid) {
                  echo $name;
                } ?>
                </h1>

                <h1><?php if ($isValid) {
                  echo $surname;
                } ?>
                </h1>
            </div>


        </div>


    </main>

</body>

</html>