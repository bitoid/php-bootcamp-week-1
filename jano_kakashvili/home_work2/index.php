<?php include "./repos.php"; ?>
<?php require "./templates/header.html" ?>

<form class="main_form" action="index.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="username" />
    <input type="submit" value="Search" />
</form>

<table style="visibility: <?= $show ?>;">
    <thead>
        <tr>
            <th>
                <h3 style="display: inline-block;">Repositories</h2>
                <a href="./followers.php">/Followers</a>
            </th>
        </tr>
        <tr>
            <th>Index</th>
            <th>Repository Names</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($data as $repository) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($repository['name']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require "./templates/footer.html" ?>