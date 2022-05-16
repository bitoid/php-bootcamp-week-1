<?php include "./repos.php"; ?>
<?php require "header.html" ?>
<?php require "form.php" ?>
<table>
    <thead>
        <tr>
            <th>
                <h3>Repositories</h2>
            </th>
            <th>
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
<?php require "footer.html" ?>