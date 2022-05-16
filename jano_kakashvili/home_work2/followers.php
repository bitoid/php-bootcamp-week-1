<?php include "./follow.php"; ?>
<?php require "header.html"; ?>

<table>
    <thead>
        <tr>
            <th>
                <a href="./index.php">Repositories/</a>
            </th>
            <th>
                <h3>Followers</h3>
            </th>
            <th></th>
        </tr>
        <tr>
            <th>index</th>
            <th>profile pictures</th>
            <th>followers name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $repository) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $repository['image'] ?></td>
                <td><?= $repository['name'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require "footer.html" ?>