<?php
    require_once "./helpers.php";

    $username = isset($_POST['username'])
        ? $_POST['username']
        : @$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>დავალება #2</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <main class="container">
        <form action="." method="POST" class="form">
            <input type="text" name="username" placeholder="username" required value="<?= $username; ?>" />
            <select name="type" id="type">
                <option value="followers">followers</option>
                <option value="repos">repos</option>
            </select>
            <input type="submit" value="fetch" name="fetch" />
        </form>

        <?php draw_html(); ?>
        <?php draw_pagination(); ?>
    </main>
</body>
</html>
