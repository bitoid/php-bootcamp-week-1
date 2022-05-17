<?php require "./show_repositories.php"; ?>
<?php require "./templates/header.html" ?>
<form class="main_form" action="htmlspecialchars($_SERVER['PHP_SELF']" method="POST" enctype="multipart/form-data">
    <input type="text" name="username" />
    <input type="submit" value="Search" name="submit" />
</form>

<?php if (!empty($_POST["username"])) : ?>
    <?php if ($http_status == 200) : ?> 
        <?php if (count($data) != 0) : ?>
            <table>
                <thead>
                    <tr>
                        <nav class="nav-bar">
                            <h3 style="display: inline-block;">Repositories</h3>
                            <a href="./followers.php">/Followers</a>
                        </nav>
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
            <h1 style="margin: 18px; text-align: center;">No repositories to display</h1>
        <?php endif; ?>
    <?php else : ?>
        <h1 style="margin: 18px; text-align: center;">No User With This Name!</h1>
    <?php endif; ?>
<?php else : ?>
    <h1 style="margin: 18px; text-align: center;">Fill the form with github UserName</h1>
<?php endif; ?>

<?php require "./templates/footer.html" ?>