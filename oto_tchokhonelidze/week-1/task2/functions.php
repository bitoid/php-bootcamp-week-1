<?php

function getData($user, $type){

    $page = 1;
    $count = 1;
    $data = [];
    while($count == 1){

        $url = "https://api.github.com/users/{$user}/{$type}?page={$page}";
        $curl = curl_init();
        curl_setopt_array($curl,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Github API in CURL'
        ]);
        $response = curl_exec($curl);
        $api_data = json_decode($response, true);
        curl_close($curl);
        if(sizeof($api_data) == 0){
            $count = 0;
        }else{
            array_push($data, ...$api_data);
            $page += 1;
        }
    }
    return $data;

}


function show_data($data){

    $user = $data['name'];

    if($data['data'] == 'repositories'){
        $array = getData($user, 'repos');
        foreach ($array as $key => $value) {
            ?>
            <div class="repos">
                <p><?php echo $key + 1 ?></p>
                <p><a href="<?php echo $value['html_url'] ?>" target="_blank"><?php echo $value['name'] ?></a></p>
                <p><?php echo $value['description'] ?></p>
            </div>
            <?php
        }
        
    }

    if($data['data'] == 'followers'){
        $array = getData($user, 'followers');
        foreach ($array as $key => $value) {
            ?>
            <div class="followers">
                <p><?php echo $key + 1 ?></p>
                <a href="<?php echo $value['html_url'] ?>" target="_blank">
                    <img src="<?php echo $value['avatar_url'] ?>" alt="<?php echo $value['login'] ?>">
                    <p><?php echo $value['login'] ?></p>
                </a>
            </div>
            <?php
        }
    }

    if($data['data'] == 'both'){
        $repos = getData($user, 'repos');
        $followers = getData($user, 'followers');
        ?>
        <div class="container">
            <div class="first">
                <h1>Repos</h1>
                <?php
                    foreach ($repos as $key => $value) {
                        ?>
                        <div class="repos">
                            <p><?php echo $key + 1 ?></p>
                            <p><a href="<?php echo $value['html_url'] ?>" target="_blank"><?php echo $value['name'] ?></a></p>
                            <p><?php echo $value['description'] ?></p>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <div class="second">
                <h1>Followers</h1>
                <?php
                    foreach ($followers as $key => $value) {
                        ?>
                        <div class="followers">
                            <p><?php echo $key + 1 ?></p>
                            <a href="<?php echo $value['html_url'] ?>" target="_blank">
                                <img src="<?php echo $value['avatar_url'] ?>" alt="<?php echo $value['login'] ?>">
                                <p><?php echo $value['login'] ?></p>
                            </a>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        <?php
    }
}


?>