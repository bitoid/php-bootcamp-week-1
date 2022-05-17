<?php
$form = 'repo';
$pageNext = 2;
$pagePrev = '';
$error = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $url = "https://api.github.com/users/".$username."/repos?per_page=20";
} else {
    $username = $_GET['username'];
    $form = $_GET['form'] ?? 'followers';
    $url = "https://api.github.com/users/".$username."/followers?per_page=20";
    if ($_GET['form'] == 'repo') {
        $form = 'repo';
        $url = "https://api.github.com/users/".$username."/repos?per_page=20";
    }
    if (isset($_GET['page'])) {
        $pageNext = $_GET['page'] + 1;
        $pagePrev = $_GET['page'] - 1;
    }
}
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_USERAGENT, 'User-Agent: PHP');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
$info = json_decode($output);

if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 403) {
    $error = 'You have reached the rate limit for GitHub API. Please wait a minute and try again.';
    $code = 403;
    include 'errors.php';
    exit;

}elseif (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 404) {
    $error = 'User not found.';
    $code = 404;
    include 'errors.php';
    exit;
}
curl_close($curl);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>About</title>
</head>
<body>
<div class="container">

    <div class="d-flex justify-content-start"><h1>User: <?= $username ?></h1></div>
    <div class="d-flex justify-content-end"><a href="index.php" class="btn btn-primary">choose another user</a></div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link
            <?php
            if (isset($_GET['form']) && $_GET['form'] == 'repo' || $_POST): ?>
            active
            <?php
            endif; ?>" aria-current="page" href="about.php?username=<?= $username ?>&form=repo">Repositoris</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php
            if (isset($_GET['form']) && $_GET['form'] == 'followers'): ?>
            active
            <?php
            endif; ?>"
               href="about.php?username=<?= $username ?>&form=followers" tabindex="-1"
               aria-disabled="true">Followers</a>
        </li>
    </ul>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <?php
            if (isset($_GET['form']) && $_GET['form'] == 'followers'): ?>
                <th scope="col">Name</th>
                <th scope="col">Avatar</th>
            <?php
            else: ?>
                <th scope="col">Repository</th>
                <th scope="col">Description</th>
            <?php
            endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($info as $value): ?>
            <tr>
                <?php
                if (isset($_GET['form']) && $_GET['form'] == 'followers'): ?>
                    <td><?= $value->login ?></td>
                    <td>
                        <a href="<?= $value->html_url ?>">
                            <img src="<?= $value->avatar_url ?>" style="width: 50px">
                        </a>
                    </td>
                <?php
                else: ?>
                    <td><a href="<?= $value->html_url ?>"><?= $value->name ?></td></a>
                    <td><?= $value->description ?></td>
                <?php
                endif; ?>
            </tr>
        <?php
        endforeach; ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="about.php?page=<?= $pagePrev ?>&username=<?= $username ?>&form=<?= $form ?>">Previous</a></li>
            <li class="page-item"><a class="page-link" href="about.php?page=<?= $pageNext ?>&username=<?= $username ?>&form=<?= $form ?>" ">Next</a></li>
        </ul>
    </nav>
</div>
</body>
</html>