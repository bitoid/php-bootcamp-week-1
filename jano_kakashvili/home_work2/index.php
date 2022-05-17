<?php require "./show_repositories.php"; ?>
<?php require "./templates/header.html" ?>

<form class="main_form" action="index.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="username" />
    <input type="submit" value="Search" />
</form>

<?php if (count($data) != 0) : ?>
    <table>
        <thead>
            <tr>
                <th>
                    <h3 style="display: inline-block;">Repositories</h3>
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
<?php else : ?>
    <h1>There was no followers to display</h1>
<?php endif; ?>

<?php require "./templates/footer.html" ?>