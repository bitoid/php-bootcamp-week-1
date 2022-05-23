<?php
if ($_GET) {
    require_once "validation.php";
    $user = $_GET['user'];
    $require = $_GET['require'];

    if ($user) {
        $errors = checkUser($user);
    }
    
} 

?>

<?php if (!$_GET || $_GET && (!$user || !$require) || $errors): ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/style/main.css" rel="stylesheet">
        <title>Bittoid Challenge 2</title>
    </head>
    <body class="front">
            <a href="index.php"><h1 class="logo">HOME</h1></a>
        <div class="container">
            <form action="" method="get">
                <input type="text" name="user" placeholder="username" >
                <label> Select: 
                    <select name="require" required>
                        <option value="followers">followers</option>
                        <option value="repositories">repositories</option>
                    </select>
                </label>
                <input type="submit" name="submit">
                <?php if ($_GET && (!$user || !$require)): ?>
                    <div class="validation">Fill out all fields</div>
                <?php elseif($errors): ?>
                    <div class="validation"><?= $errors ?></div>
                <?php endif?>
            </form>
        </div>  
    </body>
    <?php else: ?>
        <?php include_once "response.php"; ?>
    <?php endif ?>
</html>

