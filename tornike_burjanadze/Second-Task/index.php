<?php
    if (isset($_GET['submitName'])) {
        $user_name = $_GET['username'];
        $response = [];

        $page = 1;
        $count = 1;


        while($count == 1){
            $curl = curl_init();
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

            array_push($response,...$result);

            curl_close($curl);
            
        }
    }


 ?>

<?php
    if (isset($_GET['submitName'])) {
        $user_name = $_GET['username'];
        $curL = curl_init();

        $followerResult = [];

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

            array_push($followerResult,...$resulT);

            curl_close($curL);
        }
    }


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Task#2</title>
</head>
<body>
<div class="task2">
            <h2>TASK #2</h2>
            <form class="search-form" action="index.php" method="get">
            <select name="select">
                <option value="choose" hidden>Choose One Option</option>
                <option name="repos" value="repos">Show Repositories</option>
                <option name="followers" value="followers">Show Folloewrs</option>
            </select>
            <div>
                <input class="search-user" type="text" name="username">
                <input type="submit" class="search-submit" name="submitName" value="Search"> 
            </div>
            </form>
            <div class="info-container">
                <ol class="repository">
                        <?php if ($_GET['select'] == "repos") : ?>
                            <?php   foreach($response as $resp):?>
                                <li>
                                    <a target="_blank" href="<?php $resp["html_url"] ?>"><?php echo $resp["name"] ?></a>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                </ol>
                <ol class="followers">
                    <?php if ($_GET['select'] == "followers") : ?>
                            <?php foreach($followerResult as $resP) : ?>
                               <li>
                                   <a target="_blank" href="<?php $resP["html_url"] ?>">
                                       <img src="<?php echo $resP["avatar_url"] ?>">
                                       <span><?php echo $resP["login"] ?></span>
                                    </a>
                                </li>;
                            <?php endforeach ?>
                    <?php endif ?> 
                </ol>
            </div>
        </div>
</body>
</html>