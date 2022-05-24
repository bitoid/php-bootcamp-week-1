<?php
require_once 'logic.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Github Users</title>
</head>

<body>
    <form action="display.php">
        <input type="text" name='search'>
        <select id="cars" name='choose'>
            <option value="repos">repos</option>
            <option value="followers">followers</option>
        </select>
        <button type='submit' name='submit'> Search</button>
    </form>
</body>

</html>