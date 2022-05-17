<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2</title>
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
</head>
<body>
    
<form action="index.php" method="get">
    <label for="name">User: </label>
    <input type="text" name="name" required />
    <select name="data">
        <option value="repositories">Repositories</option>
        <option value="followers">Followers</option>
        <option value="both">Both</option>
    </select>
    <input type="submit" />
</form>

<?php

$list_number = 1;

include 'functions.php';

if (isset($_GET['name']) && $_GET['name'] !== "" && isset($_GET['data'])) {

    $user = $_GET['name'];
    if($_GET['data'] == 'repositories'){
        $array = getData($user, 'repos');
        foreach ($array as $key => $value) {
            ?>
            <div class="repos">
                <p><?php echo $key + 1 ?></p>
                <p><a href="<?php echo $value['html_url'] ?>" target="_blank"><?php echo $value['name'] ?></a></p>
                <p><?php echo $value['description'] ?></p>
            </div>
            <?php
        }
        
    }
    if($_GET['data'] == 'followers'){
        $array = getData($user, 'followers');
        foreach ($array as $key => $value) {
            ?>
            <div class="followers">
                <p><?php echo $key + 1 ?></p>
                <a href="<?php echo $value['html_url'] ?>" target="_blank">
                    <img src="<?php echo $value['avatar_url'] ?>" alt="<?php echo $value['login'] ?>">
                    <p><?php echo $value['login'] ?></p>
                </a>
            </div>
            <?php
        }
    }

    if($_GET['data'] == 'both'){
        $repos = getData($user, 'repos');
        $followers = getData($user, 'followers');
        ?>
        <div class="container">
            <div class="first">
                <h1>Repos</h1>
                <?php
                    foreach ($repos as $key => $value) {
                        ?>
                        <div class="repos">
                            <p><?php echo $key + 1 ?></p>
                            <p><a href="<?php echo $value['html_url'] ?>" target="_blank"><?php echo $value['name'] ?></a></p>
                            <p><?php echo $value['description'] ?></p>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <div class="second">
                <h1>Followers</h1>
                <?php
                    foreach ($followers as $key => $value) {
                        ?>
                        <div class="followers">
                            <p><?php echo $key + 1 ?></p>
                            <a href="<?php echo $value['html_url'] ?>" target="_blank">
                                <img src="<?php echo $value['avatar_url'] ?>" alt="<?php echo $value['login'] ?>">
                                <p><?php echo $value['login'] ?></p>
                            </a>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        <?php
    }
}

?>

</body>
</html>