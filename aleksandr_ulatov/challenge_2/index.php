<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GitHub user data</title>
</head>
<body>
    <?php $ghUserName = $_POST['ghUserName'];?>
    <h1>Get GitHub user data</h1>
    <form action="./index.php" enctype="multipart/form-data" method="POST">
        GitHub user name: <input type="text" name="ghUserName" value="<?php echo $ghUserName; ?>">
        <input type="submit" name="submit1" value="Send">
    </form>
    <br>
    <?php
        if(isset($ghUserName)) {
            
            $urlRepos     = "https://api.github.com/users/$ghUserName/repos";
            $urlFollowers = "https://api.github.com/users/$ghUserName/followers";

            // create a new cURL resource
            $ch = curl_init();

            // set URL and other appropriate options
            //curl_setopt($ch, CURLOPT_URL, $urlRepos);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_USERAGENT, 'FBI');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // grab URL and pass it to the browser
            curl_setopt($ch, CURLOPT_URL, $urlRepos);
            $r = curl_exec($ch);
            curl_setopt($ch, CURLOPT_URL, $urlFollowers);
            $f = curl_exec($ch);

            // close cURL resource, and free up system resources
            curl_close($ch);
            
            $arrRepos = json_decode($r , true);
            ?><h2>Repos</h2><?php
            foreach ($arrRepos as $c) {?>
                <p><a href="<?php echo $c['html_url']; ?>" target="_blank"> <?php echo $c['name']; ?> </a><p><?php
            };
            unset($c);

            $arrFollowers = json_decode($f , true);
            ?><h2>Followers</h2><?php
            foreach ($arrFollowers as $c) {?>
                <p>
                    <a href="<?php echo $c['html_url']; ?>" target="_blank">
                        <img
                            src="<?php echo $c['avatar_url']; ?>"
                            alt="<?php echo $c['login']; ?> avatar"
                            width="24" height="24"
                        >
                        <?php echo $c['login']; ?>
                    </a>
                <p><?php
            };
            unset($c);
            
        }
    ?>

</body>
</html>