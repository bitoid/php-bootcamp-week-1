<?php include "show_followers.php"; ?>
<?php require "./templates/header.html"; ?>

<table>
    <thead>
        <tr>
            <th>
                <a href="./index.php">Repositories/</a>
                <h3 style="display: inline-block;">Followers</h3>
            </th>
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
                <td><img class="followers_image" src="<?= $repository['avatar_url']; ?>" alt="oops!"></td>
                <td><?= $repository['login'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require "./templates/footer.html" ?>