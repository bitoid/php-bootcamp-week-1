<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>

<body>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['page'])) :

        $git_user = $_POST['git_user'];

        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP'
                ]
            ]
        ];

        $context = stream_context_create($opts);

        $repos_content = file_get_contents("https://api.github.com/users/" . $git_user . "/repos", false, $context);

        $followers_content = file_get_contents("https://api.github.com/users/" . $git_user . "/followers", false, $context);

        if (!$followers_content === false) {

            $followers = json_decode($followers_content);

            foreach ($followers as $val) :

                $login = $val->login;
                $avatar = $val->avatar_url;
                $profile = $val->html_url; ?>

                <a href="<?php echo $profile ?>"><img width="200" style="object-fit: cover" src="<?php echo $avatar ?>"><?php echo $login ?></a>

        <?php endforeach;
        }

    endif;

    if (empty($_POST)) : ?>

        <form method="post">
            <input type="text" name="git_user">
            <input type="submit" name="submit">
        </form>

    <?php endif ?>


</body>

</html>