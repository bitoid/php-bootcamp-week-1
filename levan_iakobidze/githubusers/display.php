<?php

require_once 'logic.php'


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>


        <?php foreach($decoded as $repo): ?>

        <?php if($_GET['choose'] === 'repos') : ?>
        <div class="repos">
            <a href=<?= $repo['html_url'] ?>><?php echo $repo['name']   ?></a>
        </div>
        <?php endif ?>
        <?php endforeach; ?>


    </div>

    <div class='followers-main-cont'>

        <?php foreach($decoded as $repo): ?>
        <?php if($_GET['choose'] === 'followers') : ?>
        <a href=<?= $repo['html_url'] ?> class="follower-card">
            <img src=<?= $repo['avatar_url'] ?> alt="">
            <h4><?php echo $repo['login']   ?></h4>
        </a>
        <?php endif ?>

        <?php endforeach; ?>

    </div>
    <div class="error-cont">
        <h1 class='error'><?php echo $error;  ?></h1>
    </div>
</body>

</html>