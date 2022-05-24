<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Information Page</title>
        <link rel="stylesheet" href="/gitex.css">
    </head>

    <body class = "page">
        <?php if (empty($_POST)): ?>
        <form action="gitex.php" method="POST">
            <h1 class = "maintxt">github Nickname</h1><br>
            <div class="startercontainer">
                <input type="text" name="username" class = "username" placeholder="Nickname">
                <input type="submit" class = "submit" name="submit">
            </div>
            
        </form>
        <?php else: ?>
            <?php

            $nickname = $_POST['username'];
            $urlf = 'https://api.github.com/users/'. $nickname .'/followers';
            $urlr = 'https://api.github.com/users/'. $nickname .'/repos';
                
            $gituser = array(
                'http'=>array(
                'method'=>"GET", 'header'=>'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 
                (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36')
            );
            $context = stream_context_create($gituser);
            
            $followers_file = file_get_contents($urlf, false, $context);
            $repos_file = file_get_contents($urlr, false, $context);

            file_put_contents('followers.json', $followers_file);
            file_put_contents('repos.json', $repos_file);

            $json_followers = file_get_contents('followers.json');
            $json_followers_data = json_decode($json_followers,true);

            $json_repos = file_get_contents('repos.json');
            $json_repos_data = json_decode($json_repos,true);

            ?>
            <?php if (empty($json_followers_data and $json_repos_data)): ?>
                <div class = "noninfodiv">
                    <a class = "noninfo" href = "/week01_ex02_bust.php"> you have 0 followers</a>
                </div>
            <?php else: ?>
            <table class = "result">
                <tr>
                    <th>N</th>
                    <th>your followers</th>
                    <th>your repos name</th>
                    <th>your repos users ID</th>
                </tr>

                <?php for ($i = 0; $i < 21; $i++): ?>
                <tr>
                    <td>N - <?php print $i ?></td>
                    <td><a href="<?php print $json_followers_data[$i]['avatar_url'] ?>" class="thirdpage"><?php print $json_followers_data[$i]['login'] ?></a></td>
                    <td><a href="<?php print$json_repos_data[$i]['html_url'] ?>"><?php print $json_repos_data[$i]['name'] ?></a></td>
                    <td><?php print $json_repos_data[$i]['id'] ?></td>
                </tr>
                
                <?php endfor; ?>
                
            </table>
            <?php endif;?>
        <?php endif; ?>
    </body>
</html>