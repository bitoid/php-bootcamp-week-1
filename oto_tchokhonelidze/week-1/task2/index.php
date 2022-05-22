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

include 'functions.php';

if (isset($_GET['name']) && $_GET['name'] !== "" && isset($_GET['data'])) {
    show_data($_GET);
}

?>

</body>
</html>