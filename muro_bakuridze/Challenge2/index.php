<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge #2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="w-25 m-5" name="form" action="" method="get">
        <div class="form-group">
            <label for="subject">Enter Github Account Name</label><br>
            <input class="form-control" type="text" name="subject" id="subject" placeholder="Github Name" required>
            <input class="btn btn-primary mt-1" type="submit" value="Submit">
        </div>
    </form>
<?php

    if(isset($_GET['subject'])){
        $urlIndex =  $_GET['subject'];

        $curlForRepo = curl_init();
        $curlForFollow = curl_init();
        $repoUrl= "https://api.github.com/users/$urlIndex/repos";
        $followUrl = "https://api.github.com/users/$urlIndex/followers";
        // echo $repoUrl.'<br>';
        // echo $followUrl.'<br>';
    
        curl_setopt_array($curlForRepo,[
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $repoUrl,
            CURLOPT_USERAGENT => 'Muro Github API'
        ]);
        curl_setopt_array($curlForFollow,[
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $followUrl,
            CURLOPT_USERAGENT => 'Github API'
        ]);

        if($e = curl_error($curlForRepo)){
            echo 'error';
        }else{
            $repoResponse = curl_exec($curlForRepo);
            $followResponse = curl_exec($curlForFollow);
            $repoData = json_decode($repoResponse, true);
            $followData = json_decode($followResponse, true);
?>
<div class="container">
    <div class="links">
<?php
         
                echo("Repositories: \n");
            if(isset($repoData['message']) && $repoData['message'] == 'Not Found'){
                echo 'nononoo';
            } else {
                foreach($repoData as $i){
?>
                <a href="https://github.com/<?= $urlIndex.'/'.$i['name'] ?>" class="links">
                    <div>
                        <?= $i['name'] ?>
                    </div>
                </a>
<?php
                }
            curl_close($curlForRepo);
            }
?>
    </div>
    <div class="links">
<?php
            echo("Followers: \n");

            foreach($followData as $i){
?>
                <a href="https://github.com/<?= '/'.$i['login'] ?>">
                    <div>
                        <?= $i['login'] ?>
                        <img src="<?= $i['avatar_url'] ?>" alt="avatar" style="width:30px;">
                    </div>
                </a>
<?php

            }
            curl_close($curlForFollow);
            }
        }
    
?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
