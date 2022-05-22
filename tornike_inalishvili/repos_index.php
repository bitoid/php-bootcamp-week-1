<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="repos_style.css">
    <title>Github Repositories and Followers</title>
</head>
<body>
<div class="container-1">
            <h1>Github User Repos and Followers</h1>
            <form class="form" action="repos_index.php" method="get">
            <select id="select" name="select">
                <option value="choose" hidden>Choose One Option</option>
                <option name="repos" value="repos">Show Repositories</option>
                <option name="followers" value="followers">Show Folloewrs</option>
            </select>
            <div>
                <input class="user" type="text" name="user_name" placeholder="Enter Username">
                <input type="submit" id="submit" name="submit" value="Search"> 
            </div>
            </form>
            <div class="container-2">
            <ol class="repositories">
                <?php
                    if (isset($_GET['submit'])) {
                            $user_name = $_GET['user_name'];
                        if (!empty($_GET['user_name'])) {

                                $curl = curl_init();

                                $follsonse = [];

                                $page = 1;
                                $count = 1;

                             while($count == 1){
                                    curl_setopt_array($curl, [
                                        CURLOPT_RETURNTRANSFER => 1,
                                        CURLOPT_URL => "https://api.github.com/users/".$user_name."/repos?page={$page}",
                                        CURLOPT_USERAGENT => 'User Repos'
                                    ]);

                                    $data = curl_exec($curl);

                                    $result = json_decode($data, true);

                                    if (sizeof($result) == 0) {
                                        $count = 0;
                                    }
                                    $page += 1;

                                    array_push($follsonse,...$result);

                                }
                ?>
                <?php 
                if (!empty($_GET['select'])) {
                            $selected = $_GET['select'];
                            if ($selected == "repos") {
                                   foreach($follsonse as $folls){
                                    echo '<li><a target="_blank" href="'.$folls["html_url"].'">'.$folls["name"].'</a></li>';
                                 }
                             }

                             }


                            curl_close($curl);
                         }

                    }
                 ?>
                </ol>
                <ol class="followers">
                    <?php 
                        if (isset($_GET['submit'])) {
                            $user_name = $_GET['user_name'];

                            if (!empty($_GET['user_name'])) {


                                $curL = curl_init();

                                $follower_results = [];

                                $followerPage = 1;
                                $followerCount = 1;

                                while ($followerCount == 1) {
                                    curl_setopt_array($curL, [
                                        CURLOPT_RETURNTRANSFER => 1,
                                        CURLOPT_URL => "https://api.github.com/users/".$user_name."/followers?page={$followerPage}",
                                        CURLOPT_USERAGENT => 'User Followers'
                                    ]);

                                    $datA = curl_exec($curL);

                                    $resulT = json_decode($datA, true);

                                    if (sizeof($resulT) == 0) {
                                        $followerCount = 0;
                                    }
                                    $followerPage += 1;

                                    array_push($follower_results,...$resulT);
                                }

                                if (!empty($_GET['select'])) {
                                    $selected = $_GET['select'];
                                    if ($selected == "followers") {
                                        foreach($follower_results as $folls){
                                            echo '<li><a target="_blank" href="'.$folls["html_url"].'"><img src="'.$folls["avatar_url"].'"><span>'.$folls["login"].'</span></a></li>';
                                        }

                                    }

                                }

                                curl_close($curL);
                            }

                        }
                    ?> 
                </ol>
            </div>
        </div>
</body>
</html>