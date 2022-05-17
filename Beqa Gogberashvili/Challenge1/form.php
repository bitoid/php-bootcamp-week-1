<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Form Result</title>
</head>


<body>

    <div class="main">
        <div class="form">
            <h1>Who are you?</h1>
            <form method="post" enctype="multipart/form-data">
                <ul class="form-items">
                    <li><input type="text" name="firstName" placeholder="First Name"></li>
                    <?php if (isset($_SESSION['firstname_error']) && $_SESSION['firstname_error'] != '') {
                        echo $_SESSION['firstname_error'];
                    } ?>
                    <li><input type="text" name="lastName" placeholder="Last Name"></li>
                    <?php if (isset($_SESSION['lastname_error']) && $_SESSION['lastname_error'] != '') {
                        echo $_SESSION['lastname_error'];
                    } ?>
                    <li><label class="custom-file-upload">
                            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/png, image/gif, image/jpeg">
                            <img src="./upload.png" width="20px" style="object-fit: cover; vertical-align:middle">
                            Upload Image
                        </label></li>
                    <?php if (isset($_SESSION['image_error'])) {
                        echo $_SESSION['image_error'];
                    } ?>
                    <li><input type="submit" name="submit" class="butt" value="Submit"></li>
                </ul>
            </form>
        </div>
    </div>

</body>

</html>