<?php
function getRepositories($user){
    $api_url = 'https://api.github.com/users/' . $user .'/repos';

    $opts = [
        'http' => [
                'method' => 'GET',
                'header' => [
                        'User-Agent: PHP'
                ]
        ]
    ];

    $context = stream_context_create($opts);
    $content = file_get_contents($api_url, false, $context);
    $response_json = json_decode($content);
    return $response_json;
}

function getFollowers($user){
    $api_url = 'https://api.github.com/users/' .$user .'/followers';

    $opts = [
        'http' => [
                'method' => 'GET',
                'header' => [
                        'User-Agent: PHP'
                ]
        ]
    ];
    $context = stream_context_create($opts);
    $content = file_get_contents($api_url, false, $context);
    $response_json = json_decode($content);
    return $response_json;
}
?>




<!DODCTYPE html>
<html>
    <head>
        <title>Git</title>
        <link rel='stylesheet' href='style/styles.css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    </head>
    <body>
        <form action='/git.php' method='post'>
            <input name='username' type='text' placeholder='Enter Username'>
            <input type='submit' value='submit'>
        </form>
        <?php
            $api_url = 'https://github.com/';
            if($_SERVER['REQUEST_METHOD'] === 'POST'):
                $user_name = $_POST['username'];
                $followers = getFollowers($user_name); ?>
        
                <h2 class='text-center'><?= $user_name ?> Followers</h2>
                <div class='container'>
                    <div class='row'>
                        <?php foreach($followers as $item): ?>
                            <div class="card" style="width: 18rem;">
                                <img src="<?= $item->avatar_url ?>" class="card-img-top">
                                <div class="card-body">
                                    <p>Follower: <?= $item->login ?></p>
                                    <p>Proflie link: <a href="<?= $item->html_url ?>"><?php print $item->html_url ?></a>
                                </div>
                            </div>
                        <?php  endforeach; ?>
                    </div>
                </div>

                <?php $repositories = getRepositories($user_name);?>
                <h2 class='text-center'><?= $user_name ?> Repositories</h2>
                    <ul class='repos'>
                        <?php foreach($repositories as $item): ?>
                            <li><a href="<?= $item->html_url ?>"> <?= $item->name ?></a></li>
                        <?php endforeach; ?>
                    </ul>
        <?php endif; ?>

    </body>
</html>

