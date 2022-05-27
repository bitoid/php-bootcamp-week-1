<?php 


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $url1='https://api.github.com/users/'.$_POST['username'].'/followers?per_page=100';
    $url2 = "https://api.github.com/users/".$_POST['username']."/repos?per_page=100";
    $choice = $_POST['choice'];

if($choice=='repos'){
    $param1 = [
        'http' => [
            'method' => 'GET',
            'header' => [
             'user-agent: application/vnd.github.v3+json'
            ]
        ]
    ];
    $json_repos = file_get_contents($url2, false, stream_context_create($param1));
    $data_repos = json_decode($json_repos, true);
?>
    <ul>
    <?php
    for ($i=0; $i < count($data_repos); $i++) { 
    ?>
        <li>
            <a href="<?php echo $data_repos[$i]["html_url"];?>" >
            <p><?php echo $data_repos[$i]['name'].'<br>'; ?></p>
            </a>
            <?php echo 'ID : '.$data_repos[$i]['id'].'<br>'; ?>
        </li>
    <?php
    }
    ?>  
    </ul>
        <?php
}


if($choice=='followers'){
$username= $_POST["username"];
    $param2 = [
        'http' => [
            'method' => 'GET',
            'header' => [
             'user-agent: application/vnd.github.v3+json'
            ]
        ]
    ];

    $json_followers = file_get_contents($url1, false, stream_context_create($param2));
    $data_followers = json_decode($json_followers, true);
?>
    <ul>
    <?php
    for ($i=0; $i < count($data_followers); $i++) { 
    ?>
        <li>
            <a href="<?php echo $data_followers[$i]["html_url"];?>" >
            <p><?php echo $data_followers[$i]['login'].'<br>'; ?></p>
            <span>
            <img src="<?php echo $data_followers[$i]["avatar_url"];?>" width="100" alt="">
            </span>    
            </a>
        </li>
    <?php
    }
    ?>  
    </ul>
        <?php
  }


}  
?>


 
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form action="index.php" method="post" >
            <input type="text" name="username" placeholder="Username" required>
            <label for="repos">
                <input id="repos" type="radio" name="choice" value="repos">Repos
            </label>
            <label for="followers">
                <input id="followers" type="radio" name="choice" value="followers">Followers
            </label>
            <label for="submit">
                <button id="submit" type="submit">SUBMIT</button>
            </label>

</body>
    </html>