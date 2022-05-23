<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['username'];
    $user_choice = $_POST['datatype'];
    $num = 0;
    $url = "https://api.github.com/users/${user_name}/${user_choice}" . "?page=1&per_page=100";
    $context  = stream_context_create(
        [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP'
                ]
            ]
        ]
    );

    if ($user_choice !== 'both') {
        $data = file_get_contents($url, false, $context);
        $decoded_data = json_decode($data, true);
    }
    if ($user_choice === 'both') {
        $repos_url = "https://api.github.com/users/${user_name}/repos" . "?page=1&per_page=100";
        $followers_url = "https://api.github.com/users/${user_name}/followers" . "?page=1&per_page=100";
        $repos_data = file_get_contents($repos_url, false, $context);
        $decoded_repos = json_decode($repos_data, true);
        $followers_data = file_get_contents($followers_url, false, $context);
        $decoded_followers = json_decode($followers_data, true);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>
    <?php if (empty($_POST)) : ?>

        <div class="container">
            <form method="POST" autocomplete="off">
                <div class="username">enter username :</div>
                <input type="text" id="username" name="username" placeholder="username">
                <label for="datatype">what kind of data do you need ?</label>
                <select name="datatype" id="data">
                    <option value="repos">repositories</option>
                    <option value="followers">followers</option>
                    <option value="both">both</option>
                </select>
                <button type="submit" class="fetch">fetch data</button>
            </form>
        </div>
    <?php else : ?>

        <div class="output">
            <?php if ($user_choice === 'both') : ?>
                <div class="both_container container-fluid">
                    <table class="repos_table">
                        <thead>
                            <tr>
                                <td></td>
                                <th>repositories</th>
                                <th>description</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($decoded_repos as $data) : ?>
                                <tr>
                                    <td> <?= ++$num ?> </td>
                                    <td> <a href=" <?= $data['html_url'] ?> "> <?= $data['full_name'] ?> </a> </td>
                                    <td> <?= $data['description'] ?> </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>

                    <?php $num = 0; ?>

                    <table class="followers_table">

                        <tbody>

                            <?php foreach ($decoded_followers as $data) : ?>

                                <tr>
                                    <td><?= ++$num ?></td>
                                    <td>
                                        <div class="images"> <a href="<?= $data['html_url'] ?>"> <img src="<?= $data['avatar_url'] ?>" alt=" <?= 'follower' . $num ?>"> </a> </div>
                                    </td>
                                    <td> <?= $data['login'] ?> </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                <?php elseif ($user_choice === "repos") : ?>
                    <div class="container">

                        <table class="repos_table">
                            <thead>
                                <tr>
                                    <td></td>
                                    <th>repositories</th>
                                    <th>description</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($decoded_data as $data) : ?>
                                    <tr>
                                        <td> <?= ++$num ?> </td>
                                        <td> <a href=" <?= $data['html_url'] ?> "> <?= $data['full_name'] ?> </a> </td>
                                        <td> <?= $data['description'] ?> </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>

                        </table>
                    </div>
                <?php elseif ($user_choice === 'followers') : ?>
                    <div class="container">

                        <table class="followers_table">

                            <tbody>

                                <?php foreach ($decoded_data as $data) : ?>

                                    <tr>
                                        <td><?= ++$num ?></td>
                                        <td>
                                            <div class="images"> <a href="<?= $data['html_url'] ?>"> <img src="<?= $data['avatar_url'] ?>" alt=" <?= 'follower' . $num ?>"> </a> </div>
                                        </td>
                                        <td> <?= $data['login'] ?> </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>

                        </table>
                    </div>

                <?php endif; ?>

                </div>
        </div>
    <?php endif; ?>
</body>

</html>