<?php

$pdo = require 'database.php';

$statement = $pdo->prepare("SELECT * FROM users");
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form>

    <div class="d-flex justify-content-between col-6">
        <h4 class="p-2 bd-highlight">Users List</h4>
        <a class="p-2 btn btn-success mb-2 mt-2" href="create.php">Add New</a>
    </div>

    <div class="form-group col-6">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Profile Picture</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($users as $i => $user) : ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><img src="<?= $user['image'] ?>" alt="img" style="width: 90px"></td>
                    <td><?= $user['first_name'] ?></td>
                    <td><?= $user['last_name'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-primary">Edit</a>
                        <form method="post" action="delete.php" style="display: inline-block">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            endforeach; ?>
            </tbody>
        </table>

    </div>
</form>
</body>
</html>