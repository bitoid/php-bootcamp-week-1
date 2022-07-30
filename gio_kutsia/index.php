<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="container">

    <?php include "validation.php" ?>
    <?php if(empty($_POST) || !empty($nameErr) || !empty($lastnameErr) ||!empty($errorFile)): ?>


    <div class="main-div ">
        <form action="" method="post" enctype="multipart/form-data">
            <div class=" ">

                <input class="form-control mb-5" name="name" type="text" placeholder="firstname"
                    value="<?= $name;?>"></input>
                <span style="color:red"><?= $nameErr ?></span>
                <input class="form-control mb-5" name="lastname" type="text" placeholder="lastname"
                    value="<?= $lastname;?>"></input>
                <span style="color:red"><?= $lastnameErr ?></span>
                <input class=" form-control mb-5" name="added_photo" type="file">
                <span style="color:red"><?= $errorFile ?></span>
                <input class="form-control mb-3" type="submit" name="submit_form" value="submit">
            </div>
        </form>
    </div>
    <?php else: ?>


    <div class="card-div card mb-3 mt-5">
        <img src="<?php print "uploads/" . $porfile_image; ?>" class="card-img-top" alt="Profile photo">
        <div class="card-body ">
            <h3 class="card-text">Info</h3>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"> <small class="text-muted">First Name:</small><?= $name ?></li>
            <li class="list-group-item"><small class="text-muted">Last Name: </small><?= $lastname ?></li>
            <li class="list-group-item"><small class="text-muted">Uploaded date: </small><?= print date('d/Y/M')?></li>
        </ul>
    </div>
    <?php endif; ?>


</body>

</html>